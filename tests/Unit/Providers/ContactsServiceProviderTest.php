<?php

namespace Tests\Unit\Providers;

use Tests\TestCase;
use App\Providers\ContactsServiceProvider;
use App\Services\Contacts\ContactsService;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Mockery;

class ContactsServiceProviderTest extends TestCase
{
    protected ContactsServiceProvider $provider;

    protected string $contactsConfigPath;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('contacts', [
            'cache_key' => 'test_contacts',
            'storage' => [
                'directory' => 'test/contacts',
                'file_extension' => '.json'
            ]
        ]);

        $this->provider = new ContactsServiceProvider($this->app);
        $this->contactsConfigPath = app_path('Services/Contacts/config/contacts.php');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function getDefaultConfig(): array
    {
        return require $this->contactsConfigPath;
    }

    private function setInvalidConfig(): void
    {
        Config::set('contacts.cache_key', '');
    }

    public function test_implements_deferrable_provider_interface(): void
    {
        $this->assertInstanceOf(
            \Illuminate\Contracts\Support\DeferrableProvider::class,
            $this->provider
        );
    }

    public function test_provides_returns_contacts_service_class(): void
    {
        $this->assertEquals(
            [ContactsService::class],
            $this->provider->provides()
        );
    }

    public function test_config_is_merged_during_registration(): void
    {
        // Start with empty contacts config
        Config::set('contacts', []);
        $this->assertEmpty(Config::get('contacts'));

        $this->provider->register();

        // Verify config was merged from the service provider's config file
        $expectedConfig = $this->getDefaultConfig();
        $this->assertEquals($expectedConfig, Config::get('contacts'));
    }

    public function test_service_is_registered_as_singleton(): void
    {
        $this->provider->register();

        // Test that the service is bound in the container
        $this->assertTrue($this->app->bound(ContactsService::class));

        // Test that it's registered as a singleton (without resolving it)
        $abstract = ContactsService::class;
        $concrete = $this->app->getBindings()[$abstract] ?? null;

        $this->assertNotNull($concrete);
        $this->assertTrue($concrete['shared']); // This indicates it's a singleton
    }

    public function test_publishes_mapping_is_registered(): void
    {
        $this->provider->boot();

        // Use reflection to access the protected publishes property
        $reflection = new \ReflectionClass($this->provider);
        $publishesProperty = $reflection->getProperty('publishes');
        $publishesProperty->setAccessible(true);
        $publishes = $publishesProperty->getValue($this->provider);

        $providerClass = ContactsServiceProvider::class;
        $sourcePath = $this->contactsConfigPath;
        $targetPath = config_path('contacts.php');

        $this->assertArrayHasKey($providerClass, $publishes);
        $this->assertArrayHasKey($sourcePath, $publishes[$providerClass]);
        $this->assertEquals($targetPath, $publishes[$providerClass][$sourcePath]);
    }

    public function test_service_resolution_fails_with_invalid_config(): void
    {
        $this->setInvalidConfig();
        $this->provider->register();

        // Expect validation exception when trying to resolve the service
        $this->expectException(ValidationException::class);
        $this->app->make(ContactsService::class);
    }

    public function test_service_can_be_resolved_with_valid_config(): void
    {
        $this->provider->register();

        $service = $this->app->make(ContactsService::class);

        $this->assertInstanceOf(ContactsService::class, $service);
    }

    public function test_same_instance_is_returned_on_multiple_resolutions(): void
    {
        $this->provider->register();

        $service1 = $this->app->make(ContactsService::class);
        $service2 = $this->app->make(ContactsService::class);

        $this->assertSame($service1, $service2);
    }
}
