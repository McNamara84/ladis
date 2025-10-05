@extends('layouts.app')

@section('title', 'Ort: ' . $venue->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('venues.all') }}">Orte</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $venue->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $venue->name }}</h1>
            <p class="lead text-muted mb-0">{{ $venue->city?->full_name ?? 'Keine Ortsangabe' }}</p>
        </header>

        <section class="mb-5" aria-labelledby="venue-overview-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="venue-overview-title" class="h4 mb-0">Überblick</h2>
                </div>
                <div class="card-body">
                    <dl class="row g-3 mb-0">
                        <dt class="col-md-3">Stadt</dt>
                        <dd class="col-md-9">{{ $venue->city?->name ?? '–' }}</dd>

                        <dt class="col-md-3">Bundesland</dt>
                        <dd class="col-md-9">{{ $venue->city?->federalState?->name ?? '–' }}</dd>
                    </dl>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="venue-locations-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="venue-locations-title" class="h4 mb-0">Standorte</h2>
                    <span class="badge text-bg-light">{{ $venue->locations->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($venue->locations->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Es wurden keine Standorte hinterlegt.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Standorte, die zu diesem Ort gehören</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Artefakte</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($venue->locations as $location)
                                        <tr>
                                            <th scope="row">{{ $location->name }}</th>
                                            <td>{{ $location->artifacts->count() }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('locations.show', $location) }}">
                                                    Standort ansehen
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

        <section aria-labelledby="venue-projects-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="venue-projects-title" class="h4 mb-0">Projekte am Ort</h2>
                    <span class="badge text-bg-light">{{ $venue->projects->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($venue->projects->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Es gibt keine dokumentierten Projekte an diesem Ort.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Liste der Projekte für diesen Ort</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Projekt</th>
                                        <th scope="col">Leitung</th>
                                        <th scope="col">Zeitraum</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($venue->projects as $project)
                                        <tr>
                                            <th scope="row">{{ $project->name }}</th>
                                            <td>{{ $project->person?->name ?? '–' }}</td>
                                            <td>
                                                {{ optional($project->started_at)->format('d.m.Y') ?? '–' }} –
                                                {{ optional($project->ended_at)->format('d.m.Y') ?? '–' }}
                                            </td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('projects.show', $project) }}">
                                                    Projekt ansehen
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