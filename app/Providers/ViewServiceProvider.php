<?php

/**
 * View Service Provider
 *
 * This service provider is responsible for making global variables available
 * to all Blade view templates throughout the application. It uses Laravel's
 * View::share() method to inject variables that can be accessed directly
 * in any Blade template without needing to pass them from controllers.
 *
 * @package App\Providers
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\Contacts\ContactsService;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share common information about the application as global variables.
        // ToDo: Get these values from the repo or at least from env/config

        // General app metadata
        View::share('appVersion', config('app.version'));
        View::share('appName', config('app.name'));
        View::share('appNameLong', config('app.name_long'));
        View::share('appNameFull', config('app.name_full'));
        View::share('appTagline', "Datenbank zum Einsatz von Lasertechnik in der Restaurierung.");

        // Contact information - Use a closure to defer ContactsService access
        View::share('appContactPrimary', function () {
            $contactsService = app(ContactsService::class);
            return $contactsService->{config('site.contact.primary')};
        });

        // Code repository information
        View::share('appRepoPlatformName', 'GitHub');
        View::share('appRepoURL', 'https://github.com/McNamara84/ladis');
        View::share('appRepoIcon', 'bi-github');

        // License information
        View::share('appLicenseName', 'GNU General Public License v3');
        View::share('appLicenseShortName', 'GPL v3');
        View::share('appLicenseURL', 'https://www.gnu.org/licenses/gpl-3.0.html#license-text');
    }
}
