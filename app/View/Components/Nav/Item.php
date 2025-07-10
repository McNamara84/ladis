<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Item component for the navigation bar
 *
 * @param string $text The display text
 * @param string|null $route Optional, the route name
 * @param bool $disabled Optional, whether the item is disabled
 * @param string $icon Optional ID of an icon from the SVG sprite
 *
 * Additional attributes will be passed to the template
 */
class Item extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $text The display text
     * @param string|null $route Optional, the route name
     * @param bool $disabled Optional, whether the item is disabled
     * @param string $icon Optional ID of an icon from the SVG sprite
     *
     * Additional attributes will be passed to the template
     */
    public function __construct(
        public string $text,
        public ?string $route = null,
        public bool $disabled = false,
        public string $icon = '',
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav.item');
    }
}
