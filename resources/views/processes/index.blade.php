@extends('layouts.app')

@section('title', 'Prozesse')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Prozess</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Material</th>
                        <th>Beschichtung</th>
                        <th>Schadensmuster</th>
                        <th>Gerät</th>
                        <th>Venue</th>
                        @auth
                            <th>Aktionen</th>
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

                                    <div class="modal fade" id="deleteProcess{{ $process->id }}" tabindex="-1"
                                        aria-labelledby="deleteProcess{{ $process->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteProcess{{ $process->id }}Label">Prozess
                                                        löschen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Schließen"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Soll der Prozess <strong>{{ $process->id }}</strong> wirklich gelöscht werden?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Abbrechen</button>
                                                    <form method="POST" action="{{ route('processes.destroy', $process->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Löschen</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
