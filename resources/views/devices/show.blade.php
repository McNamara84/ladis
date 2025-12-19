@extends('layouts.app')

@section('title', 'Lasergerät: ' . $device->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('devices.all') }}">Lasergeräte</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $device->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $device->name }}</h1>
            <p class="lead text-muted mb-0">
                @if ($device->institution)
                    Lasergerät der Institution
                    <a href="{{ route('institutions.show', $device->institution) }}"
                        class="link-underline link-underline-opacity-0">{{ $device->institution->name }}</a>
                @else
                    Lasergerät ohne zugewiesene Institution
                @endif
            </p>
        </header>

        <x-card.section id="device-overview-title" title="Überblick" class="h-100">
            <dl class="row g-3 mb-0">
                <x-card.data-row label="Gerätenummer" :value="$device->id" dt-class="col-lg-3" dd-class="col-lg-9" />
                <x-card.data-row label="Baujahr" :value="$device->year" dt-class="col-lg-3" dd-class="col-lg-9" />
                <x-card.data-row label="Bauart" :value="$device->build_type" dt-class="col-lg-3" dd-class="col-lg-9" />
                <x-card.data-row label="Strahltyp" :value="$device->beam_type_name" dt-class="col-lg-3" dd-class="col-lg-9" />

                <x-card.data-row label="Max. Leistung" dt-class="col-lg-3" dd-class="col-lg-9">
                    {{ $device->max_output ? number_format($device->max_output, 2, ',', '.') . ' W' : '–' }}
                </x-card.data-row>

                <x-card.data-row label="Kühlung" :value="$device->cooling_type" dt-class="col-lg-3" dd-class="col-lg-9" />

                <x-card.data-row label="Automatisierung" dt-class="col-lg-3" dd-class="col-lg-9">
                    <span class="badge {{ $device->automation ? 'bg-success-subtle text-success-emphasis' : 'bg-secondary-subtle text-secondary-emphasis' }}">
                        {{ $device->automation ? 'Automatisiert' : 'Manuell' }}
                    </span>
                </x-card.data-row>

                <x-card.data-row label="Zuletzt bearbeitet durch" :value="$device->lastEditor?->name" dt-class="col-lg-3" dd-class="col-lg-9" />
            </dl>
        </x-card.section>

        <x-card.section id="device-specifications-title" title="Technische Spezifikationen" class="h-100">
            <div class="row gy-4">
                <div class="col-md-6">
                    <h3 class="h5">Optik</h3>
                    <ul class="list-unstyled mb-0" aria-label="Optische Eigenschaften">
                        <li><strong>Wellenlänge:</strong> {{ $device->wavelength ? $device->wavelength . ' nm' : '–' }}</li>
                        <li><strong>Spot-Größe:</strong>
                            @if ($device->min_spot_size || $device->max_spot_size)
                                {{ $device->min_spot_size ?? '–' }} – {{ $device->max_spot_size ?? '–' }} mm
                            @else
                                –
                            @endif
                        </li>
                        <li><strong>Scanfeld:</strong>
                            @if ($device->min_scan_width || $device->max_scan_width)
                                {{ $device->min_scan_width ?? '–' }} – {{ $device->max_scan_width ?? '–' }} mm
                            @else
                                –
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3 class="h5">Mechanik</h3>
                    <ul class="list-unstyled mb-0" aria-label="Mechanische Eigenschaften">
                        <li><strong>Abmessungen (H × B × T):</strong>
                            @if ($device->height || $device->width || $device->depth)
                                {{ $device->height ?? '–' }} × {{ $device->width ?? '–' }} × {{ $device->depth ?? '–' }} mm
                            @else
                                –
                            @endif
                        </li>
                        <li><strong>Gewicht:</strong>
                            {{ $device->weight ? number_format((float) $device->weight, 2, ',', '.') . ' kg' : '–' }}
                        </li>
                        <li><strong>Faserlänge:</strong>
                            {{ $device->fiber_length ? number_format((float) $device->fiber_length, 2, ',', '.') . ' m' : '–' }}
                        </li>
                    </ul>
                </div>
            </div>
        </x-card.section>

        <x-card.section id="device-lenses-title" title="Verfügbare Linsen" :count="$device->lenses->count()" class="h-100">
            @if ($device->lenses->isEmpty())
                <p class="mb-0 text-muted">Für dieses Gerät wurden noch keine Linsen dokumentiert.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($device->lenses as $lens)
                        <li class="list-group-item d-flex flex-column flex-md-row gap-2 justify-content-between">
                            <div>
                                <strong>Linse #{{ $lens->id }}</strong>
                                <p class="mb-0 text-muted">Größe: {{ $lens->size }} mm</p>
                            </div>
                            <div class="text-md-end">
                                <span class="badge text-bg-primary">Konfigurationen: {{ $lens->configurations->count() }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-card.section>

        <x-card.section id="device-processes-title" title="Durchgeführte Prozesse" :count="$device->processes->count()" class="p-0">
            @if ($device->processes->isEmpty())
                <p class="px-4 py-3 mb-0 text-muted">Zu diesem Gerät wurden noch keine Prozesse dokumentiert.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Prozess-ID</th>
                                <th scope="col">Teilfläche</th>
                                <th scope="col">Artefakt</th>
                                <th scope="col">Ort</th>
                                <th scope="col" class="text-end">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($device->processes as $process)
                                @php($partial = $process->partialSurface)
                                <tr>
                                    <th scope="row">#{{ $process->id }}</th>
                                    <td>{{ $partial?->identifier ?? '–' }}</td>
                                    <td>{{ $partial?->sampleSurface?->artifact?->name ?? '–' }}</td>
                                    <td>
                                        {{ $partial?->sampleSurface?->artifact?->location?->venue?->name ?? '–' }}<br>
                                        <span class="text-muted small">
                                            {{ $partial?->sampleSurface?->artifact?->location?->venue?->city?->name ?? '' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        @auth
                                            <a class="btn btn-outline-secondary btn-sm"
                                                href="{{ route('processes.show', $process) }}">
                                                Details anzeigen
                                            </a>
                                        @else
                                            <span class="text-muted small">Anmeldung erforderlich</span>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-card.section>
    </div>
@endsection