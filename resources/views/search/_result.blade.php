<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('icon-512.png') }}" class="img-fluid rounded-start" alt="{{ $device->name }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $device->name }}</h5>
                <p class="card-text mb-1"><small class="text-muted">Baujahr: {{ $device->year ?? '–' }}</small></p>
                <p class="card-text mb-1"><small class="text-muted">Max. Leistung: {{ $device->max_output ?? '–' }} {{ $device->max_output ? 'W' : '' }}</small></p>
            </div>
        </div>
    </div>
</div>