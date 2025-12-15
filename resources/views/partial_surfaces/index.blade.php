@extends('layouts.app')

@section('title', 'Teilflächen')

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 mb-1">Teilflächen</h1>
                <p class="mb-0 text-muted">Alle erfassten Teilflächen mit zugehöriger Probenfläche und Materialangaben.</p>
            </div>
            @can('create', \App\Models\PartialSurface::class)
                <a class="btn btn-primary align-self-start align-self-md-center" href="{{ route('partial_surfaces.create') }}">
                    <x-icon icon="bi-database--add" class="me-2" /> Neue Teilfläche anlegen
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
                <caption class="text-muted px-3">Tabelle mit allen Teilflächen inklusive Materialien und Zuständen.</caption>
                <thead class="table-light">
                    <tr>
                        <th scope="col">Kennung</th>
                        <th scope="col">Probenfläche</th>
                        <th scope="col">Artefakt</th>
                        <th scope="col">Grundmaterial</th>
                        <th scope="col">Beschichtung</th>
                        <th scope="col">Ausgangszustand</th>
                        <th scope="col">Ergebnis</th>
                        <th scope="col" class="text-center">Größe (cm²)</th>
                        @can('delete', new \App\Models\PartialSurface())
                            <th scope="col" class="text-end">Aktionen</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($partialSurfaces as $partialSurface)
                        @php($identifier = $partialSurface->identifier ?? 'Teilfläche #' . $partialSurface->id)
                        <tr>
                            <th scope="row" class="fw-semibold">
                                <a class="link-underline link-underline-opacity-0" href="{{ route('partial_surfaces.show', $partialSurface) }}">
                                    {{ $identifier }}
                                </a>
                            </th>
                            <td>
                                @if ($partialSurface->sampleSurface)
                                    <a class="link-underline link-underline-opacity-0" href="{{ route('sample_surfaces.show', $partialSurface->sampleSurface) }}">
                                        {{ $partialSurface->sampleSurface->name }}
                                    </a>
                                @else
                                    <span class="text-muted">–</span>
                                @endif
                            </td>
                            <td>
                                @if ($partialSurface->sampleSurface?->artifact)
                                    <a class="link-underline link-underline-opacity-0" href="{{ route('artifacts.show', $partialSurface->sampleSurface->artifact) }}">
                                        {{ $partialSurface->sampleSurface->artifact->name }}
                                    </a>
                                @else
                                    <span class="text-muted">–</span>
                                @endif
                            </td>
                            <td>{{ $partialSurface->foundationMaterial?->name ?? '–' }}</td>
                            <td>{{ $partialSurface->coatingMaterial?->name ?? '–' }}</td>
                            <td>{{ $partialSurface->condition?->description ? \Illuminate\Support\Str::limit($partialSurface->condition->description, 60) : '–' }}</td>
                            <td>{{ $partialSurface->result?->description ? \Illuminate\Support\Str::limit($partialSurface->result->description, 60) : '–' }}</td>
                            <td class="text-center">{{ number_format((float) $partialSurface->size, 2, ',', '.') }}</td>
                            @can('delete', $partialSurface)
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletePartialSurface{{ $partialSurface->id }}">
                                        <span class="visually-hidden">Teilfläche {{ $partialSurface->identifier ?? $partialSurface->id }} löschen</span>
                                        <x-icon icon="bi-trash" aria-hidden="true" />
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deletePartialSurface' . $partialSurface->id,
                                        'title' => 'Teilfläche löschen',
                                        'message' => 'Soll die Teilfläche <strong>' . e($partialSurface->identifier ?? '#' . $partialSurface->id) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('partial_surfaces.destroy', $partialSurface),
                                    ])
                                    @endcomponent
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@can('create', \App\Models\PartialSurface::class) 9 @else 8 @endcan" class="text-center py-5">
                                <div class="text-muted">Es sind derzeit keine Teilflächen erfasst.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center" aria-label="Seitennavigation">
            {{ $partialSurfaces->links() }}
        </div>
    </div>
@endsection