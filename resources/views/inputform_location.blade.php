@extends('layouts.app')

@section('title', 'Eingabeformular Standort')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h1 class="h4 mb-0">Neuen Standort anlegen</h1>
                        <p class="mb-0 text-muted">Alle Pflichtfelder sind mit einem <span class="text-danger">*</span> gekennzeichnet.</p>
                    </div>
                    <div class="card-body">
                        <x-form.alerts />

                        <form method="POST" action="{{ route('locations.store') }}" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="location_name" class="form-label fw-semibold">Standortname <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    id="location_name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    required
                                    maxlength="50"
                                    aria-describedby="location_name_help"
                                    placeholder="z. B. Restaurierungswerkstatt" />
                                <div id="location_name_help" class="form-text">Geben Sie einen prägnanten Namen für den Standort ein.</div>
                                @error('name')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="location_venue_id" class="form-label fw-semibold">Zugehöriger Ort <span class="text-danger">*</span></label>
                                <select
                                    id="location_venue_id"
                                    name="venue_id"
                                    class="form-select @error('venue_id') is-invalid @enderror"
                                    required
                                    aria-describedby="location_venue_help">
                                    <option value="">Bitte wählen Sie einen Ort aus</option>
                                    @foreach ($venues as $venue)
                                        <option value="{{ $venue->id }}" @selected(old('venue_id') == $venue->id)>
                                            {{ $venue->name }} @if ($venue->city) &ndash; {{ $venue->city->name }} @endif
                                        </option>
                                    @endforeach
                                </select>
                                <div id="location_venue_help" class="form-text">Der Standort wird unter dem ausgewählten Ort geführt.</div>
                                @error('venue_id')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">Standort speichern</button>
                                <a href="{{ route('locations.all') }}" class="btn btn-outline-secondary">Zur Übersicht</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection