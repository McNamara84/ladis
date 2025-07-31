<?php

namespace Tests\Unit\Services\Contacts\Validators;

use Tests\TestCase;
use App\Services\Contacts\Validators\ContactsConfigValidator;
use Illuminate\Validation\ValidationException;

class ContactsConfigValidatorTest extends TestCase
{
    /**
     * Valid configuration data for testing
     */
    private function getValidConfig(): array
    {
        return require base_path('app/Services/Contacts/config/contacts.php');
    }

    /**
     * Test that validate passes with valid configuration
     */
    public function test_validate_passes_with_valid_configuration(): void
    {
        $config = $this->getValidConfig();

        // Should not throw any exception
        ContactsConfigValidator::validate($config);

        // If we get here, validation passed
        $this->assertTrue(true);
    }

    /**
     * Test that validate throws ValidationException when cache_key is missing
     */
    public function test_validate_throws_exception_when_cache_key_is_missing(): void
    {
        $config = $this->getValidConfig();
        unset($config['cache_key']);

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when cache_key is empty string
     */
    public function test_validate_throws_exception_when_cache_key_is_empty_string(): void
    {
        $config = $this->getValidConfig();
        $config['cache_key'] = '';

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when cache_key is not a string
     */
    public function test_validate_throws_exception_when_cache_key_is_not_string(): void
    {
        $config = $this->getValidConfig();
        $config['cache_key'] = 123;

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage is missing
     */
    public function test_validate_throws_exception_when_storage_is_missing(): void
    {
        $config = $this->getValidConfig();
        unset($config['storage']);

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage is not an array
     */
    public function test_validate_throws_exception_when_storage_is_not_array(): void
    {
        $config = $this->getValidConfig();
        $config['storage'] = 'not_an_array';

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.directory is missing
     */
    public function test_validate_throws_exception_when_storage_directory_is_missing(): void
    {
        $config = $this->getValidConfig();
        unset($config['storage']['directory']);

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.directory is empty string
     */
    public function test_validate_throws_exception_when_storage_directory_is_empty_string(): void
    {
        $config = $this->getValidConfig();
        $config['storage']['directory'] = '';

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.directory is not a string
     */
    public function test_validate_throws_exception_when_storage_directory_is_not_string(): void
    {
        $config = $this->getValidConfig();
        $config['storage']['directory'] = 123;

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.file_extension is missing
     */
    public function test_validate_throws_exception_when_storage_file_extension_is_missing(): void
    {
        $config = $this->getValidConfig();
        unset($config['storage']['file_extension']);

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.file_extension doesn't start with dot
     */
    public function test_validate_throws_exception_when_file_extension_does_not_start_with_dot(): void
    {
        $config = $this->getValidConfig();
        $config['storage']['file_extension'] = 'json';

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.file_extension has no alphanumeric characters after dot
     */
    public function test_validate_throws_exception_when_file_extension_has_no_alphanumeric_after_dot(): void
    {
        $config = $this->getValidConfig();
        $config['storage']['file_extension'] = '.';

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.file_extension contains invalid characters
     */
    public function test_validate_throws_exception_when_file_extension_contains_invalid_characters(): void
    {
        $config = $this->getValidConfig();
        $config['storage']['file_extension'] = '.js@on';

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate throws ValidationException when storage.file_extension is not a string
     */
    public function test_validate_throws_exception_when_file_extension_is_not_string(): void
    {
        $config = $this->getValidConfig();
        $config['storage']['file_extension'] = 123;

        $this->expectException(ValidationException::class);
        ContactsConfigValidator::validate($config);
    }

    /**
     * Test that validate accepts various valid file extensions
     */
    public function test_validate_accepts_various_valid_file_extensions(): void
    {
        $validExtensions = ['.json', '.xml', '.txt', '.data', '.cfg', '.conf', '.yml', '.yaml'];

        foreach ($validExtensions as $extension) {
            $config = $this->getValidConfig();
            $config['storage']['file_extension'] = $extension;

            // Should not throw any exception
            ContactsConfigValidator::validate($config);
        }

        // If we get here, all extensions passed validation
        $this->assertTrue(true);
    }

    /**
     * Test that ValidationException contains proper validator instance
     */
    public function test_validation_exception_contains_proper_validator_instance(): void
    {
        $config = $this->getValidConfig();
        $config['cache_key'] = '';

        try {
            ContactsConfigValidator::validate($config);
            $this->fail('Expected ValidationException was not thrown');
        } catch (ValidationException $e) {
            $this->assertNotNull($e->validator);
            $this->assertTrue($e->validator->fails());
            $this->assertArrayHasKey('cache_key', $e->validator->errors()->toArray());
        }
    }

    /**
     * Test that validate handles multiple validation errors at once
     */
    public function test_validate_handles_multiple_validation_errors(): void
    {
        $config = [
            'cache_key' => '', // Invalid: empty string
            'storage' => [
                'directory' => 123, // Invalid: not a string
                'file_extension' => 'json' // Invalid: doesn't start with dot
            ]
        ];

        try {
            ContactsConfigValidator::validate($config);
            $this->fail('Expected ValidationException was not thrown');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();

            $this->assertArrayHasKey('cache_key', $errors);
            $this->assertArrayHasKey('storage.directory', $errors);
            $this->assertArrayHasKey('storage.file_extension', $errors);
        }
    }
}
