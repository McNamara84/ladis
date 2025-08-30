@extends('layouts.app')

@section('title', 'Projekte')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Projekte</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Projektleitung</th>
                        <th>Objekt</th>
                        <th>Beginn</th>
                        <th>Ende</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->person->name ?? '–' }}</td>
                            <td>{{ $project->venue->name ?? '–' }}</td>
                            <td>{{ $project->started_at?->format('Y-m-d') ?? '–' }}</td>
                            <td>{{ $project->ended_at?->format('Y-m-d') ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProject{{ $project->id }}">
                                        Löschen
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteProject' . $project->id,
                                        'title' => 'Projekt löschen',
                                        'message' => 'Soll das Projekt <strong>' . e($project->name) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('projects.destroy', $project->id),
                                    ])
                                    @endcomponent
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@auth 7 @else 6 @endauth">Keine Projekte vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ route('projects.create') }}" class="btn btn-primary mt-3">Neues Projekt anlegen</a>
        @endauth
    </div>
@endsection