@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="container py-4">
        <div class="row">
            <aside class="col-md-3 mb-4">
                <button class="btn btn-outline-secondary w-100 mb-3 d-md-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#searchFilters" aria-expanded="false"
                        aria-controls="searchFilters">
                    Filter
                </button>
                <div id="searchFilters" class="collapse d-md-block">
                    @include('search._filters')
                </div>
            </aside>
            <div class="col-md-9">
                @if($query)
                    <h1 class="h4">Suchergebnisse für "{{ $query }}"</h1>
                @endif
                @forelse($devices as $device)
                    @include('search._result', ['device' => $device])
                @empty
                    <p>Keine Ergebnisse gefunden.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection