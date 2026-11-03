@props([
    'name',
    'label',
    'value' => null,
    'hint' => null,
    'placeholder' => null,
    'required' => false,
    'rows' => 3,
])

<div class="form-group mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    <textarea 
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        {{ $attributes }}
    >{{ $value }}</textarea>
    
    @if($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
