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
                        <form method="POST" action="{{ route('inputform_artifact.store') }}">
                            <div class="mb-5">
                                <label for="artifact_name" class="form-label">Objekt <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="artifact_name" name="artifact_name"
                                    value="{{ old('artifact_name') }}" required placeholder="Objektname" />
                                <div class="form-text">
                                    Legen Sie den Name eines neuen Objekts an.
                                </div>
                                @error('artifact_name')
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

