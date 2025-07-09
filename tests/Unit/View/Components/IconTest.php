<?php

namespace Tests\Unit\View\Components;

use Tests\TestCase;
use App\View\Components\Icon;

class IconTest extends TestCase
{
    public function test_component_can_be_instantiated(): void
    {
        $component = new Icon('bi-home');

        $this->assertEquals('bi-home', $component->icon);
    }

    public function test_component_with_ladis_logo(): void
    {
        $component = new Icon('ladis-logo');

        $this->assertEquals('ladis-logo', $component->icon);
    }

    public function test_prefix_extracts_first_part_correctly(): void
    {
        $component = new Icon('bi-home');
        $reflection = new \ReflectionClass($component);
        $prefixMethod = $reflection->getMethod('prefix');
        $prefixMethod->setAccessible(true);

        $this->assertEquals('bi', $prefixMethod->invoke($component));
    }

    public function test_prefix_with_multiple_dashes(): void
    {
        $component = new Icon('custom-icon-name');
        $reflection = new \ReflectionClass($component);
        $prefixMethod = $reflection->getMethod('prefix');
        $prefixMethod->setAccessible(true);

        $this->assertEquals('custom', $prefixMethod->invoke($component));
    }

    public function test_prefix_with_no_dashes(): void
    {
        $component = new Icon('singleword');
        $reflection = new \ReflectionClass($component);
        $prefixMethod = $reflection->getMethod('prefix');
        $prefixMethod->setAccessible(true);

        $this->assertEquals('singleword', $prefixMethod->invoke($component));
    }
}
