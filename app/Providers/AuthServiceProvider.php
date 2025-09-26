<?php

namespace App\Providers;

use App\Models\PartialSurface;
use App\Models\SampleSurface;
use App\Policies\PartialSurfacePolicy;
use App\Policies\SampleSurfacePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        SampleSurface::class => SampleSurfacePolicy::class,
        PartialSurface::class => PartialSurfacePolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
