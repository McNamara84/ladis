<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * SVG Icon component
 *
 * Renders an SVG icon from the SVG sprite
 *
 * @param string $id The ID of the icon from the SVG sprite
 * @param string $class Additional CSS classes
 */
class Icon extends Component
{
    /**
     * Create a new component instance.
     *
     */
    public function __construct(
        public string $id,
        public string $class = '',
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
            <svg {{ $attributes->merge(['class' => 'bi']) }} aria-hidden="true">
                <use xlink:href="#{{ $id }}"></use>
            </svg>
        blade;
    }
}
