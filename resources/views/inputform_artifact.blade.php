@extends('layouts.app')

@section('title', 'Eingabeformular Artifact')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Objekt hinzufügen</h4>
                    </div>
                    <div class="card-body">
                        <p>Pflichtfelder sind mit <span class="text-danger">*</span> gekennzeichnet.</p>
                        <form method="POST" action="{{ route('inputform_artifact.store') }}">
                            <div class="mb-5">
                                <label for="artifact_name" class="form-label">Objektname <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="artifact_name" name="artifact_name"
                                    value="{{ old('artifact_name') }}" required placeholder="Legen Sie den Name eines neuen Objekts an." />
                                @error('artifact_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="artifact_inventory_number" class="form-label">Inventarnummer</label>
                                <input type="text" class="form-control" id="artifact_inventory_number" name="artifact_inventory_number"
                                    value="{{ old('artifact_inventory_number') }}" required placeholder="Geben Sie hier die Inventarnummer an." />
                                @error('artifact_inventory_number')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="location_id" class="form-label">Standort <span class="text-danger">*</span></label>
                                <select class="form-select" id="location_id" name="location_id" required>
                                    <option value="">Bitte wählen Sie einen Standort</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id') = $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
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

