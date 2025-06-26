@extends('layouts.app')

@section('title', 'Benutzerverwaltung')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col">
                <h1 class="h3 mb-0">Benutzerverwaltung</h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Erstellt am</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PH 1</td>
                        <td>PH Max Mustermann</td>
                        <td>PH example@test.de</td>
                        <td>PH 02.03.2025 11:22</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-auto">
            <a href="#" class="btn btn-primary">Neuen Account erstellen</a>
        </div>
    </div>
@endsection