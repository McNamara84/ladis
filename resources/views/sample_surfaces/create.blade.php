@extends('layouts.app')

@section('title', 'Probenfläche anlegen')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <h1 class="h3 mb-3">Neue Probenfläche anlegen</h1>
                <p class="text-muted mb-4">Pflegen Sie hier eine neue Probenfläche mit Bezug zu einem Artefakt ein.</p>

                @if ($errors->any())
                    <div id="form-errors" class="alert alert-danger" role="alert" tabindex="-1">
                        <h2 class="h5">Es sind Fehler aufgetreten:</h2>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sample_surfaces.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="artifacts_id" class="form-label">Artefakt <span class="text-danger">*</span></label>
                        <select class="form-select @error('artifacts_id') is-invalid @enderror" id="artifacts_id"
                            name="artifacts_id" required aria-describedby="artifacts_id_help"
                            @if (!$errors->any()) autofocus @endif>
                            <option value="">Bitte wählen</option>
                            @foreach ($artifacts as $artifact)
                                <option value="{{ $artifact->id }}" @selected(old('artifacts_id') == $artifact->id)>
                                    {{ $artifact->name }}
                                </option>
                            @endforeach
                        </select>
                        <div id="artifacts_id_help" class="form-text">Wählen Sie das zugehörige Artefakt aus.</div>
                        @error('artifacts_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Bezeichnung <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" maxlength="50" required
                            aria-describedby="name_help">
                        <div id="name_help" class="form-text">Maximal 50 Zeichen, eindeutige Bezeichnung der Probenfläche.</div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Beschreibung <span class="text-danger">*</span></label>
                        <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror"
                            required aria-describedby="description_help">{{ old('description') }}</textarea>
                        <div id="description_help" class="form-text">Beschreiben Sie die Probenfläche prägnant.</div>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <a href="{{ route('sample_surfaces.all') }}" class="btn btn-outline-secondary">Zur Übersicht</a>
                        <button type="submit" class="btn btn-primary">Probenfläche speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const errorSummary = document.getElementById('form-errors');
            if (errorSummary) {
                errorSummary.focus();
            }
        });
    </script>
@endpush