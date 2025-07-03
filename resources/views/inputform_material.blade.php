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

                    <div class="card-body">
                        <form method="POST" action="{{ route('inputform_material.store') }}">
                            @csrf

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="material_parent_id" class="form-label">Kategorie</label>
                                    <select class="form-select" id="material_parent_id" name="material_parent_id">
                                        <option value="">Bitte wählen Sie ein Material aus der Liste.</option>
                                        @foreach($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
