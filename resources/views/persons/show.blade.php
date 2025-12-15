@extends('layouts.app')

@section('title', 'Person: ' . $person->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('persons.all') }}">Personen</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $person->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $person->name }}</h1>
            <p class="lead text-muted mb-0">Übersicht über Zugehörigkeit und betreute Projekte.</p>
        </header>

        <section class="mb-5" aria-labelledby="person-institution-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="person-institution-title" class="h4 mb-0">Institution</h2>
                </div>
                <div class="card-body">
                    @if ($person->institution)
                        <a href="{{ route('institutions.show', $person->institution) }}">{{ $person->institution->name }}</a>
                    @else
                        <span class="text-muted">Keine Institution hinterlegt.</span>
                    @endif
                </div>
            </div>
        </section>

        <section aria-labelledby="person-projects-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="person-projects-title" class="h4 mb-0">Projekte</h2>
                    <span class="badge text-bg-light">{{ $person->projects->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($person->projects->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Es sind keine Projekte zugeordnet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Liste der Projekte, die von der Person betreut werden</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Projekt</th>
                                        <th scope="col">Ort</th>
                                        <th scope="col">Zeitraum</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($person->projects as $project)
                                        <tr>
                                            <th scope="row">{{ $project->name }}</th>
                                            <td>{{ $project->venue?->name ?? '–' }}</td>
                                            <td>
                                                {{ optional($project->started_at)->format('d.m.Y') ?? '–' }}
                                                –
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