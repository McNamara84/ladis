@extends('layouts.app')

@section('title', 'Schadensmuster: ' . $damagePattern->name)

@section('content')
    <div class="container py-4">
        <nav class="mb-3" aria-label="Brotkrumen">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('damage_patterns.all') }}">Schadensmuster</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $damagePattern->name }}</li>
            </ol>
        </nav>

        <header class="mb-4">
            <h1 class="display-5 fw-semibold mb-2">{{ $damagePattern->name }}</h1>
            <p class="lead text-muted mb-0">Schadensmuster mit {{ $damagePattern->conditions->count() }} zugeordneten Zuständen.</p>
        </header>

        <section aria-labelledby="damage-pattern-conditions-title">
            <div class="card shadow-sm">
                <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                    <h2 id="damage-pattern-conditions-title" class="h4 mb-0">Zugeordnete Zustände</h2>
                    <span class="badge text-bg-light">{{ $damagePattern->conditions->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if ($damagePattern->conditions->isEmpty())
                        <p class="px-4 py-3 mb-0 text-muted">Diesem Schadensmuster wurden noch keine Zustände zugeordnet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <caption class="visually-hidden">Zustände mit diesem Schadensmuster</caption>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Beschreibung</th>
                                        <th scope="col">Verwendung</th>
                                        <th scope="col">Teilfläche</th>
                                        <th scope="col" class="text-end">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($damagePattern->conditions as $condition)
                                        @php
                                            $partialSurface = $condition->conditionOf ?? $condition->resultOf;
                                            $usage = $condition->conditionOf ? 'Ausgangszustand' : ($condition->resultOf ? 'Ergebnis' : '–');
                                        @endphp
                                        <tr>
                                            <th scope="row">#{{ $condition->id }}</th>
                                            <td>{{ Str::limit($condition->description, 50) ?? '–' }}</td>
                                            <td>
                                                <span class="badge {{ $condition->conditionOf ? 'text-bg-warning' : 'text-bg-success' }}">
                                                    {{ $usage }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($partialSurface)
                                                    <a href="{{ route('partial_surfaces.show', $partialSurface) }}">
                                                        {{ $partialSurface->identifier ?? ('Teilfläche #' . $partialSurface->id) }}
                                                    </a>
                                                    <span class="text-muted d-block small">
                                                        {{ $partialSurface->sampleSurface?->artifact?->name ?? '–' }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">–</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('conditions.show', $condition) }}">
                                                    Zustand ansehen
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
