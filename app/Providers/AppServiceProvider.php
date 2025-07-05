<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\PasswordReset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            PasswordReset::class,
            static function (PasswordReset $event): void {
                if (! $event->user->hasVerifiedEmail()) {
                    $event->user->markEmailAsVerified();
                }
            }
        );
    }
}
