@extends('layouts.app')

@section('title', 'Geräte')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Lasergeräte</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Institution</th>
                        <th>Baujahr</th>
                        <th>Bauart</th>
                        <th>Strahltyp</th>
                        <th>Max. Leistung (W)</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($devices as $device)
                        <tr>
                            <td>{{ $device->id }}</td>
                            <td>{{ $device->name }}</td>
                            <td>{{ $device->institution->name ?? '–' }}</td>
                            <td>{{ $device->year ?? '–' }}</td>
                            <td>{{ $device->build_type }}</td>
                            <td>{{ $device->beam_type_name }}</td>
                            <td>{{ $device->max_output ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteDevice{{ $device->id }}">
                                        Löschen
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteDevice' . $device->id,
                                        'title' => 'Gerät löschen',
                                        'message' => 'Soll das Gerät <strong>' . e($device->name) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('devices.destroy', $device->id),
                                    ])
                                    @endcomponent
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@auth 8 @else 7 @endauth">Keine Geräte vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ url('/devices/create') }}" class="btn btn-primary mt-3">Lasergerät hinzufügen</a>
        @endauth
    </div>
@endsection