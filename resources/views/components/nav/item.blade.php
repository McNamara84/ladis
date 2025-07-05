<li class="nav-item">
    <a {{ $attributes->class(['nav-link', 'disabled' => $disabled, 'active' => request()->routeIs($route)]) }}
        href="{{ $disabled ? '#' : route($route) }}" @if($disabled) aria-disabled="true" @endif>
        {{ $text }}
    </a>
</li>
