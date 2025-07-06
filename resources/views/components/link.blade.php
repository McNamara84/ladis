<a href="{{ $href() }}" {{ $attributes->class(['disabled' => $disabled, 'active' => $isActive()]) }} @if($disabled)
aria-disabled="true" @endif>
    @if($icon)
        <svg class="bi me-2" width="16" height="16" aria-hidden="true">
            <use xlink:href="#{{ $icon }}"></use>
        </svg>
    @endif
    {{ $text }}
</a>
