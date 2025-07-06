<a href="{{ $href() }}" {{ $attributes->class(['disabled' => $disabled, 'active' => $isActive()]) }} @if($disabled)
aria-disabled="true" @endif>
    @if($icon)
        <x-icon :$icon class="me-2" />
    @endif
    {{ $text }}
</a>
