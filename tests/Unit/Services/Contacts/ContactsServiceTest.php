<?php

namespace Tests\Unit\Services\Contacts;

use Tests\TestCase;
use App\Services\Contacts\ContactsService;
use App\Services\Contacts\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Mockery;

class ContactsServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Clear any previous mocks
        Mockery::close();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test that ContactsService returns empty array when storage directory doesn't exist
     */
    public function test_all_returns_empty_array_when_storage_directory_does_not_exist(): void
    {
        // Mock config values
        config(['contacts.cache_key' => 'test_contacts_cache']);
        config(['contacts.storage.directory' => 'test/contacts']);
        config(['contacts.storage.file_extension' => '.json']);

        // Mock Storage facade to return false for directory existence
        Storage::shouldReceive('exists')
            ->with('test/contacts')
            ->once()
            ->andReturn(false);

        // Mock Log facade to expect warning
        Log::shouldReceive('warning')
            ->with('Contacts directory does not exist', Mockery::type('array'))
            ->once();

        // Mock Cache facade for rememberForever to call the callback
        Cache::shouldReceive('rememberForever')
            ->with('test_contacts_cache', Mockery::type('Closure'))
            ->once()
            ->andReturnUsing(fn($key, $callback) => $callback());

        // Mock Storage::path for logging
        Storage::shouldReceive('path')
            ->with('test/contacts')
            ->once()
            ->andReturn('/fake/path/test/contacts');

        // Create service instance
        $service = new ContactsService();

        // Assert that all() returns an empty array
        $this->assertIsArray($service->all());
        $this->assertEmpty($service->all());
    }

    /**
     * Test that ContactsService successfully loads contacts from storage files
     */
    public function test_all_returns_contacts_when_storage_directory_exist(): void
    {
        // Mock config values
        config(['contacts.cache_key' => 'test_contacts_cache']);
        config(['contacts.storage.directory' => 'test/contacts']);
        config(['contacts.storage.file_extension' => '.json']);

        // Prepare test contact data
        $contact1Json = json_encode([
            '@type' => 'Person',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'telephone' => '+1234567890'
        ]);

        $contact2Json = json_encode([
            '@type' => 'Organization',
            'name' => 'Test Organization',
            'url' => 'https://example.org',
            'address' => 'Test Address'
        ]);

        // Mock Storage facade to return true for directory existence
        Storage::shouldReceive('exists')
            ->with('test/contacts')
            ->once()
            ->andReturn(true);

        // Mock Storage facade to return contact files
        Storage::shouldReceive('files')
            ->with('test/contacts')
            ->once()
            ->andReturnUsing(fn() => [
                'test/contacts/john-doe.json',
                'test/contacts/test-org.json',
                'test/contacts/invalid-file.txt' // Should be ignored
            ]);

        // Mock Storage facade to return file contents
        Storage::shouldReceive('get')
            ->with('test/contacts/john-doe.json')
            ->once()
            ->andReturn($contact1Json);

        Storage::shouldReceive('get')
            ->with('test/contacts/test-org.json')
            ->once()
            ->andReturn($contact2Json);

        // Mock Cache facade for rememberForever to call the callback
        Cache::shouldReceive('rememberForever')
            ->with('test_contacts_cache', Mockery::type('Closure'))
            ->once()
            ->andReturnUsing(fn($key, $callback) => $callback());

        // Create service instance
        $service = new ContactsService();

        // Get all contacts
        $contacts = $service->all();

        // Assert that contacts are loaded correctly
        $this->assertIsArray($contacts);
        $this->assertCount(2, $contacts);
        $this->assertArrayHasKey('john-doe', $contacts);
        $this->assertArrayHasKey('test-org', $contacts);

        // Assert that contacts are Contact instances
        $this->assertInstanceOf(Contact::class, $contacts['john-doe']);
        $this->assertInstanceOf(Contact::class, $contacts['test-org']);
    }
}
