@extends('layouts.app')

@section('title', 'Prozess #' . $process->id)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('processes.all') }}">Prozesse</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prozess #{{ $process->id }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-6 fw-semibold mb-2">Prozess #{{ $process->id }}</h1>
            <p class="lead text-muted mb-0">Detailansicht des Bearbeitungsprozesses inklusive Materialien und Ergebnisse.</p>
        </header>

        <section class="mb-5" aria-labelledby="process-context-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="process-context-title" class="h4 mb-0">Kontext</h2>
                </div>
                <div class="card-body">
                    <dl class="row g-3 mb-0">
                        <dt class="col-md-4">Gerät</dt>
                        <dd class="col-md-8">
                            <a href="{{ route('devices.show', $process->device) }}">{{ $process->device->name }}</a>
                            <span class="text-muted">{{ $process->device->institution?->name }}</span>
                        </dd>

                        <dt class="col-md-4">Teilfläche</dt>
                        <dd class="col-md-8">
                            @if ($process->partialSurface)
                                <a href="{{ route('partial_surfaces.show', $process->partialSurface) }}">
                                    {{ $process->partialSurface->identifier ?? ('Teilfläche #' . $process->partialSurface->id) }}
                                </a>
                                <span class="text-muted d-block">{{ $process->partialSurface->sampleSurface?->artifact?->name ?? 'Artefakt unbekannt' }}</span>
                                <span class="text-muted small">{{ $process->partialSurface->sampleSurface?->artifact?->location?->venue?->name }}</span>
                            @else
                                <span class="text-muted">Keine Teilfläche zugeordnet.</span>
                            @endif
                        </dd>

                        <dt class="col-md-4">Dauer</dt>
                        <dd class="col-md-8">{{ $process->duration ?? '–' }} Minuten</dd>

                        <dt class="col-md-4">Wasser / Trocken</dt>
                        <dd class="col-md-8">{{ $process->wet ? 'Nass' : 'Trocken' }}</dd>
                    </dl>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="process-configuration-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="process-configuration-title" class="h4 mb-0">Konfiguration</h2>
                </div>
                <div class="card-body">
                    @if ($process->configuration)
                        <dl class="row g-3 mb-0">
                            <dt class="col-md-4">Linse</dt>
                            <dd class="col-md-8">{{ $process->configuration->lens?->size ? $process->configuration->lens->size . ' mm' : '–' }}</dd>

                            <dt class="col-md-4">Ausgangsleistung</dt>
                            <dd class="col-md-8">{{ $process->configuration->output ?? '–' }} W</dd>

                            <dt class="col-md-4">Pulsfrequenz</dt>
                            <dd class="col-md-8">{{ $process->configuration->pf ?? '–' }} Hz</dd>

                            <dt class="col-md-4">Pulsenergie</dt>
                            <dd class="col-md-8">{{ $process->configuration->pw ?? '–' }} µs</dd>
                        </dl>
                    @else
                        <p class="mb-0 text-muted">Es wurden keine Konfigurationsdaten hinterlegt.</p>
                    @endif
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="process-materials-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="process-materials-title" class="h4 mb-0">Materialien &amp; Zustände</h2>
                </div>
                <div class="card-body">
                    @if ($process->partialSurface)
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h3 class="h5">Ausgangssituation</h3>
                                <p class="mb-1"><strong>Grundmaterial:</strong> {{ $process->partialSurface->foundationMaterial?->name ?? '–' }}</p>
                                <p class="mb-1"><strong>Beschichtung:</strong> {{ $process->partialSurface->coatingMaterial?->name ?? '–' }}</p>
                                <p class="mb-0"><strong>Zustand:</strong> {{ $process->partialSurface->condition?->description ?? '–' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5">Ergebnis</h3>
                                <p class="mb-1"><strong>Zustand:</strong> {{ $process->partialSurface->result?->description ?? '–' }}</p>
                                <p class="mb-0"><strong>Größe:</strong> {{ $process->partialSurface->size ? number_format((float) $process->partialSurface->size, 2, ',', '.') . ' cm²' : '–' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="mb-0 text-muted">Es sind keine Materialdaten vorhanden.</p>
                    @endif
                </div>
            </div>
        </section>

        <section aria-labelledby="process-media-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="process-media-title" class="h4 mb-0">Dokumentation</h2>
                    <span class="badge text-bg-light">{{ $process->partialSurface?->condition?->images->count() + $process->partialSurface?->result?->images->count() }}</span>
                </div>
                <div class="card-body">
                    @php($images = $process->partialSurface?->condition?->images->merge($process->partialSurface?->result?->images ?? collect()) ?? collect())

                    @if ($images->isEmpty())
                        <p class="mb-0 text-muted">Für diesen Prozess wurden keine Bilder gespeichert.</p>
                    @else
                        <div class="row g-4">
                            @foreach ($images as $image)
                                <article class="col-md-6 col-lg-4" aria-label="Bild {{ $loop->iteration }}">
                                    <div class="card h-100 shadow-sm">
                                        <div class="ratio ratio-4x3 bg-body-secondary rounded-top">
                                            <img src="{{ Storage::url($image->uri) }}" alt="{{ $image->alt_text }}" class="w-100 h-100 object-fit-cover rounded-top">
                                        </div>
                                        <div class="card-body">
                                            <h3 class="h6">{{ $image->description ?? 'Ohne Beschreibung' }}</h3>
                                            <p class="text-muted small mb-0">{{ $image->creator }} · {{ $image->year_created }}</p>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection