@extends('layouts.app')

@section('title', 'Eingabeformular Device')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Material hinzufügen</h4>
                    </div>
                    @if ($error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('inputform_material.store') }}">
                        @csrf
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="material_name" class="form-label">Material <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="material_name" name="material_name"
                                    value="{{ old('material_name') }}" required placeholder="Materialname" />
                                <div class="form-text">
                                    Bitte wählen Sie ein Material aus der Liste.
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Abbrechen</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
