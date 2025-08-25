@extends('layouts.app')

@section('title', 'Artefakte')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Artefakte</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Standort</th>
                        <th>Inventarnummer</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($artifacts as $artifact)
                        <tr>
                            <td>{{ $artifact->id }}</td>
                            <td>{{ $artifact->name }}</td>
                            <td>{{ $artifact->location->name ?? '–' }}</td>
                            <td>{{ $artifact->inventory_number ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteArtifact{{ $artifact->id }}">
                                        Löschen
                                    </button>

                                    <div class="modal fade" id="deleteArtifact{{ $artifact->id }}" tabindex="-1" aria-labelledby="deleteArtifact{{ $artifact->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteArtifact{{ $artifact->id }}Label">Objekt löschen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Soll das Objekt <strong>{{ $artifact->name }}</strong> wirklich gelöscht werden?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                    <form method="POST" action="{{ route('artifacts.destroy', $artifact->id) }}" class="d-inline">
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
                            <td colspan="@auth 5 @else 4 @endauth">Keine Artefakte vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ route('inputform_artifact.index') }}" class="btn btn-primary mt-3">Objekt hinzufügen</a>
        @endauth
    </div>
@endsection