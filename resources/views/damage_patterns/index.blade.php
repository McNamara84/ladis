@extends('layouts.app')

@section('title', 'Schadensmuster')

@section('content')
    <div class="container py-4">
        <header class="mb-4">
            <h1 class="h3 mb-1">Schadensmuster</h1>
            <p class="mb-0 text-muted">Übersicht aller dokumentierten Schadensmuster.</p>
        </header>

        <div class="table-responsive shadow-sm rounded-3">
            <table class="table table-hover align-middle mb-0">
                <caption class="visually-hidden">Tabelle mit allen Schadensmustern</caption>
                <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col" class="text-center">Zuordnungen</th>
                        <th scope="col" class="text-end">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($damagePatterns as $damagePattern)
                        <tr>
                            <th scope="row">
                                <a class="link-underline link-underline-opacity-0" href="{{ route('damage_patterns.show', $damagePattern) }}">
                                    {{ $damagePattern->name }}
                                </a>
                            </th>
                            <td class="text-center">
                                <span class="badge text-bg-secondary">{{ $damagePattern->conditions_count }}</span>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('damage_patterns.show', $damagePattern) }}">
                                    Ansehen
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center py-4">Keine Schadensmuster vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
