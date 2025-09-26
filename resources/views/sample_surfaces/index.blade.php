@extends('layouts.app')

@section('title', 'Probenflächen')

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 mb-1">Probenflächen</h1>
                <p class="mb-0 text-muted">Übersicht über alle vorhandenen Probenflächen und ihre Teilflächen.</p>
            </div>
            @can('create', \App\Models\SampleSurface::class)
                <a class="btn btn-primary align-self-start align-self-md-center" href="{{ route('sample_surfaces.create') }}">
                    <x-icon icon="bi-plus-lg" class="me-2" /> Neue Probenfläche anlegen
                </a>
            @endcan
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="status" aria-live="polite">
                <div class="d-flex align-items-center">
                    <x-icon icon="bi-check-circle" class="me-2" />
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Hinweis schließen"></button>
            </div>
        @endif

        <div class="table-responsive shadow-sm rounded-3">
            <table class="table table-hover align-middle mb-0">
                <caption class="text-muted px-3">Tabelle mit allen Probenflächen inklusive Artefakt und Anzahl der Teilflächen.</caption>
                <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Artefakt</th>
                        <th scope="col" class="text-center">Teilflächen</th>
                        <th scope="col">Beschreibung</th>
                        @can('delete', new \App\Models\SampleSurface())
                            <th scope="col" class="text-end">Aktionen</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sampleSurfaces as $surface)
                        <tr>
                            <th scope="row" class="fw-semibold">{{ $surface->name }}</th>
                            <td>{{ $surface->artifact?->name ?? '–' }}</td>
                            <td class="text-center">{{ $surface->partial_surfaces_count }}</td>
                            <td>
                                <p class="mb-0 text-body-secondary">{{ \Illuminate\Support\Str::limit($surface->description, 120) }}</p>
                            </td>
                            @can('delete', $surface)
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteSampleSurface{{ $surface->id }}">
                                        <span class="visually-hidden">Probenfläche {{ $surface->name }} löschen</span>
                                        <x-icon icon="bi-trash" aria-hidden="true" />
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteSampleSurface' . $surface->id,
                                        'title' => 'Probenfläche löschen',
                                        'message' => 'Soll die Probenfläche <strong>' . e($surface->name) . '</strong> wirklich gelöscht werden? Alle zugehörigen Teilflächen bleiben erhalten.',
                                        'actionRoute' => route('sample_surfaces.destroy', $surface),
                                    ])
                                    @endcomponent
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@can('create', \App\Models\SampleSurface::class) 5 @else 4 @endcan" class="text-center py-5">
                                <div class="text-muted">Es sind derzeit keine Probenflächen erfasst.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center" aria-label="Seitennavigation">
            {{ $sampleSurfaces->links() }}
        </div>
    </div>
@endsection