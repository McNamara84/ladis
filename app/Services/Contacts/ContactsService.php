<?php

namespace App\Services\Contacts;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Services\Contacts\Models\Contact;

/**
 * Contacts Service
 *
 * Manages contact data stored as Schema.org structured data in JSON files.
 *
 * @since 0.2.0
 */
class ContactsService
{
    /**
     * Contacts data as Contact instances for this request
     *
     * @var array<string, Contact>
     */
    private array $instances = [];

    /**
     * Constructor
     *
     * Loads the contacts data from the cache or the storage and caches them.
     *
     * @return void
     */
    public function __construct()
    {
        $this->load();
    }

    /**
     * Get the cache key for contacts
     *
     * @return string
     */
    private function getCacheKey(): string
    {
        return config('contacts.cache_key');
    }

    /**
     * Get the storage directory for contacts
     *
     * @return string
     */
    private function getStorageDirectory(): string
    {
        return config('contacts.storage.directory');
    }

    /**
     * Get the file extension for contact files
     *
     * @return string
     */
    private function getFileExtension(): string
    {
        return config('contacts.storage.file_extension');
    }

    /**
     * Get all contacts
     *
     * @return array<string, Contact> All contacts keyed by their IDs
     */
    public function all(): array
    {
        return $this->instances;
    }

    /**
     * Get multiple contacts in the order of the provided IDs, returning only
     * found ones.
     *
     * @param array<int, string> $ids The contact IDs
     * @return array<string, Contact> Array of contacts keyed by their IDs
     */
    public function getMultiple(array $ids): array
    {
        $result = [];
        foreach ($ids as $id) {
            if (isset($this->instances[$id])) {
                $result[$id] = $this->instances[$id];
            }
        }
        return $result;
    }

    /**
     * Clear the contacts cache
     *
     * Use this method to clear the cache whenever contacts are updated.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget($this->getCacheKey());
    }

    /**
     * Load contacts from cache or storage.
     *
     * If the contacts are not in the cache, they are loaded from storage and
     * processed before being cached.
     *
     * @return void
     */
    private function load(): void
    {
        $records = $this->remember();

        foreach ($records as $id => $json) {
            $this->instances[$id] = new Contact($json);
        }
    }

    /**
     * Remember the contacts data in the cache.
     *
     * Retrieves the raw contacts data from the cache if it exists, otherwise
     * loads it from storage and caches it.
     *
     * @return array<string, string> The contacts data
     */
    private function remember(): array
    {
        return Cache::rememberForever(
            $this->getCacheKey(),
            fn() => $this->loadFromStorage()
        );
    }

    /**
     * Load contacts from the persistent cache.
     *
     * @return array<string, string> The contacts from the cache
     */
    private function loadFromCache(): array
    {
        return Cache::get($this->getCacheKey(), []);
    }

    /**
     * Load raw contact data from storage files
     *
     * @return array<string, string>
     */
    private function loadFromStorage(): array
    {
        $records = [];

        if (!Storage::exists($this->getStorageDirectory())) {
            Log::warning('Contacts directory does not exist', [
                'directory' => $this->getStorageDirectory(),
                'path' => Storage::path($this->getStorageDirectory())
            ]);

            return $records;
        }

        $files = collect(Storage::files($this->getStorageDirectory()))
            ->filter(fn($file) => str_ends_with($file, $this->getFileExtension()));

        foreach ($files as $file) {
            try {
                $json = Storage::get($file);
                $id = basename($file, $this->getFileExtension());
                $records[$id] = $json;
            } catch (\Exception $e) {
                Log::error("Error loading contact file", [
                    'error' => $e->getMessage(),
                    'file' => $file,
                ]);
            }
        }

        return $records;
    }

    /**
     * Magic method to get a contact by ID
     *
     * @param string $id The contact ID
     * @return Contact|null The contact instance or null if not found
     */
    public function __get(string $id): ?Contact
    {
        return $this->instances[$id] ?? null;
    }

    /**
     * Magic method to check if a contact is loaded
     *
     * @param string $id The contact ID
     * @return bool
     */
    public function __isset(string $id): bool
    {
        return isset($this->instances[$id]);
    }
}
