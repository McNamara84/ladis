@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
                <p class="text-muted mb-0">Verwalten Sie Standorte und ordnen Sie sie bestehenden Orten zu.</p>
            </div>
            <a class="btn btn-primary" href="{{ route('locations.create') }}" aria-label="Neuen Standort hinzufügen">
                <span class="fw-semibold">Standort anlegen</span>
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped align-middle" aria-describedby="locationsHelp">
                <caption id="locationsHelp" class="text-muted">Liste aller gepflegten Standorte inklusive ihres zugehörigen Ortes.</caption>
                <thead class="table-light">
                    <tr>
                        <th scope="col">Standort</th>
                        <th scope="col">Ort</th>
                        <th scope="col">Stadt</th>
                        <th scope="col" class="text-end">Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                        <tr>
                            <th scope="row">{{ $location->name }}</th>
                            <td>{{ $location->venue?->name ?? '–' }}</td>
                            <td>{{ $location->venue?->city?->name ?? '–' }}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLocation{{ $location->id }}">
                                    Standort löschen
                                </button>
                                @component('components.delete-modal', [
                                    'modalId' => 'deleteLocation' . $location->id,
                                    'title' => 'Standort löschen',
                                    'message' => 'Soll der Standort <strong>' . e($location->name) . '</strong> wirklich gelöscht werden?',
                                    'actionRoute' => route('locations.destroy', $location->id),
                                ])
                                @endcomponent
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Es wurden noch keine Standorte angelegt.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection