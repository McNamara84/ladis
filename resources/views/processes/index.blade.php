@extends('layouts.app')

@section('title', 'Prozesse')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Prozess</h1>
        <div class="table-responsive">
            <table class="table table-striped" data-sortable>
                <thead>
                    <tr>
                        <th data-sortable-type="number">ID</th>
                        <th>Material</th>
                        <th>Beschichtung</th>
                        <th>Schadensmuster</th>
                        <th>Gerät</th>
                        <th>Venue</th>
                        @auth
                            <th class="no-sort">Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($processes as $process)
                        <tr>
                            <td>{{ $process->id }}</td>
                            <td>{{ $process->partialSurface->foundationMaterial->name }}</td>
                            <td>{{ $process->partialSurface?->coatingMaterial?->name ?? '' }}</td>
                            <td>{{ $process->partialSurface->condition->damagePattern->name }}</td>
                            <td>{{ $process->device->name }}</td>
                            <td>{{ $process->partialSurface->sampleSurface->artifact->location->venue->name }}
                                ({{ $process->partialSurface->sampleSurface->artifact->location->venue->city->name }})</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteProcess{{ $process->id }}">
                                        Löschen
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteProcess' . $process->id,
                                        'title' => 'Prozess löschen',
                                        'message' => 'Soll der Prozess <strong>' . $process->id . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('processes.destroy', $process->id),
                                    ])
                                    @endcomponent
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@auth 4 @else 3 @endauth">Keine Prozesse vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ route('processes.create') }}" class="btn btn-primary mt-3">Neuen Prozess anlegen</a>
        @endauth
    </div>
@endsection
