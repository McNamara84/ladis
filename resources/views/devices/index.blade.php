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

                                    <div class="modal fade" id="deleteDevice{{ $device->id }}" tabindex="-1" aria-labelledby="deleteDevice{{ $device->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteDevice{{ $device->id }}Label">Gerät löschen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Soll das Gerät <strong>{{ $device->name }}</strong> wirklich gelöscht werden?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                    <form method="POST" action="{{ route('devices.destroy', $device->id) }}" class="d-inline">
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
                            <td colspan="@auth 8 @else 7 @endauth">Keine Geräte vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ url('/devices/all') }}" class="btn btn-primary mt-3">Lasergerät hinzufügen</a>
        @endauth
    </div>
@endsection