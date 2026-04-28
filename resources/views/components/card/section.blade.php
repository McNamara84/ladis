@props([
    'id' => null,
    'title',
    'count' => null,
])

@php
    $sectionId = $id ?? Str::slug($title) . '-title';
@endphp

<section class="mb-5" aria-labelledby="{{ $sectionId }}">
    <div class="card shadow-sm h-100">
        <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
            <h2 id="{{ $sectionId }}" class="h4 mb-0">{{ $title }}</h2>
            @if(!is_null($count))
                <span class="badge text-bg-light">{{ $count }}</span>
            @endif
        </div>
        <div {{ $attributes->merge(['class' => 'card-body']) }}>
            {{ $slot }}
        </div>
    </div>
</section>
