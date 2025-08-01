<?php

namespace Tests\Unit\Services\Contacts;

use Tests\TestCase;
use App\Services\Contacts\ContactsService;
use App\Services\Contacts\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ContactsServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set up common config for all tests
        config([
            'contacts.cache_key' => 'test_contacts_cache',
            'contacts.storage.directory' => 'test/contacts',
            'contacts.storage.file_extension' => '.json'
        ]);
    }

    /**
     * Test that ContactsService returns empty array when storage directory doesn't exist
     */
    public function test_all_returns_empty_array_when_storage_directory_does_not_exist(): void
    {
        Storage::shouldReceive('exists')->with('test/contacts')->once()->andReturn(false);
        Log::shouldReceive('warning')->once();
        Storage::shouldReceive('path')->once()->andReturn('/fake/path');
        Cache::shouldReceive('rememberForever')->once()->andReturnUsing(fn($key, $callback) => $callback());

        $service = new ContactsService();

        $this->assertEmpty($service->all());
    }

    /**
     * Test that ContactsService successfully loads contacts from storage files
     */
    public function test_all_returns_contacts_when_storage_directory_exist(): void
    {
        Storage::shouldReceive('exists')->with('test/contacts')->once()->andReturn(true);
        Storage::shouldReceive('files')->once()->andReturnUsing(fn() => ['test/contacts/alice.json']);
        Storage::shouldReceive('get')->once()->andReturn(json_encode(['name' => 'Alice']));
        Cache::shouldReceive('rememberForever')->once()->andReturnUsing(fn($key, $callback) => $callback());

        $service = new ContactsService();
        $contacts = $service->all();

        $this->assertCount(1, $contacts);
        $this->assertInstanceOf(Contact::class, $contacts['alice']);
    }

    /**
     * Test that getMultiple returns only the requested contacts that exist
     */
    public function test_getMultiple_returns_only_existing_contacts(): void
    {
        // Use cache hit to avoid storage setup
        Cache::shouldReceive('rememberForever')->once()->andReturnUsing(fn() => [
            'alice' => json_encode(['name' => 'Alice']),
            'bob' => json_encode(['name' => 'Bob'])
        ]);

        $service = new ContactsService();

        // Test main behavior: returns only existing contacts
        $result = $service->getMultiple(['alice', 'nonexistent', 'bob']);
        $this->assertCount(2, $result);
        $this->assertArrayNotHasKey('nonexistent', $result);

        // Test edge cases
        $this->assertEmpty($service->getMultiple([]));
        $this->assertEmpty($service->getMultiple(['missing']));
    }

    /**
     * Test that magic methods __get() and __isset() work correctly for accessing contacts
     */
    public function test_magic_methods_allow_direct_contact_access(): void
    {
        // Use cache hit - we're testing delegation, not loading
        Cache::shouldReceive('rememberForever')->once()->andReturnUsing(fn() => [
            'alice' => json_encode(['name' => 'Alice'])
        ]);

        $service = new ContactsService();

        // Test magic method delegation
        $this->assertTrue(isset($service->alice));
        $this->assertFalse(isset($service->nonexistent));
        $this->assertInstanceOf(Contact::class, $service->alice);
        $this->assertNull($service->nonexistent);
    }

    /**
     * Test that ContactsService gracefully handles file loading errors and continues processing
     */
    public function test_handles_file_loading_errors_gracefully(): void
    {
        Cache::shouldReceive('rememberForever')->once()->andReturnUsing(fn($key, $callback) => $callback());
        Storage::shouldReceive('exists')->with('test/contacts')->once()->andReturn(true);
        Storage::shouldReceive('files')->once()->andReturnUsing(fn() => [
            'test/contacts/alice.json',
            'test/contacts/corrupted-file.json'
        ]);
        Storage::shouldReceive('get')->with('test/contacts/alice.json')->once()
            ->andReturn(json_encode(['name' => 'Alice']));
        Storage::shouldReceive('get')->with('test/contacts/corrupted-file.json')->once()
            ->andThrow(new \Exception('File is corrupted or unreadable'));
        Log::shouldReceive('error')->once();

        $service = new ContactsService();
        $contacts = $service->all();

        $this->assertCount(1, $contacts);
        $this->assertArrayHasKey('alice', $contacts);
        $this->assertArrayNotHasKey('corrupted-file', $contacts);
        $this->assertInstanceOf(Contact::class, $contacts['alice']);
    }

    /**
     * Test that ContactsService loads from cache when cache data exists (cache hit)
     */
    public function test_loads_contacts_from_cache_when_cache_exists(): void
    {
        $cachedData = [
            'alice' => json_encode(['name' => 'Alice'])
        ];

        Cache::shouldReceive('rememberForever')->once()->andReturnUsing(fn() => $cachedData);

        $service = new ContactsService();
        $contacts = $service->all();

        $this->assertCount(1, $contacts);
        $this->assertInstanceOf(Contact::class, $contacts['alice']);
    }
}
