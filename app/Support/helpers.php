<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Global helpers and utility functions
|--------------------------------------------------------------------------
|
| This file contains small, reusable helper and utility functions that can
| be accessed anywhere in the application. It is autoloaded via Composer,
| so any functions defined here are available globally without the need
| for manual inclusion.
|
| Keep this file concise — only include lightweight helpers that are used
| frequently across the application to maintain clarity and performance.
|
*/

if (!function_exists('localeToBCP47')) {
    /**
     * Convert a locale string to a valid BCP 47 string as used by the HTML
     * language attribute value.
     *
     * Example:
     *   localeToBCP47(); // "de-DE" if app locale is "de_DE"
     *
     * @param string|null $locale Optional locale. Defaults to the current application locale.
     * @return string HTML-compliant language tag (BCP 47 format).
     */
    function localeToBCP47(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();

        return str_replace('_', '-', $locale);
    }
}

if (!function_exists('formatDate')) {
    /**
     * Format a date value according to the site configuration and app locale.
     *
     * Converts the given date to the configured site timezone and formats it
     * using Carbon's ISO date format patterns, localized to the current application
     * locale or the provided locale.
     *
     * @param \DateTimeInterface|string $date The date to format.
     * @param string|null               $format Optional ISO format pattern. Defaults to SITE_DATEFORMAT,
     * @param string|null               $timezone Optional timezone identifier. Defaults to SITE_TIMEZONE.
     * @param string|null               $locale Optional locale. Defaults to the current application locale.
     *
     * @return string The formatted date string.
     */
    function formatDate(
        \DateTimeInterface|string $date,
        ?string $format = null,
        ?string $timezone = null,
        ?string $locale = null
    ): string {
        $format ??= config('site.date_format');
        $timezone ??= config('site.timezone');
        $locale ??= app()->getLocale();

        return Carbon::parse($date)
            ->timezone($timezone)
            ->locale($locale)
            ->isoFormat($format);
    }
}
