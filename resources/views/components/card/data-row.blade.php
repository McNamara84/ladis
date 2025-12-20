@props([
    'label',
    'value' => null,
    'fallback' => '–',
    'dtClass' => 'col-lg-3',
    'ddClass' => 'col-lg-9',
])

<dt class="{{ $dtClass }}">{{ $label }}</dt>
<dd class="{{ $ddClass }}">
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        {{ $value ?? $fallback }}
    @endif
</dd>
