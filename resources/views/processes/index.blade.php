@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Prozess</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($processes as $process)
                        <tr>
                            <td>{{ $project->id }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteProject{{ $process->id }}">
                                        Löschen
                                    </button>

                                    <div class="modal fade" id="deleteProcess{{ $process->id }}" tabindex="-1"
                                        aria-labelledby="deleteProcess{{ $process->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteProcess{{ $process->id }}Label">Prozess
                                                        löschen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Schließen"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Soll der Prozess <strong>{{ $process->id }}</strong> wirklich gelöscht werden?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Abbrechen</button>
                                                    <form method="POST" action="{{ route('processes.destroy', $process->id) }}"
                                                        class="d-inline">
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
                            <td colspan="@auth 7 @else 6 @endauth">Keine Prozesse vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ route('process.create') }}" class="btn btn-primary mt-3">Neuen Prozess anlegen</a>
        @endauth
    </div>
@endsection
