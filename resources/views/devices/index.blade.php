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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Keine Geräte vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection