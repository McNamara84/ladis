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

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share common information about the application as global variables.
        View::share('appVersion', config('app.version'));
        View::share('appName', config('app.name'));
        View::share('appTagline', "Datenbank zum Einsatz von Lasertechnik in der Restaurierung.");
    }
}
