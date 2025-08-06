<?php

namespace Tests\Feature\Providers;

use Tests\TestCase;
use Illuminate\Support\Facades\View;

class ViewServiceProviderTest extends TestCase
{
    public function test_view_service_provider_loads_common_information(): void
    {
        $shared = View::getShared();

        $this->assertArrayHasKey('appVersion', $shared);
        $this->assertArrayHasKey('appName', $shared);
        $this->assertArrayHasKey('appNameLong', $shared);
        $this->assertArrayHasKey('appNameFull', $shared);
        $this->assertArrayHasKey('appTagline', $shared);
        $this->assertArrayHasKey('appContactPrimary', $shared);
        $this->assertArrayHasKey('appRepoPlatformName', $shared);
        $this->assertArrayHasKey('appRepoURL', $shared);
        $this->assertArrayHasKey('appRepoIcon', $shared);
        $this->assertArrayHasKey('appLicenseName', $shared);
        $this->assertArrayHasKey('appLicenseShortName', $shared);
        $this->assertArrayHasKey('appLicenseURL', $shared);
    }
}
