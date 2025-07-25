@extends('layouts.app')

@section('title', 'Eingabeformular Objekt')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Objekt hinzufügen</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inputform_artifact.store') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

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

                            <p>Pflichtfelder sind mit <span class="text-danger">*</span> gekennzeichnet.</p>

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
                                    value="{{ old('artifact_inventory_number') }}" placeholder="Geben Sie hier die Inventarnummer an." />
                                @error('artifact_inventory_number')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="artifact_location_id" class="form-label">Standort <span class="text-danger">*</span></label>
                                <select class="form-select" id="artifact_location_id" name="artifact_location_id" required>
                                    <option value="">Wählen Sie einen Standort aus.</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('artifact_location_id') == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('artifact_location_id')
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

