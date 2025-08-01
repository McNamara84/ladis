<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use App\Services\Contacts\ContactsService;
use App\Services\Contacts\Validators\ContactsConfigValidator;

/**
 * Contacts Service Provider
 *
 * Registers the ContactService with the application and validates the configuration.
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
        // Merge the default configuration from the service provider
        $this->mergeConfigFrom(
            __DIR__ . '/../Services/Contacts/config/contacts.php',
            'contacts'
        );

        // Register the contacts service
        $this->app->singleton(
            ContactsService::class,
            concrete: function (Application $app) {
                $config = $app['config']->get('contacts');
                ContactsConfigValidator::validate($config);

                return new ContactsService();
            }
        );
    }

    /**
     * Boot the contacts service.
     */
    public function boot(): void
    {
        $this->publishes([
            app_path('Services/Contacts/config/contacts.php') => config_path('contacts.php'),
        ], 'config');
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
