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
                        <tr>
                            <td>PL ID</td>
                            <td>PL NAME</td>
                            <td>PL INSTITUTION NAME</td>
                            <td>PL YEAR</td>
                            <td>PL TYPE</td>
                            <td>PL BEAM</td>
                            <td>PL OUTPUT</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection