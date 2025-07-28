<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use App\Services\Contacts\ContactsService;

/**
 * Contacts Service Provider
 *
 * Registers the ContactService with the application.
 *
 * @since 0.2.0
 */
class ContactsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the contacts service.
     */
    public function register(): void
    {
        $this->app->singleton(
            ContactsService::class,
            fn(Application $app) => new ContactsService()
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [ContactsService::class];
    }
}
