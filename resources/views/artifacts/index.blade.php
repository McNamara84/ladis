@extends('layouts.app')

@section('title', 'Artefakte')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Artefakte</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Standort</th>
                        <th>Inventarnummer</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artifacts as $artifact)
                        <tr>
                            <td>{{ $artifact->id }}</td>
                            <td>{{ $artifact->name }}</td>
                            <td>{{ $artifact->location->name ?? '–' }}</td>
                            <td>{{ $artifact->inventory_number ?? '–' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Keine Artefakte vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection