@extends('layouts.app')

@section('title', 'Teilfläche: ' . ($partialSurface->identifier ?? '#' . $partialSurface->id))

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('partial_surfaces.all') }}">Teilflächen</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $partialSurface->identifier ?? ('Teilfläche #' . $partialSurface->id) }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-6 fw-semibold mb-2">{{ $partialSurface->identifier ?? ('Teilfläche #' . $partialSurface->id) }}</h1>
            <p class="lead text-muted mb-0">{{ $partialSurface->sampleSurface?->name ?? 'Probenfläche unbekannt' }}</p>
        </header>

        <section class="mb-5" aria-labelledby="partial-surface-overview-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="partial-surface-overview-title" class="h4 mb-0">Überblick</h2>
                </div>
                <div class="card-body">
                    <dl class="row g-3 mb-0">
                        <dt class="col-md-3">Probenfläche</dt>
                        <dd class="col-md-9">
                            @if ($partialSurface->sampleSurface)
                                <a href="{{ route('sample_surfaces.show', $partialSurface->sampleSurface) }}">{{ $partialSurface->sampleSurface->name }}</a>
                            @else
                                <span class="text-muted">Keine Probenfläche hinterlegt.</span>
                            @endif
                        </dd>

                        <dt class="col-md-3">Artefakt</dt>
                        <dd class="col-md-9">{{ $partialSurface->sampleSurface?->artifact?->name ?? '–' }}</dd>

                        <dt class="col-md-3">Größe</dt>
                        <dd class="col-md-9">{{ $partialSurface->size ? number_format((float) $partialSurface->size, 2, ',', '.') . ' cm²' : '–' }}</dd>
                    </dl>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="partial-surface-materials-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="partial-surface-materials-title" class="h4 mb-0">Materialien &amp; Zustände</h2>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h3 class="h5">Ausgangszustand</h3>
                            <p class="mb-1"><strong>Grundmaterial:</strong> {{ $partialSurface->foundationMaterial?->name ?? '–' }}</p>
                            <p class="mb-1"><strong>Beschichtung:</strong> {{ $partialSurface->coatingMaterial?->name ?? '–' }}</p>
                            <p class="mb-0"><strong>Zustand:</strong> {{ $partialSurface->condition?->description ?? '–' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h5">Ergebnis</h3>
                            <p class="mb-1"><strong>Zustand:</strong> {{ $partialSurface->result?->description ?? '–' }}</p>
                            <p class="mb-0"><strong>Schadensmuster:</strong> {{ $partialSurface->result?->damagePattern?->name ?? '–' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section aria-labelledby="partial-surface-process-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="partial-surface-process-title" class="h4 mb-0">Verknüpfter Prozess</h2>
                </div>
                <div class="card-body">
                    @if ($partialSurface->process)
                        <dl class="row g-3 mb-0">
                            <dt class="col-md-3">Gerät</dt>
                            <dd class="col-md-9">
                                <a href="{{ route('devices.show', $partialSurface->process->device) }}">{{ $partialSurface->process->device->name }}</a>
                                <span class="text-muted">{{ $partialSurface->process->device->institution?->name }}</span>
                            </dd>

                            <dt class="col-md-3">Konfiguration</dt>
                            <dd class="col-md-9">
                                {{ $partialSurface->process->configuration?->lens?->size ? $partialSurface->process->configuration->lens->size . ' mm Linse' : '–' }}
                            </dd>

                            <dt class="col-md-3">Details</dt>
                            <dd class="col-md-9">
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('processes.show', $partialSurface->process) }}">
                                    Prozess ansehen
                                </a>
                            </dd>
                        </dl>
                    @else
                        <p class="mb-0 text-muted">Dieser Teilfläche ist kein Prozess zugeordnet.</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection