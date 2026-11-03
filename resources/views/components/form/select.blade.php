@props([
    'name',
    'label',
    'options',
    'value' => null,
    'hint' => null,
    'placeholder' => 'Bitte auswählen',
    'required' => false,
    'optionValue' => 'id',
    'optionLabel' => 'name',
])

<div class="form-group mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    <select 
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $option)
            @if(is_array($option) || is_object($option))
                <option 
                    value="{{ data_get($option, $optionValue) }}" 
                    @selected($value == data_get($option, $optionValue))
                >
                    {{ data_get($option, $optionLabel) }}
                </option>
            @else
                {{-- Simple key => value array --}}
                <option value="{{ $loop->index }}" @selected($value == $loop->index)>
                    {{ $option }}
                </option>
            @endif
        @endforeach
    </select>
    
    @if($hint)
        <div class="form-text">{!! $hint !!}</div>
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
