<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Stringable;

/**
 * Contact component
 *
 * Renders contact information in a structured way.
 *
 * @package App\View\Components
 * @since 0.2.0
 */
class Contact extends Component
{

    /**
     * Valid Schema.org types
     *
     * Types valid for the top-level `itemscope` of the contact element
     * e.g. `https://schema.org/<TYPE>`.
     *
     * @var list<string>
     */
    protected const array SCHEMA_ORG_TYPES = [
        'Person',
        'Organization',
        // Specific Organization Types
        'Airline',
        'Consortium',
        'Cooperative',
        'Corporation',
        'EducationalOrganization',
        'FundingScheme',
        'GovernmentOrganization',
        'LibrarySystem',
        'LocalBusiness',
        'MedicalOrganization',
        'NGO',
        'NewsMediaOrganization',
        'OnlineBusiness',
        'PerformingGroup',
        'PoliticalParty',
        'Project',
        'ResearchOrganization',
        'SearchRescueOrganization',
        'SportsOrganization',
        'WorkersUnion',
    ];

    /**
     * Tokens for the name format
     *
     * @var array<string, string>
     */
    protected const array NAME_TOKENS = [
        'n' => 'name',
        'A' => 'name_abbreviation',
        'a' => 'name_adjunct',
    ];

    /**
     * The default name format
     *
     * @var string
     */
    protected const string DEFAULT_NAME_FORMAT = '[n][ (A)][ <br> a][x]';

    /**
     * Poor man's cache for formatted names
     *
     * @var array<string, string>
     */
    protected array $cache = [];

    /**
     * Create a new component instance.
     *
     * @param array $contact The contact information
     * @param string $name_format The format of the name
     */
    public function __construct(
        public array $contact,
        public string $name_format = self::DEFAULT_NAME_FORMAT,
    ) {
    }

    /**
     * Checks if contact.type is a valid Schema.org item type
     *
     * @return bool
     */
    public function isValidType(): bool
    {
        return in_array($this->contact['type'], self::SCHEMA_ORG_TYPES);
    }

    /**
     * Get the formatted name
     *
     * @param string|null $format The format of the name, overrides the attribute
     * @return string The name
     */
    public function name(?string $format = null): string
    {
        // If no format is provided, use the attribute
        $format ??= $this->name_format;

        // If the result is cached, return it
        $result = $this->cache[$format] ?? '';
        if (!empty($result)) {
            return $result;
        }

        // Find all parts enclosed in brackets
        preg_match_all('/\[([^\]]+)\]/', $format, $matches);

        foreach ($matches[1] as $index => $part) {
            $match = $matches[0][$index];

            // Find the token in this part
            $token = '';

            foreach (array_keys(self::NAME_TOKENS) as $key) {
                if (strpos($part, $key) !== false) {
                    $token = $key;
                    break;
                }
            }

            // If no token is found, skip this part
            if (empty($token)) {
                Log::warning(
                    'Skipping match without known token',
                    [
                        'match' => $match,
                        '@origin' => __METHOD__,
                    ]
                );
                continue;
            }

            // Get the value for the token and check if it is empty
            $value = $this->contact[self::NAME_TOKENS[$token]] ?? '';

            if (empty($value)) {
                Log::warning(
                    'Skipping match with empty value for token',
                    [
                        'match' => $match,
                        'token' => $token,
                        '@origin' => __METHOD__,
                    ]
                );
                continue;
            }

            // Add formatted part to result - replace the token character with the actual value
            $result .= str_replace($token, $value, $part);
        }

        // Cache the result so we don't have to recalculate it next time
        $this->cache[$format] = $result;

        return $result;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact');
    }

}
