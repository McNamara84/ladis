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
     * The key of the cache.
     *
     * @var string
     */
    private const CACHE_KEY = 'contacts';

    /**
     * The directory where the contact data is stored.
     * Usually `storage/app/private/contacts`.
     *
     * @var string
     */
    private const STORAGE_DIRECTORY = 'contacts';

    /**
     * The file extension of the contact data.
     *
     * @var string
     */
    private const STORAGE_FILE_EXTENSION = '.json';

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
     * Controllers MUST use this method to clear the cache whenever contacts
     * are updated.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
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
     * Update the persistent cache
     *
     * Contacts are cached indefinitely.
     *
     * @param array<string, string> $data The contacts to update the cache with
     * @return void
     */
    private function updateCache(array $data): void
    {
        Cache::forever(self::CACHE_KEY, $data);
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
            self::CACHE_KEY,
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
        return Cache::get(self::CACHE_KEY, []);
    }

    /**
     * Load raw contact data from storage files
     *
     * @return array<string, string>
     */
    private function loadFromStorage(): array
    {
        $records = [];

        if (!Storage::exists(self::STORAGE_DIRECTORY)) {
            Log::warning('Contacts directory does not exist', [
                'directory' => self::STORAGE_DIRECTORY,
                'path' => Storage::path(self::STORAGE_DIRECTORY)
            ]);

            return $records;
        }

        $files = collect(Storage::files(self::STORAGE_DIRECTORY))
            ->filter(fn($file) => str_ends_with($file, self::STORAGE_FILE_EXTENSION));

        foreach ($files as $file) {
            try {
                $json = Storage::get($file);
                $id = basename($file, self::STORAGE_FILE_EXTENSION);
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
