<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

/**
 * High-level link component
 *
 * @param string|null $route Optional, the route name
 * @param string $text The display text
 * @param bool $disabled Optional, whether the link is disabled
 * @param string $icon Optional ID of an icon from the SVG sprite
 *
 * Additional attributes will be passed to the template
 */
class Link extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string|null $route Optional, the route name
     * @param string $text The display text
     * @param bool $disabled Optional, whether the link is disabled
     * @param string $icon Optional ID of an icon from the SVG sprite
     *
     * Additional attributes will be passed to the template
     */
    public function __construct(
        public ?string $route = null,
        public string $text,
        public bool $disabled = false,
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
        if (!$this->route || $this->disabled) {
            return '#';
        }

        return route($this->route);
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
