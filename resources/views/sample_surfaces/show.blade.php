@extends('layouts.app')

@section('title', 'Probenfläche: ' . $sampleSurface->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('sample_surfaces.all') }}">Probenflächen</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $sampleSurface->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $sampleSurface->name }}</h1>
            <p class="lead text-muted mb-0">{{ $sampleSurface->description }}</p>
        </header>

        <section class="mb-5" aria-labelledby="sample-surface-overview-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="sample-surface-overview-title" class="h4 mb-0">Überblick</h2>
                </div>
                <div class="card-body">
                    <dl class="row g-3 mb-0">
                        <dt class="col-md-3">Artefakt</dt>
                        <dd class="col-md-9">
                            @if ($sampleSurface->artifact)
                                <a href="{{ route('artifacts.show', $sampleSurface->artifact) }}">{{ $sampleSurface->artifact->name }}</a>
                                <span class="text-muted">{{ $sampleSurface->artifact->location?->name }}</span>
                            @else
                                <span class="text-muted">Kein Artefakt hinterlegt.</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </section>

        <section aria-labelledby="sample-surface-partials-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="sample-surface-partials-title" class="h4 mb-0">Teilflächen</h2>
                    <span class="badge text-bg-light">{{ $sampleSurface->partialSurfaces->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($sampleSurface->partialSurfaces->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Es wurden keine Teilflächen angelegt.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Teilflächen der Probenfläche</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Kennung</th>
                                        <th scope="col">Grundmaterial</th>
                                        <th scope="col">Beschichtung</th>
                                        <th scope="col">Zustand</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sampleSurface->partialSurfaces as $partialSurface)
                                        <tr>
                                            <th scope="row">{{ $partialSurface->identifier ?? ('Teilfläche #' . $partialSurface->id) }}</th>
                                            <td>{{ $partialSurface->foundationMaterial?->name ?? '–' }}</td>
                                            <td>{{ $partialSurface->coatingMaterial?->name ?? '–' }}</td>
                                            <td>{{ $partialSurface->condition?->description ? \Illuminate\Support\Str::limit($partialSurface->condition->description, 60) : '–' }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('partial_surfaces.show', $partialSurface) }}">
                                                    Teilfläche ansehen
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection