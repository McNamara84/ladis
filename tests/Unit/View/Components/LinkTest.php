<?php

namespace Tests\Unit\View\Components;

use Tests\TestCase;
use App\View\Components\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

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
            route: 'frontpage',
            disabled: true,
            icon: 'home'
        );

        $this->assertEquals('Home', $component->text);
        $this->assertEquals('frontpage', $component->route);
        $this->assertTrue($component->disabled);
        $this->assertEquals('home', $component->icon);
    }

    public function test_href_returns_hash_when_disabled(): void
    {
        $component = new Link('Test', 'frontpage', disabled: true);

        $this->assertEquals('#', $component->href());
    }

    public function test_href_returns_hash_when_no_route(): void
    {
        $component = new Link('Test');

        $this->assertEquals('#', $component->href());
    }

    public function test_href_returns_route_url(): void
    {
        $component = new Link('Home', 'frontpage');

        $this->assertEquals(route('frontpage'), $component->href());
    }

    public function test_is_active_returns_true_for_current_route(): void
    {
        // Mock the current request to be on the 'frontpage' route
        $this->get(route('frontpage'));

        $component = new Link('Home', 'frontpage');

        $this->assertTrue($component->isActive());
    }

    public function test_is_active_returns_false_for_different_route(): void
    {
        $this->get(route('frontpage'));

        $component = new Link('Login', 'login');

        $this->assertFalse($component->isActive());
    }
}
