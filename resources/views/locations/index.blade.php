@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="container py-4">
        @php($canManageLocations = auth()->check())

        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
                <p class="text-muted mb-0">
                    {{ $canManageLocations
                        ? 'Verwalten Sie Standorte und ordnen Sie sie bestehenden Orten zu.'
                        : 'Entdecken Sie alle vorhandenen Standorte und ihre zugehörigen Orte.' }}
                </p>
            </div>
            @auth
                <a class="btn btn-primary" href="{{ route('locations.create') }}" aria-label="Neuen Standort hinzufügen">
                    <span class="fw-semibold">Standort anlegen</span>
                </a>
            @endauth
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="status" aria-live="polite" aria-atomic="true">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert" aria-live="assertive" aria-atomic="true">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped align-middle" aria-describedby="locationsHelp">
                <caption id="locationsHelp" class="text-muted">Liste aller gepflegten Standorte inklusive ihres zugehörigen Ortes.</caption>
                <thead class="table-light">
                    <tr>
                        <th scope="col">Standort</th>
                        <th scope="col">Ort</th>
                        <th scope="col">Stadt</th>
                        @auth
                            <th scope="col" class="text-end">Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                        <tr>
                            <th scope="row">
                                <a class="link-underline link-underline-opacity-0" href="{{ route('locations.show', $location) }}">
                                    {{ $location->name }}
                                </a>
                            </th>
                            <td>{{ $location->venue?->name ?? '–' }}</td>
                            <td>{{ $location->venue?->city?->name ?? '–' }}</td>
                            @auth
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
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $canManageLocations ? 4 : 3 }}" class="text-center text-muted py-4">Es wurden noch keine Standorte angelegt.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection