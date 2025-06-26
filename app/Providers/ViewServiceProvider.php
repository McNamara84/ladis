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
        // Share project version number as a global variable.
        // This MUST be kept in sync with the version in the
        // `package.json` and `composer.json` files.
        View::share('projectVersion', config('app.version'));
    }
}
