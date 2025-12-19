@extends('layouts.app')

@section('title', 'Standort: ' . $location->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('locations.all') }}">Standorte</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $location->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $location->name }}</h1>
            <p class="lead text-muted mb-0">{{ $location->venue?->name ?? 'Keine Ortsangabe' }}</p>
        </header>

        <x-card.section id="location-overview-title" title="Überblick">
            <dl class="row g-3 mb-0">
                <x-card.data-row label="Ort" dt-class="col-md-3" dd-class="col-md-9">
                    @if ($location->venue)
                        <a href="{{ route('venues.show', $location->venue) }}">{{ $location->venue->name }}</a>
                        <span class="text-muted">{{ $location->venue->city?->full_name }}</span>
                    @else
                        <span class="text-muted">Kein Ort hinterlegt.</span>
                    @endif
                </x-card.data-row>
            </dl>
        </x-card.section>

        <x-card.section id="location-artifacts-title" title="Artefakte" :count="$location->artifacts->count()" class="p-0">
            @if ($location->artifacts->isEmpty())
                <p class="px-4 py-3 mb-0 text-muted">Es wurden keine Artefakte für diesen Standort erfasst.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <caption class="visually-hidden">Artefakte an diesem Standort</caption>
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Inventarnummer</th>
                                <th scope="col">Probenflächen</th>
                                <th scope="col" class="text-end">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($location->artifacts as $artifact)
                                <tr>
                                    <th scope="row">{{ $artifact->name }}</th>
                                    <td>{{ $artifact->inventory_number ?? '–' }}</td>
                                    <td>{{ $artifact->sampleSurfaces->count() }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('artifacts.show', $artifact) }}">
                                            Artefakt ansehen
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