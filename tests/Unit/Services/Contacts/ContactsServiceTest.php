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

    /**
     * Test that getMultiple returns only the requested contacts that exist
     */
    public function test_getMultiple_returns_only_existing_contacts_in_order(): void
    {
        // Mock config values
        config(['contacts.cache_key' => 'test_contacts_cache']);
        config(['contacts.storage.directory' => 'test/contacts']);
        config(['contacts.storage.file_extension' => '.json']);

        // Prepare test contact data
        $contact1Json = json_encode(['@type' => 'Person', 'name' => 'Alice']);
        $contact2Json = json_encode(['@type' => 'Person', 'name' => 'Bob']);
        $contact3Json = json_encode(['@type' => 'Person', 'name' => 'Charlie']);

        // Mock Storage facade
        Storage::shouldReceive('exists')->with('test/contacts')->once()->andReturn(true);
        Storage::shouldReceive('files')->with('test/contacts')->once()
            ->andReturnUsing(fn() => [
                'test/contacts/alice.json',
                'test/contacts/bob.json',
                'test/contacts/charlie.json'
            ]);

        Storage::shouldReceive('get')->with('test/contacts/alice.json')->once()->andReturn($contact1Json);
        Storage::shouldReceive('get')->with('test/contacts/bob.json')->once()->andReturn($contact2Json);
        Storage::shouldReceive('get')->with('test/contacts/charlie.json')->once()->andReturn($contact3Json);

        // Mock Cache facade
        Cache::shouldReceive('rememberForever')
            ->with('test_contacts_cache', Mockery::type('Closure'))
            ->once()
            ->andReturnUsing(fn($key, $callback) => $callback());

        // Create service instance
        $service = new ContactsService();

        // Test getting multiple contacts - mix of existing and non-existing IDs
        $requestedIds = ['alice', 'nonexistent', 'charlie', 'another-missing'];
        $result = $service->getMultiple($requestedIds);

        // Assert only existing contacts are returned
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertArrayHasKey('alice', $result);
        $this->assertArrayHasKey('charlie', $result);
        $this->assertArrayNotHasKey('nonexistent', $result);
        $this->assertArrayNotHasKey('another-missing', $result);

        // Assert contacts are Contact instances
        $this->assertInstanceOf(Contact::class, $result['alice']);
        $this->assertInstanceOf(Contact::class, $result['charlie']);

        // Test with empty array
        $emptyResult = $service->getMultiple([]);
        $this->assertIsArray($emptyResult);
        $this->assertEmpty($emptyResult);

        // Test with all non-existing IDs
        $nonExistingResult = $service->getMultiple(['missing1', 'missing2']);
        $this->assertIsArray($nonExistingResult);
        $this->assertEmpty($nonExistingResult);
    }

    /**
     * Test that magic methods __get() and __isset() work correctly for accessing contacts
     */
    public function test_magic_methods_allow_direct_contact_access(): void
    {
        // Mock config values
        config(['contacts.cache_key' => 'test_contacts_cache']);
        config(['contacts.storage.directory' => 'test/contacts']);
        config(['contacts.storage.file_extension' => '.json']);

        // Prepare test contact data
        $personJson = json_encode([
            '@type' => 'Person',
            'name' => 'Jane Doe',
            'email' => 'jane@example.com'
        ]);

        $organizationJson = json_encode([
            '@type' => 'Organization',
            'name' => 'Acme Corp',
            'url' => 'https://acme.com'
        ]);

        // Mock Storage facade
        Storage::shouldReceive('exists')->with('test/contacts')->once()->andReturn(true);
        Storage::shouldReceive('files')->with('test/contacts')->once()
            ->andReturnUsing(fn() => [
                'test/contacts/jane-doe.json',
                'test/contacts/acme.json'
            ]);

        Storage::shouldReceive('get')->with('test/contacts/jane-doe.json')->once()->andReturn($personJson);
        Storage::shouldReceive('get')->with('test/contacts/acme.json')->once()->andReturn($organizationJson);

        // Mock Cache facade
        Cache::shouldReceive('rememberForever')
            ->with('test_contacts_cache', Mockery::type('Closure'))
            ->once()
            ->andReturnUsing(fn($key, $callback) => $callback());

        // Create service instance
        $service = new ContactsService();

        // Test __isset() magic method
        $this->assertTrue(isset($service->{'jane-doe'})); // Requires curly braces due to hyphen
        $this->assertTrue(isset($service->acme));          // Simple syntax for single word
        $this->assertFalse(isset($service->{'non-existing'}));

        // Test __get() magic method for existing contacts
        $personContact = $service->{'jane-doe'}; // Curly brace syntax for hyphenated ID
        $this->assertInstanceOf(Contact::class, $personContact);
        $this->assertEquals('Jane Doe', $personContact->name);
        $this->assertEquals('jane@example.com', $personContact->email);

        $orgContact = $service->acme; // Simple property syntax for single word ID
        $this->assertInstanceOf(Contact::class, $orgContact);
        $this->assertEquals('Acme Corp', $orgContact->name);
        $this->assertEquals('https://acme.com', $orgContact->url);

        // Test __get() magic method for non-existing contact
        $nonExistingContact = $service->{'non-existing'};
        $this->assertNull($nonExistingContact);
    }
}
