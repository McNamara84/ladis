@extends('layouts.app')

@section('title', 'Material: ' . $material->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('materials.all') }}">Materialien</a></li>
                @php
                    // Build hierarchical breadcrumb path for parent materials
                    $ancestors = collect();
                    $current = $material->parent;
                    while ($current) {
                        $ancestors->prepend($current);
                        $current = $current->parent;
                    }
                @endphp
                @foreach ($ancestors as $ancestor)
                    <li class="breadcrumb-item"><a href="{{ route('materials.show', $ancestor) }}">{{ $ancestor->name }}</a></li>
                @endforeach
                <li class="breadcrumb-item active" aria-current="page">{{ $material->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $material->name }}</h1>
            <p class="lead text-muted mb-0">Detailansicht des Materials inklusive Hierarchie und Einsätzen.</p>
        </header>

        <section class="mb-5" aria-labelledby="material-hierarchy-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h2 id="material-hierarchy-title" class="h4 mb-0">Materialhierarchie</h2>
                </div>
                <div class="card-body">
                    <dl class="row g-3 mb-0">
                        <dt class="col-lg-3">Übergeordnetes Material</dt>
                        <dd class="col-lg-9">
                            @if ($material->parent)
                                <a href="{{ route('materials.show', $material->parent) }}">{{ $material->parent->name }}</a>
                            @else
                                <span class="text-muted">Kein übergeordnetes Material</span>
                            @endif
                        </dd>

                        <dt class="col-lg-3">Untergeordnete Materialien</dt>
                        <dd class="col-lg-9">
                            @if ($material->children->isEmpty())
                                <span class="text-muted">Keine weiteren Materialien</span>
                            @else
                                <ul class="list-inline mb-0" aria-label="Liste untergeordneter Materialien">
                                    @foreach ($material->children as $child)
                                        <li class="list-inline-item mb-1">
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('materials.show', $child) }}">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </section>

        <section aria-labelledby="material-usage-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="material-usage-title" class="h4 mb-0">Einsätze in Teilflächen</h2>
                    <span class="badge text-bg-light">{{ $partialSurfaces->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($partialSurfaces->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Dieses Material wurde bisher keiner Teilfläche zugeordnet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Übersicht der Teilflächen, in denen das Material vorkommt</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Teilfläche</th>
                                        <th scope="col">Rolle</th>
                                        <th scope="col">Artefakt</th>
                                        <th scope="col">Ort</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partialSurfaces as $partialSurface)
                                        <tr>
                                            <th scope="row">{{ $partialSurface->identifier ?? ('Teilfläche #' . $partialSurface->id) }}</th>
                                            <td>
                                                @if ($partialSurface->foundation_material_id === $material->id)
                                                    Grundmaterial
                                                @else
                                                    Beschichtung
                                                @endif
                                            </td>
                                            <td>{{ $partialSurface->sampleSurface?->artifact?->name ?? '–' }}</td>
                                            <td>{{ $partialSurface->sampleSurface?->artifact?->location?->venue?->name ?? '–' }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('partial_surfaces.show', $partialSurface) }}">
                                                    Teilfläche ansehen
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection