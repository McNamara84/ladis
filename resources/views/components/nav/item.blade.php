<li class="nav-item">
    <a class="nav-link {{ $disabled ? 'disabled' : (request()->routeIs($route) ? 'active' : '') }}"
        href="{{ $disabled ? '#' : route($route) }}" @if($disabled) aria-disabled="true" @endif>
        {{ $text }}
    </a>
</li>
