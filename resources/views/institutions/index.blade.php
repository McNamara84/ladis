@extends('layouts.app')

@section('title', 'Institutionen')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">{{ $pageTitle }}</h1>
        <div class="d-flex mb-3">
            <form method="GET" action="{{ url('/institutions/all') }}" class="me-auto">
                <select name="type" class="form-select" onchange="this.form.submit()">
                    <option value="" {{ ($type ?? null) === null ? 'selected' : '' }}>Alle</option>
                    <option value="clients" {{ ($type ?? null) === 'clients' ? 'selected' : '' }}>Auftraggeber</option>
                    <option value="contractors" {{ ($type ?? null) === 'contractors' ? 'selected' : '' }}>Auftragnehmer</option>
                    <option value="manufacturers" {{ ($type ?? null) === 'manufacturers' ? 'selected' : '' }}>Hersteller</option>
                </select>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Kontaktinformation</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($institutions as $institution)
                        <tr>
                            <td>{{ $institution->id }}</td>
                            <td>{{ $institution->name }}</td>
                            <td>{!! nl2br(e($institution->contact_information)) !!}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteInstitution{{ $institution->id }}">
                                        Löschen
                                    </button>
                                    <div class="modal fade" id="deleteInstitution{{ $institution->id }}" tabindex="-1" aria-labelledby="deleteInstitution{{ $institution->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteInstitution{{ $institution->id }}Label">Institution löschen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schliessen"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Soll die Institution <strong>{{ $institution->name }}</strong> wirklich gelöscht werden?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                    <form method="POST" action="{{ route('institutions.destroy', $institution->id) }}" class="d-inline">
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
                            <td colspan="@auth 4 @else 3 @endauth">Keine Institutionen vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <div class="mt-3">
                <a href="{{ url('/institutions/create') }}" class="btn btn-primary">Institution hinzufügen</a>
            </div>
        @endauth
    </div>
@endsection