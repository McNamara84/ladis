@props(['showRequiredHint' => false])

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Session Error --}}
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Session Success --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Optional: Required Fields Hint --}}
@if ($showRequiredHint)
    <p class="text-muted mb-3">
        Pflichtfelder sind mit <span class="text-danger">*</span> gekennzeichnet.
    </p>
@endif
