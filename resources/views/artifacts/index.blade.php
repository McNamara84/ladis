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
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteArtifact' . $artifact->id,
                                        'title' => 'Objekt löschen',
                                        'message' => 'Soll das Objekt <strong>' . e($artifact->name) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('artifacts.destroy', $artifact->id),
                                    ])
                                    @endcomponent
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