@extends('layouts.app')

@section('title', 'Projekt: ' . $project->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('projects.all') }}">Projekte</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $project->name }}</h1>
            @if ($project->url)
                <p class="mb-0"><a class="link-underline link-underline-opacity-0" href="{{ $project->url }}" target="_blank" rel="noopener">Projektwebseite öffnen</a></p>
            @endif
        </header>

        <section class="mb-5" aria-labelledby="project-summary-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="project-summary-title" class="h4 mb-0">Zusammenfassung</h2>
                </div>
                <div class="card-body">
                    <p class="mb-4">{{ $project->description }}</p>
                    <dl class="row g-3 mb-0">
                        <dt class="col-md-3">Projektleitung</dt>
                        <dd class="col-md-9">
                            @if ($project->person)
                                <a href="{{ route('persons.show', $project->person) }}">{{ $project->person->name }}</a>
                                @if ($project->person->institution)
                                    <span class="text-muted">({{ $project->person->institution->name }})</span>
                                @endif
                            @else
                                <span class="text-muted">Keine Angaben</span>
                            @endif
                        </dd>

                        <dt class="col-md-3">Ort</dt>
                        <dd class="col-md-9">
                            @if ($project->venue)
                                <a href="{{ route('venues.show', $project->venue) }}">{{ $project->venue->name }}</a>
                                @if ($project->venue->city)
                                    <span class="text-muted">{{ $project->venue->city->full_name }}</span>
                                @endif
                            @else
                                <span class="text-muted">Keine Angaben</span>
                            @endif
                        </dd>

                        <dt class="col-md-3">Zeitraum</dt>
                        <dd class="col-md-9">
                            {{ optional($project->started_at)->format('d.m.Y') ?? '–' }} –
                            {{ optional($project->ended_at)->format('d.m.Y') ?? '–' }}
                        </dd>
                    </dl>
                </div>
            </div>
        </section>

        <section aria-labelledby="project-media-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="project-media-title" class="h4 mb-0">Medien</h2>
                    <span class="badge text-bg-light">{{ $project->images->count() }}</span>
                </div>
                <div class="card-body">
                    @if ($project->images->isEmpty())
                        <p class="mb-0 text-muted">Für dieses Projekt wurden noch keine Medien hinterlegt.</p>
                    @else
                        <div class="row g-4">
                            @foreach ($project->images as $image)
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