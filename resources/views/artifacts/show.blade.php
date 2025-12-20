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

        <x-card.section id="artifact-overview-title" title="Überblick">
            <dl class="row g-3 mb-0">
                <x-card.data-row label="Standort" dt-class="col-md-3" dd-class="col-md-9">
                    @if ($artifact->location)
                        <a href="{{ route('locations.show', $artifact->location) }}">{{ $artifact->location->name }}</a>
                        <span class="text-muted">{{ $artifact->location->venue?->name }}</span>
                    @else
                        <span class="text-muted">Kein Standort hinterlegt.</span>
                    @endif
                </x-card.data-row>

                <x-card.data-row label="Ort" :value="$artifact->location?->venue?->name" dt-class="col-md-3" dd-class="col-md-9" />
            </dl>
        </x-card.section>

        <x-card.section id="artifact-sample-surfaces-title" title="Probenflächen" :count="$artifact->sampleSurfaces->count()" class="p-0">
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
        </x-card.section>
    </div>
@endsection