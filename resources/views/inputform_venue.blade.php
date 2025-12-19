@extends('layouts.app')
@section('title', $pageTitle)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neuen Ort hinzufügen</h4>
                    </div>
                    <div class="card-body">
                        <x-form.alerts />

                        <form action="{{ route('venues.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="city_id" class="form-label">Stadt: <span class="text-danger">*</span></label>
                                <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id" required>
                                    <option value="">Bitte auswählen</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>{{ $city->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-text mb-3">
                                <span class="text-danger">*</span> Pflichtangabe
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Abbrechen</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection