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
     * Whether the contacts have been loaded
     *
     * @var bool
     */
    private bool $loaded = false;

    /**
     * Get all contacts
     *
     * @return array<string, Contact> All contacts keyed by their IDs
     */
    public function all(): array
    {
        $this->ensureLoaded();

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
        $this->ensureLoaded();

        $result = [];
        foreach ($ids as $id) {
            if (isset($this->instances[$id])) {
                $result[$id] = $this->instances[$id];
            }
        }
        return $result;
    }

    /**
     * Ensure that contacts are loaded before accessing them.
     *
     * @return void
     */
    private function ensureLoaded(): void
    {
        if (!$this->loaded) {
            $this->load();
            $this->loaded = true;
        }
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
     * Load raw contact data from storage files
     *
     * @return array<string, string>
     */
    private function loadFromStorage(): array
    {
        $records = [];

        if (!$this->checkStorageDirectoryExists()) {
            return $records;
        }

        $files = $this->collectContactFiles();

        foreach ($files as $id => $file) {
            try {
                $result = $this->loadContactFile($file);
                $records[$id] = $result;
            } catch (\Exception $e) {
                // Nothing to do here
            }
        }

        return $records;
    }

    /**
     * Check if the storage directory exists
     *
     * @return bool
     */
    private function checkStorageDirectoryExists(): bool
    {
        $directory = $this->getStorageDirectory();

        if (Storage::exists($directory)) {
            return true;
        }

        Log::warning('Contacts directory does not exist', [
            'directory' => $directory,
            'path' => Storage::path($directory)
        ]);

        return false;
    }

    /**
     * Collect contact files from the storage directory
     *
     * @return array<string, string> Array of contact files keyed by their IDs
     */
    private function collectContactFiles(): array
    {
        $files = Storage::files($this->getStorageDirectory());
        $records = [];
        $extension = $this->getFileExtension();

        foreach ($files as $file) {
            if (str_ends_with($file, $extension)) {
                $id = basename($file, $extension);
                $records[$id] = $file;
            }
        }

        return $records;
    }

    /**
     * Load a contact file from storage
     *
     * @param string $file The file path
     * @return string The contact data
     * @throws \Exception If the file cannot be loaded
     */
    private function loadContactFile(string $file): string
    {
        try {
            return Storage::get($file);
        } catch (\Exception $e) {
            Log::error("Error loading contact file", [
                'error' => $e->getMessage(),
                'file' => $file,
            ]);

            throw $e;
        }
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
     * Magic method to get a contact by ID
     *
     * @param string $id The contact ID
     * @return Contact|null The contact instance or null if not found
     */
    public function __get(string $id): ?Contact
    {
        $this->ensureLoaded();

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
        $this->ensureLoaded();

        return isset($this->instances[$id]);
    }
}
