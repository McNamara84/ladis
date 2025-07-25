@extends('layouts.app')

@section('title', 'Eingabeformular Material')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
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

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="mb-5">
                                <label for="material_parent_id" class="form-label">Übergeordnetes Material</label>
                                <select class="form-select" id="material_parent_id" name="material_parent_id">
                                    <option value="">-</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">
                                    Ohne Auswahl wird das neue Material als eigenständiges Material angelegt.
                                </div>
                                @error('material_parent_id')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="material_name" class="form-label">Material <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="material_name" name="material_name"
                                    value="{{ old('material_name') }}" required placeholder="Materialname" />
                                <div class="form-text">
                                    Bitte wählen Sie ein Material aus der Liste.
                                </div>
                                @error('material_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
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
