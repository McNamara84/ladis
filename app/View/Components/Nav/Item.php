<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Item component for the navigation bar
 *
 * @param string $route The route name
 * @param string $text The display text
 * @param bool $disabled Whether the item is disabled
 * @param string $class Additional CSS classes
 */
class Item extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $route The route name
     * @param string $text The display text
     * @param bool $disabled Whether the item is disabled
     * @param string $class Additional CSS classes
     */
    public function __construct(
        public string $route,
        public string $text,
        public bool $disabled = false,
        public string $class = '',
    ) {
    }

    /**
     * Get the href for the nav item
     *
     * @return string
     */
    public function href(): string
    {
        return $this->disabled ? '#' : route($this->route);
    }

    /**
     * Check if the nav item is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return request()->routeIs($this->route);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav.item');
    }
}
