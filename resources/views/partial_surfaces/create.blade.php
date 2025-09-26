@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Teilfläche anlegen')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <h1 class="h3 mb-3">Neue Teilfläche anlegen</h1>
                <p class="text-muted mb-4">Dokumentieren Sie eine Teilfläche mit Materialien und Zustandsdaten.</p>

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

                <form action="{{ route('partial_surfaces.store') }}" method="POST" novalidate class="needs-validation">
                    @csrf
                    <div class="mb-3">
                        <label for="sample_surface_id" class="form-label">Probenfläche <span class="text-danger">*</span></label>
                        <select id="sample_surface_id" name="sample_surface_id"
                            class="form-select @error('sample_surface_id') is-invalid @enderror" required
                            aria-describedby="sample_surface_id_help" @if (!$errors->any()) autofocus @endif>
                            <option value="">Bitte wählen</option>
                            @foreach ($sampleSurfaces as $surface)
                                <option value="{{ $surface->id }}" @selected(old('sample_surface_id') == $surface->id)>
                                    {{ $surface->name }}
                                </option>
                            @endforeach
                        </select>
                        <div id="sample_surface_id_help" class="form-text">Ordnen Sie die Teilfläche einer bestehenden Probenfläche zu.</div>
                        @error('sample_surface_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="foundation_material_id" class="form-label">Grundmaterial <span class="text-danger">*</span></label>
                            <select id="foundation_material_id" name="foundation_material_id"
                                class="form-select @error('foundation_material_id') is-invalid @enderror" required
                                aria-describedby="foundation_material_id_help">
                                <option value="">Bitte wählen</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}" @selected(old('foundation_material_id') == $material->id)>
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="foundation_material_id_help" class="form-text">Material, auf dem die Teilfläche basiert.</div>
                            @error('foundation_material_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="coating_material_id" class="form-label">Beschichtung <span class="text-danger">*</span></label>
                            <select id="coating_material_id" name="coating_material_id"
                                class="form-select @error('coating_material_id') is-invalid @enderror" required
                                aria-describedby="coating_material_id_help">
                                <option value="">Bitte wählen</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}" @selected(old('coating_material_id') == $material->id)>
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="coating_material_id_help" class="form-text">Beschichtungsmaterial der Teilfläche.</div>
                            @error('coating_material_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-6">
                            <label for="condition_id" class="form-label">Ausgangszustand <span class="text-danger">*</span></label>
                            <select id="condition_id" name="condition_id"
                                class="form-select @error('condition_id') is-invalid @enderror" required
                                aria-describedby="condition_id_help">
                                <option value="">Bitte wählen</option>
                                @foreach ($conditions as $condition)
                                    <option value="{{ $condition->id }}" @selected(old('condition_id') == $condition->id)>
                                        Zustand #{{ $condition->id }}{{ $condition->description ? ' – ' . Str::limit($condition->description, 40) : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="condition_id_help" class="form-text">Referenz auf den dokumentierten Ausgangszustand.</div>
                            @error('condition_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="result_id" class="form-label">Ergebniszustand <span class="text-danger">*</span></label>
                            <select id="result_id" name="result_id"
                                class="form-select @error('result_id') is-invalid @enderror" required
                                aria-describedby="result_id_help">
                                <option value="">Bitte wählen</option>
                                @foreach ($conditions as $condition)
                                    <option value="{{ $condition->id }}" @selected(old('result_id') == $condition->id)>
                                        Zustand #{{ $condition->id }}{{ $condition->description ? ' – ' . Str::limit($condition->description, 40) : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="result_id_help" class="form-text">Resultierender Zustand nach der Behandlung.</div>
                            @error('result_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-6">
                            <label for="identifier" class="form-label">Interne Kennung</label>
                            <input type="text" id="identifier" name="identifier" value="{{ old('identifier') }}" maxlength="100"
                                class="form-control @error('identifier') is-invalid @enderror" aria-describedby="identifier_help">
                            <div id="identifier_help" class="form-text">Optional: interne Referenz oder Label.</div>
                            @error('identifier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="size" class="form-label">Größe in cm² <span class="text-danger">*</span></label>
                            <input type="number" id="size" name="size" value="{{ old('size') }}"
                                class="form-control @error('size') is-invalid @enderror" step="0.01" min="0.01" max="999.99"
                                required aria-describedby="size_help">
                            <div id="size_help" class="form-text">Bitte geben Sie die Fläche mit zwei Dezimalstellen an.</div>
                            @error('size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                        <a href="{{ route('partial_surfaces.all') }}" class="btn btn-outline-secondary">Zur Übersicht</a>
                        <button type="submit" class="btn btn-primary">Teilfläche speichern</button>
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