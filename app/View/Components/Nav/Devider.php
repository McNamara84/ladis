<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Devider component for the navigation bar
 */
class Devider extends Component
{
    /**
     * Create a new component instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
            <li class="nav-item">
                <div class="vr d-none d-lg-flex h-100 mx-lg-2"></div>
                <hr class="d-lg-none">
            </li>
        blade;
    }
}
