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
                            <x-form.input
                                name="name"
                                label="Name"
                                :required="true"
                            />

                            <x-form.select
                                name="city_id"
                                label="Stadt"
                                :options="$cities"
                                option-label="full_name"
                                placeholder="Bitte auswählen"
                                :required="true"
                            />

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