@extends('layouts.app')

@section('title', 'Orte')

@section('content')
    <div class='container'>
        <h1 class='h3 mb-4'>{{ $pageTitle }}</h1>
        <div class='border p-3 bg-body-secondary rounded mb-3'>
            <form method='GET' action='{{ url('/venues/all') }}' class='row g-3 align-items-center'>
                <div class='col-auto'>
                    <label for='state' class='col-form-label'>Bundesland</label>
                </div>
                <div class='col-auto'>
                    <select id='state' name='federal_state' class='form-select' onchange='this.form.submit()'>
                        <option value='' {{ ($federalStateId ?? null) === null ? 'selected' : '' }}>Alle</option>
                        @foreach($federalStates as $state)
                            <option value='{{ $state->id }}' {{ ($federalStateId ?? null) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class='table-responsive'>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Stadt</th>
                        <th>Bundesland</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($venues as $venue)
                        <tr>
                            <td>{{ $venue->id }}</td>
                            <td>
                                <a class="link-underline link-underline-opacity-0" href="{{ route('venues.show', $venue) }}">
                                    {{ $venue->name }}
                                </a>
                            </td>
                            <td>{{ $venue->city->name ?? '–' }}</td>
                            <td>{{ $venue->city->federalState->name ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteVenue{{ $venue->id }}'>
                                        Löschen
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteVenue' . $venue->id,
                                        'title' => 'Ort löschen',
                                        'message' => 'Soll der Ort <strong>' . e($venue->name) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('venues.destroy', $venue->id),
                                    ])
                                    @endcomponent
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan='@auth 5 @else 4 @endauth'>Keine Orte vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <div class='mt-3'>
                <a href='{{ url('/venues/create') }}' class='btn btn-primary'>Ort hinzufügen</a>
            </div>
        @endauth
    </div>
@endsection