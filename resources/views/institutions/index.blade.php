@extends('layouts.app')

@section('title', 'Institutionen')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">{{ $pageTitle }}</h1>
        <div class="border p-3 bg-body-secondary rounded mb-3">
            <form method="GET" action="{{ url('/institutions/all') }}" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="type" class="col-form-label">Institutionstyp</label>
                </div>
                <div class="col-auto">
                    <select id="type" name="type" class="form-select" onchange="this.form.submit()">
                        <option value="" {{ ($type ?? null) === null ? 'selected' : '' }}>Alle</option>
                        <option value="clients" {{ ($type ?? null) === 'clients' ? 'selected' : '' }}>Auftraggeber</option>
                        <option value="contractors" {{ ($type ?? null) === 'contractors' ? 'selected' : '' }}>Auftragnehmer</option>
                        <option value="manufacturers" {{ ($type ?? null) === 'manufacturers' ? 'selected' : '' }}>Hersteller</option>
                    </select>
                </div>
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
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteInstitution' . $institution->id,
                                        'title' => 'Institution löschen',
                                        'message' => 'Soll die Institution <strong>' . e($institution->name) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('institutions.destroy', $institution->id),
                                    ])
                                    @endcomponent
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