<li class="nav-item">
    <a href="{{ $href() }}" {{ $attributes->class(['nav-link', 'disabled' => $disabled, 'active' => $isActive()]) }}
        @if($disabled) aria-disabled="true" @endif>
        {{ $text }}
    </a>
</li>
