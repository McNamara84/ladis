@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="container py-4">
        <div class="row">
            <aside class="col-md-3 mb-4">
                @include('search._filters')
            </aside>
            <div class="col-md-9">
                @if($query)
                    <h1 class="h4">Suchergebnisse für "{{ $query }}"</h1>
                @endif
                @forelse($devices as $device)
                    Placeholder for single results <!-- TODO: Implement serach result cards as template -->
                @empty
                    <p>Keine Ergebnisse gefunden.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection