@extends('layouts.app')

@section('title', 'Zustand #' . $condition->id)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('damage_patterns.all') }}">Schadensmuster</a></li>
                @if ($condition->damagePattern)
                    <li class="breadcrumb-item"><a href="{{ route('damage_patterns.show', $condition->damagePattern) }}">{{ $condition->damagePattern->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Zustand #{{ $condition->id }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-6 fw-semibold mb-2">Zustand #{{ $condition->id }}</h1>
            <p class="lead text-muted mb-0">
                @if ($condition->damagePattern)
                    Schadensmuster: <a href="{{ route('damage_patterns.show', $condition->damagePattern) }}">{{ $condition->damagePattern->name }}</a>
                @else
                    Kein Schadensmuster zugeordnet
                @endif
            </p>
        </header>

        <section class="mb-5" aria-labelledby="condition-overview-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="condition-overview-title" class="h4 mb-0">Beschreibung</h2>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $condition->description ?? 'Keine Beschreibung vorhanden.' }}</p>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="condition-properties-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="condition-properties-title" class="h4 mb-0">Eigenschaften</h2>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <dl class="row g-2 mb-0">
                                <dt class="col-sm-5">Schweregrad</dt>
                                <dd class="col-sm-7">{{ $condition->severity ?? '–' }}</dd>

                                <dt class="col-sm-5">Adhäsion</dt>
                                <dd class="col-sm-7">{{ $condition->adhesion ?? '–' }}</dd>

                                <dt class="col-sm-5">WAC</dt>
                                <dd class="col-sm-7">{{ $condition->wac ? number_format((float) $condition->wac, 2, ',', '.') : '–' }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h6">LAB-Farbwerte</h3>
                            <dl class="row g-2 mb-0">
                                <dt class="col-sm-3">L*</dt>
                                <dd class="col-sm-9">{{ $condition->lab_l ?? '–' }}</dd>

                                <dt class="col-sm-3">a*</dt>
                                <dd class="col-sm-9">{{ $condition->lab_a ?? '–' }}</dd>

                                <dt class="col-sm-3">b*</dt>
                                <dd class="col-sm-9">{{ $condition->lab_b ?? '–' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="condition-usage-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="condition-usage-title" class="h4 mb-0">Verwendung</h2>
                </div>
                <div class="card-body">
                    @php
                        $conditionOf = $condition->conditionOf;
                        $resultOf = $condition->resultOf;
                    @endphp

                    @if ($conditionOf)
                        <div class="mb-3">
                            <h3 class="h6"><span class="badge text-bg-warning">Ausgangszustand</span></h3>
                            <p class="mb-1">
                                Teilfläche: <a href="{{ route('partial_surfaces.show', $conditionOf) }}">{{ $conditionOf->identifier ?? ('Teilfläche #' . $conditionOf->id) }}</a>
                            </p>
                            <p class="mb-1 text-muted">
                                Artefakt: {{ $conditionOf->sampleSurface?->artifact?->name ?? '–' }}
                                ({{ $conditionOf->sampleSurface?->artifact?->location?->venue?->name ?? '–' }})
                            </p>
                            @if ($conditionOf->process)
                                <p class="mb-0 text-muted">
                                    Gerät: <a href="{{ route('devices.show', $conditionOf->process->device) }}">{{ $conditionOf->process->device->name }}</a>
                                </p>
                            @endif
                        </div>
                    @endif

                    @if ($resultOf)
                        <div>
                            <h3 class="h6"><span class="badge text-bg-success">Ergebnis</span></h3>
                            <p class="mb-1">
                                Teilfläche: <a href="{{ route('partial_surfaces.show', $resultOf) }}">{{ $resultOf->identifier ?? ('Teilfläche #' . $resultOf->id) }}</a>
                            </p>
                            <p class="mb-1 text-muted">
                                Artefakt: {{ $resultOf->sampleSurface?->artifact?->name ?? '–' }}
                                ({{ $resultOf->sampleSurface?->artifact?->location?->venue?->name ?? '–' }})
                            </p>
                            @if ($resultOf->process)
                                <p class="mb-0 text-muted">
                                    Gerät: <a href="{{ route('devices.show', $resultOf->process->device) }}">{{ $resultOf->process->device->name }}</a>
                                </p>
                            @endif
                        </div>
                    @endif

                    @if (!$conditionOf && !$resultOf)
                        <p class="mb-0 text-muted">Dieser Zustand ist keiner Teilfläche zugeordnet.</p>
                    @endif
                </div>
            </div>
        </section>

        @if ($condition->images && $condition->images->isNotEmpty())
            <section aria-labelledby="condition-images-title">
                <div class="card shadow-sm">
                    <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                        <h2 id="condition-images-title" class="h4 mb-0">Bilder</h2>
                        <span class="badge text-bg-light">{{ $condition->images->count() }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach ($condition->images as $image)
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
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
