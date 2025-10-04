@extends('layouts.app')

@section('title', 'Artefakt: ' . $artifact->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('artifacts.all') }}">Artefakte</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $artifact->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $artifact->name }}</h1>
            <p class="lead text-muted mb-0">Inventarnummer: {{ $artifact->inventory_number ?? '–' }}</p>
        </header>

        <section class="mb-5" aria-labelledby="artifact-overview-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="artifact-overview-title" class="h4 mb-0">Überblick</h2>
                </div>
                <div class="card-body">
                    <dl class="row g-3 mb-0">
                        <dt class="col-md-3">Standort</dt>
                        <dd class="col-md-9">
                            @if ($artifact->location)
                                <a href="{{ route('locations.show', $artifact->location) }}">{{ $artifact->location->name }}</a>
                                <span class="text-muted">{{ $artifact->location->venue?->name }}</span>
                            @else
                                <span class="text-muted">Kein Standort hinterlegt.</span>
                            @endif
                        </dd>

                        <dt class="col-md-3">Ort</dt>
                        <dd class="col-md-9">{{ $artifact->location?->venue?->name ?? '–' }}</dd>
                    </dl>
                </div>
            </div>
        </section>

        <section aria-labelledby="artifact-sample-surfaces-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="artifact-sample-surfaces-title" class="h4 mb-0">Probenflächen</h2>
                    <span class="badge text-bg-light">{{ $artifact->sampleSurfaces->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($artifact->sampleSurfaces->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Es wurden keine Probenflächen dokumentiert.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Probenflächen des Artefakts</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Teilflächen</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($artifact->sampleSurfaces as $surface)
                                        <tr>
                                            <th scope="row">{{ $surface->name }}</th>
                                            <td>{{ $surface->partialSurfaces->count() }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('sample_surfaces.show', $surface) }}">
                                                    Probenfläche ansehen
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