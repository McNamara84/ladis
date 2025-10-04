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
                            <td>
                                <a class="link-underline link-underline-opacity-0" href="{{ route('persons.show', $person) }}">
                                    {{ $person->name }}
                                </a>
                            </td>
                            <td>{{ $person->institution->name ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePerson{{ $person->id }}">
                                        Löschen
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deletePerson' . $person->id,
                                        'title' => 'Person löschen',
                                        'message' => 'Soll die Person <strong>' . e($person->name) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('persons.destroy', $person->id),
                                    ])
                                    @endcomponent
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