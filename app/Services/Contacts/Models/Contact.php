<?php

namespace App\Services\Contacts\Models;

/**
 * Contact model
 *
 * @since 0.2.0
 */
class Contact
{
    /**
     * Tokens for the name format
     *
     * @var array<string, string>
     */
    protected const NAME_TOKENS = [
        'n' => 'name',
        'a' => 'alternateName',
    ];

    /**
     * The default name format
     *
     * @var string
     */
    public const DEFAULT_NAME_FORMAT = '[n][ (a)]';

    /**
     * The decoded contact data
     *
     * @var array<string, mixed>
     */
    protected array $data;

    /**
     * Create a new contact instance from raw JSON data
     *
     * @param string $json The raw contact data as JSON
     */
    public function __construct(
        protected string $json
    ) {
        $this->data = $this->decode();
    }

    /**
     * Get the raw contact data as JSON string
     *
     * @return string
     */
    public function getJson(): string
    {
        return $this->json;
    }

    /**
     * Get the decoded contact data
     *
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Decode the raw contact data as array
     *
     * @return array<string, mixed>
     */
    private function decode(): array
    {
        return json_decode($this->json, true);
    }

    /**
     * Checks if the contact has any of the given properties
     *
     * @param array<int, string> $properties The properties to check
     * @return bool
     */
    public function any(array $properties): bool
    {
        foreach ($properties as $property) {
            if (isset($this->$property)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Convenience method to check if the contact has any details
     *
     * @return bool
     */
    public function hasDetails(): bool
    {
        return $this->any(['address', 'url', 'email', 'telephone', 'faxNumber']);
    }

    /**
     * Get the formatted name as defined by the name format
     *
     * Parses the name format and replaces the tokens with the values from the
     * contact data. Patterns without known tokens or missing values will be
     * dropped.
     *
     * @see self::NAME_TOKENS
     *
     * @param string|null $format The format of the name
     * @return string The name
     */
    public function formatName(?string $format = null): string
    {
        $result = '';

        $format ??= self::DEFAULT_NAME_FORMAT;

        // Find all parts enclosed in brackets
        preg_match_all('/\[([^\]]+)\]/', $format, $matches);

        foreach ($matches[1] as $part) {
            $token = '';

            foreach (array_keys(self::NAME_TOKENS) as $key) {
                if (strpos($part, $key) !== false) {
                    $token = $key;
                    break;
                }
            }

            if (empty($token)) {
                continue;
            }

            $value = $this->data[self::NAME_TOKENS[$token]] ?? '';
            if (empty($value)) {
                continue;
            }

            // Add formatted part to result - replace the token character with the actual value
            $result .= str_replace($token, $value, $part);
        }

        return $result;
    }

    /**
     * Magic method to access properties directly
     *
     * @param string $name The property to get
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        if (!str_contains($name, '.')) {
            return $this->data[$name] ?? null;
        }

        $keys = explode('.', $name);
        $value = $this->data;

        foreach ($keys as $key) {
            $value = $value[$key] ?? null;
            if ($value === null) {
                break;
            }
        }

        return $value;
    }

    /**
     * Magic method to check if property exists
     *
     * @param string $name The property to check
     * @return bool
     */
    public function __isset(string $name): bool
    {
        if (!str_contains($name, '.')) {
            return isset($this->data[$name]);
        }

        $keys = explode('.', $name);
        $value = $this->data;

        foreach ($keys as $key) {
            if (!isset($value[$key])) {
                return false;
            }

            $value = $value[$key];
        }

        return true;
    }
}
