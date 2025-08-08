<?php

namespace Tests\Unit\Support;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class HelpersTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | localeToBCP47() function
    |--------------------------------------------------------------------------
    |
    | This function converts a locale string to a valid BCP 47 string as used
    | by the HTML language attribute value.
    |
    */
    public function test_localeToBCP47_converts_underscore_to_dash(): void
    {
        $this->assertEquals('de-DE', localeToBCP47('de_DE'));
    }

    public function test_localeToBCP47_uses_current_locale_when_no_parameter(): void
    {
        $this->assertEquals('de', localeToBCP47());
    }

    public function test_localeToBCP47_uses_provided_locale_parameter(): void
    {
        $this->assertEquals('fr-FR', localeToBCP47('fr_FR'));
    }

    public function test_localeToBCP47_handles_already_valid_bcp47_format(): void
    {
        $this->assertEquals('fr-FR', localeToBCP47('fr-FR'));
    }

    /*
    |--------------------------------------------------------------------------
    | formatDate() function
    |--------------------------------------------------------------------------
    |
    | This function formats a date value according to the site configuration and
    | app locale using ISO 8601 format.
    |
    */
    public function test_formatDate_formats_with_default_config(): void
    {
        $this->assertEquals('1. Januar 2025', formatDate('2025-01-01'));
    }

    public function test_formatDate_formats_with_custom_format(): void
    {
        $this->assertEquals('01.01.2025', formatDate('2025-01-01', 'DD.MM.YYYY'));
    }

    public function test_formatDate_formats_with_custom_timezone(): void
    {
        $this->assertEquals('1. Januar 2025', formatDate('2025-01-01', timezone: 'Europe/Berlin'));
    }

    public function test_formatDate_formats_with_custom_locale(): void
    {
        $this->assertEquals('1. January 2025', formatDate('2025-01-01', locale: 'en'));
    }

    public function test_formatDate_accepts_datetime_interface(): void
    {
        $this->assertEquals('1. Januar 2025', formatDate(Carbon::parse('2025-01-01')));
    }

    public function test_formatDate_accepts_extended_iso_date_string(): void
    {
        $this->assertEquals('1. Januar 2025', formatDate('2025-01-01T00:00:00+00:00'));
    }
}
