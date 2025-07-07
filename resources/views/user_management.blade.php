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
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            @if ($user->id !== 1)
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}">
                                    Löschen
                                </button>
                                <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUser{{ $user->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteUser{{ $user->id }}Label">Account löschen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                                            </div>
                                            <div class="modal-body">
                                                Soll der Account <strong>{{ $user->name }}</strong> wirklich gelöscht werden?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                                                <form method="POST" action="{{ route('user-management.destroy', $user->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Löschen</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-auto text-center">
            <a href="{{ route('user-management.create') }}" class="btn btn-primary">Neuen Account erstellen</a>
        </div>
    </div>
@endsection