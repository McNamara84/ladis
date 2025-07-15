@extends('layouts.app')

@section('title', 'Materialien')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Materialien</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Übergeordnetes Material</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($materials as $material)
                        <tr>
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->name }}</td>
                            <td>{{ $material->parent?->name ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMaterial{{ $material->id }}">
                                        Löschen
                                    </button>

                                    <div class="modal fade" id="deleteMaterial{{ $material->id }}" tabindex="-1" aria-labelledby="deleteMaterial{{ $material->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteMaterial{{ $material->id }}Label">Material löschen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Soll das Material <strong>{{ $material->name }}</strong> wirklich gelöscht werden?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                    <form method="POST" action="{{ route('materials.destroy', $material->id) }}" class="d-inline">
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
                            <td colspan="@auth 4 @else 3 @endauth">Keine Materialien vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ route('inputform_material.index') }}" class="btn btn-primary mt-3">Material hinzufügen</a>
        @endauth
    </div>
@endsection