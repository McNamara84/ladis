@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'hint' => null,
    'placeholder' => null,
    'required' => false,
    'step' => null,
    'min' => null,
    'max' => null,
])

<div class="form-group mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    <input 
        type="{{ $type }}"
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($step) step="{{ $step }}" @endif
        @if($min) min="{{ $min }}" @endif
        @if($max) max="{{ $max }}" @endif
        @if($required) required @endif
        {{ $attributes }}
    >
    
    @if($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
