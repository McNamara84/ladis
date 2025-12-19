@props([
    'title',
    'width' => 'md-10',
])

<div class="container">
    <div class="row justify-content-center">
        <div class="col-{{ $width }}">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
