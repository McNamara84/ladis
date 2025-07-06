<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * High-level link component
 *
 * @param string $route The route name
 * @param string $text The display text
 * @param bool $disabled Whether the link is disabled
 * @param string $class Additional CSS classes
 */
class Link extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $route The route name
     * @param string $text The display text
     * @param bool $disabled Whether the link is disabled
     * @param string $class Additional CSS classes
     * @param string $icon Optional ID of an icon from the SVG sprite
     */
    public function __construct(
        public string $route,
        public string $text,
        public bool $disabled = false,
        public string $class = '',
        public string $icon = '',
    ) {
    }

    /**
     * Get the href for the link element
     *
     * @return string
     */
    public function href(): string
    {
        return $this->disabled ? '#' : route($this->route);
    }

    /**
     * Check if the link elements href is the current route
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
        return view('components.link');
    }
}
