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
 * @param string $icon The ID of the icon from the SVG sprite
 */
class Icon extends Component
{

    /**
     * Maps prefixes of icon IDs to base CSS classes
     *
     * @var array<string>
     */
    protected const BASE_CLASSES = [
        // Bootstrap Icons
        'bi' => 'bi',
    ];

    /**
     * Create a new component instance.
     *
     */
    public function __construct(
        public string $icon,
    ) {
    }

    /**
     * Get the prefix of the icon
     *
     * @return string
     */
    protected function prefix(): string
    {
        return explode('-', $this->icon)[0];
    }

    /**
     * Get the base CSS class of the icon
     *
     * @return string
     */
    public function baseClass(): string
    {
        // Special case for the LADIS logo because naming is a bit inconsistent
        // and we don't really have an icon namespace for it
        if ($this->icon === 'ladis-logo') {
            return 'app-logo';
        }

        return self::BASE_CLASSES[$this->prefix()] ?? 'icon';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
            <svg {{ $attributes->class([$baseClass(), $icon]) }} aria-hidden="true">
                <use xlink:href="#{{ $icon }}"></use>
            </svg>
        blade;
    }
}
