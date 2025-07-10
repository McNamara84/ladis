@php
    use Illuminate\Support\Arr;

    // This is a workaround to avoid the class attribute being set to an empty string.
    $classes = Arr::toCssClasses([
        'disabled' => $disabled,
        'active' => $isActive(),
        'has-icon' => $icon,
    ]);
@endphp

<a href="{{ $href() }}" {{ $attributes->merge([
    'class' => $classes ?: null,
]) }} @if($disabled) aria-disabled="true"
@endif>
    @if($icon)
        <x-icon :$icon class="me-2" />
    @endif
    <span class="link-text">{{ $text }}</span>
</a>
