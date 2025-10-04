@extends('layouts.app')

@section('title', 'Institution: ' . $institution->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('institutions.all') }}">Institutionen</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $institution->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $institution->name }}</h1>
            <p class="lead text-muted mb-0">{{ $institution->type }}</p>
        </header>

        <section class="mb-5" aria-labelledby="institution-overview-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="institution-overview-title" class="h4 mb-0">Kontakt</h2>
                </div>
                <div class="card-body">
                    <p class="mb-0" aria-label="Kontaktinformationen">{!! nl2br(e($institution->contact_information ?? 'Keine Kontaktdaten hinterlegt.')) !!}</p>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-labelledby="institution-devices-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="institution-devices-title" class="h4 mb-0">Lasergeräte</h2>
                    <span class="badge text-bg-light">{{ $institution->devices->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($institution->devices->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Es sind keine Geräte hinterlegt.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Zu dieser Institution gehörende Geräte</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Baujahr</th>
                                        <th scope="col">Bauart</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($institution->devices as $device)
                                        <tr>
                                            <th scope="row">{{ $device->name }}</th>
                                            <td>{{ $device->year ?? '–' }}</td>
                                            <td>{{ $device->build_type }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('devices.show', $device) }}">
                                                    Gerät ansehen
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section aria-labelledby="institution-persons-title" class="mb-5">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="institution-persons-title" class="h4 mb-0">Ansprechpartner*innen</h2>
                    <span class="badge text-bg-light">{{ $institution->persons->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($institution->persons->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Es sind keine Personen zugeordnet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Personen, die dieser Institution zugeordnet sind</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Projekte</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($institution->persons as $person)
                                        <tr>
                                            <th scope="row">{{ $person->name }}</th>
                                            <td>{{ $person->projects->count() }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('persons.show', $person) }}">
                                                    Person ansehen
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection