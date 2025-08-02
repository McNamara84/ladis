@extends('layouts.app')

@section('title', 'Personen')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Personen</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Institution</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($persons as $person)
                        <tr>
                            <td>{{ $person->id }}</td>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->institution->name ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePerson{{ $person->id }}">
                                        Löschen
                                    </button>

                                    <div class="modal fade" id="deletePerson{{ $person->id }}" tabindex="-1" aria-labelledby="deletePerson{{ $person->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deletePerson{{ $person->id }}Label">Person löschen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Soll die Person <strong>{{ $person->name }}</strong> wirklich gelöscht werden?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                    <form method="POST" action="{{ route('persons.destroy', $person->id) }}" class="d-inline">
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
                            <td colspan="@auth 4 @else 3 @endauth">Keine Personen vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ url('/persons/create') }}" class="btn btn-primary mt-3">Person hinzufügen</a>
        @endauth
    </div>
@endsection