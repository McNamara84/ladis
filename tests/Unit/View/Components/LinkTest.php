<?php

namespace Tests\Unit\View\Components;

use Tests\TestCase;
use App\View\Components\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create dummy routes for testing
        Route::get('/test-frontpage', function () {
            return 'test frontpage';
        })->name('test.frontpage');

        Route::get('/test-login', function () {
            return 'test login';
        })->name('test.login');

        Route::getRoutes()->refreshNameLookups();
    }

    public function test_component_can_be_instantiated(): void
    {
        $component = new Link('Test Link');

        $this->assertEquals('Test Link', $component->text);
        $this->assertNull($component->route);
        $this->assertFalse($component->disabled);
        $this->assertEquals('', $component->icon);
    }

    public function test_component_with_all_parameters(): void
    {
        $component = new Link(
            text: 'Home',
            route: 'test.frontpage',
            disabled: true,
            icon: 'home'
        );

        $this->assertEquals('Home', $component->text);
        $this->assertEquals('test.frontpage', $component->route);
        $this->assertTrue($component->disabled);
        $this->assertEquals('home', $component->icon);
    }

    public function test_href_returns_hash_when_disabled(): void
    {
        $component = new Link('Test', 'test.frontpage', disabled: true);

        $this->assertEquals('#', $component->href());
    }

    public function test_href_returns_hash_when_no_route(): void
    {
        $component = new Link('Test');

        $this->assertEquals('#', $component->href());
    }

    public function test_href_returns_route_url(): void
    {
        $component = new Link('Home', 'test.frontpage');

        $this->assertEquals(route('test.frontpage'), $component->href());
    }

    public function test_is_active_returns_true_for_current_route(): void
    {
        // Mock the current request to be on the 'frontpage' route
        $this->get(route('test.frontpage'));

        $component = new Link('Home', 'test.frontpage');

        $this->assertTrue($component->isActive());
    }

    public function test_is_active_returns_false_for_different_route(): void
    {
        $this->get(route('test.frontpage'));

        $component = new Link('Login', 'test.login');

        $this->assertFalse($component->isActive());
    }

    public function test_component_renders_correctly(): void
    {
        $view = $this->component(Link::class, [
            'text' => 'Test Link',
            'route' => 'test.frontpage',
            'disabled' => false,
            'icon' => ''
        ]);

        $view->assertSee('Test Link');
        $view->assertSee(route('test.frontpage'));
    }

    public function test_component_renders_disabled_link(): void
    {
        $view = $this->component(Link::class, [
            'text' => 'Disabled Link',
            'route' => 'test.frontpage',
            'disabled' => true
        ]);

        $view->assertSeeInOrder([
            '<a',
            'href="#"',
            'disabled',
            'aria-disabled="true"',
            '</a>'
        ]);
    }

    public function test_component_renders_with_icon(): void
    {
        $view = $this->component(Link::class, [
            'text' => 'Home',
            'icon' => 'bi-database',
            'route' => 'test.frontpage'
        ]);

        $view->assertSee('has-icon');
        $view->assertSeeInOrder(['<use', 'xlink:href="#bi-database"']);
    }
}
