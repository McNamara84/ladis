{{-- Credits: View design and breakpoints auto-generated via ai model Claude Sonnet 4 --}}
@extends('layouts.app')
@section('title', 'Eingabeformular Device')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Lasergerät hinzufügen</h4>
                    </div>
                    <div class="card-body">
                        {{-- Display validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Display success message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('inputform.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Gerätename *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        <div class="form-text">
                                            Bitte geben Sie eine eindeutige Bezeichnung für das Lasergerät an, z.B. CL50.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="institution_id" class="form-label">Hersteller *</label>
                                        <select class="form-control @error('institution_id') is-invalid @enderror" id="institution_id" name="institution_id" required>
                                            <option value="">Bitte wählen Sie den Hersteller aus</option>
                                            @foreach ($manufacturers as $manufacturer)
                                                <option value="{{ $manufacturer->id }}" {{ old('institution_id') == $manufacturer->id ? 'selected' : '' }}>
                                                    {{ $manufacturer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('institution_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="year" class="form-label">Gerätejahr *</label>
                                        <input type="number" class="form-control @error('year') is-invalid @enderror"
                                            id="year" name="year" value="{{ old('year') }}" min="1900" max="2099" required>
                                        <div class="form-text">
                                            Bitte geben Sie das Jahr des Lasergeräts vierstellig an.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="build" class="form-label">Geräteart *</label>
                                        <select class="form-control @error('build') is-invalid @enderror" id="build"
                                            name="build" required>
                                            <option value="">Bitte wählen Sie die Art des Lasergeräts aus</option>
                                            <option value="0" {{ old('build') == '0' ? 'selected' : '' }}>Glasfaser</option>
                                            <option value="1" {{ old('build') == '1' ? 'selected' : '' }}>Spiegelarm</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="safety_class" class="form-label">Sicherheitsklasse</label>
                                        <select class="form-control @error('safety_class') is-invalid @enderror" id="safety_class" name="safety_class">
                                            <option value="">Bitte wählen Sie die Sicherheitsklasse aus</option>
                                            <option value="1" {{ old('safety_class') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('safety_class') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('safety_class') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('safety_class') == '4' ? 'selected' : '' }}>4</option>
                                        </select>
                                    </div>

                                    {{-- Masses --}}
                                    <div class="form-group mb-3">
                                        <fieldset>
                                            <legend class="fs-6">Abmessungen</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="height" class="form-label">Höhe*</label>
                                                    <input type="number"
                                                        class="form-control @error('height') is-invalid @enderror"
                                                        id="height" name="height" value="{{ old('height') }}" required>
                                                    <div class="form-text">
                                                        Bitte geben Sie die Maße des Lasergeräts ohne Nachkommastellen in mm
                                                        an.
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="width" class="form-label">Breite *</label>
                                                    <input type="number"
                                                        class="form-control @error('width') is-invalid @enderror" id="width"
                                                        name="width" value="{{ old('width') }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="depth" class="form-label">Tiefe *</label>
                                                    <input type="number"
                                                        class="form-control @error('depth') is-invalid @enderror" id="depth"
                                                        name="depth" value="{{ old('depth') }}" required>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="weight" class="form-label">Gewicht *</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('weight') is-invalid @enderror" id="weight"
                                            name="weight" value="{{ old('weight') }}" required>
                                        <div class="form-text">
                                            Bitte geben Sie das exakte Gewicht des Lasergeräts mit zwei Nachkommastellen in
                                            kg an.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="fiber_length" class="form-label">Faserlänge *</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('fiber_length') is-invalid @enderror"
                                            id="fiber_length" name="fiber_length" value="{{ old('fiber_length') }}"
                                            required>
                                        <div class="form-text">
                                            Bitte geben Sie die Faserlänge des Lasergeräts mit zwei Nachkommastellen in m
                                            an.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="cooling" class="form-label">Kühlsystem *</label>
                                        <select class="form-control @error('cooling') is-invalid @enderror" id="cooling"
                                            name="cooling" required>
                                            <option value="">Bitte wählen Sie die Art des Kühlsystems aus</option>
                                            <option value="0" {{ old('cooling') == '0' ? 'selected' : '' }}>Intern</option>
                                            <option value="1" {{ old('cooling') == '1' ? 'selected' : '' }}>Extern</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="mounting" class="form-label">Tragesystem *</label>
                                        <select class="form-control @error('mounting') is-invalid @enderror" id="mounting"
                                            name="mounting" required>
                                            <option value="">Bitte wählen Sie aus</option>
                                            <option value="1" {{ old('mounting') == '1' ? 'selected' : '' }}>Vorhanden
                                            </option>
                                            <option value="0" {{ old('mounting') == '0' ? 'selected' : '' }}>Nicht vorhanden
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="automation" class="form-label">Automatisierungssystem *</label>
                                        <select class="form-control @error('automation') is-invalid @enderror"
                                            id="automation" name="automation" required>
                                            <option value="">Bitte wählen Sie aus</option>
                                            <option value="1" {{ old('automation') == '1' ? 'selected' : '' }}>Vorhanden
                                            </option>
                                            <option value="0" {{ old('automation') == '0' ? 'selected' : '' }}>Nicht vorhanden
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {{-- Power data --}}
                                    <div class="form-group mb-3">
                                        <fieldset>
                                            <legend class="fs-6">Leistungsdaten</legend>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="max_output" class="form-label">Max. Stromleistung*</label>
                                                    <input type="number" step="0.01"
                                                        class="form-control @error('max_output') is-invalid @enderror"
                                                        id="max_output" name="max_output" value="{{ old('max_output') }}"
                                                        required>
                                                    <div class="form-text">
                                                        Bitte geben Sie die Stromleistung in W an.
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mean_output" class="form-label">Mittelwert Stromleistung
                                                        *</label>
                                                    <input type="number" step="0.01"
                                                        class="form-control @error('mean_output') is-invalid @enderror"
                                                        id="mean_output" name="mean_output" value="{{ old('mean_output') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="max_wattage" class="form-label">Max. Stromverbrauch *</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('max_wattage') is-invalid @enderror" id="max_wattage"
                                            name="max_wattage" value="{{ old('max_wattage') }}" required>
                                        <div class="form-text">
                                            Bitte geben Sie den Stromverbrauch des Lasergeräts in W an.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="head" class="form-label">Bearbeitungskopfmodell *</label>
                                        <input type="text" class="form-control @error('head') is-invalid @enderror"
                                            id="head" name="head" value="{{ old('head') }}" required>
                                        <div class="form-text">
                                            Bitte geben Sie eine eindeutige Bezeichnung an, z.B. Optik OS A20.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="emission_source" class="form-label">Emissionsquelle *</label>
                                        <select class="form-control @error('emission_source') is-invalid @enderror"
                                            id="emission_source" name="emission_source" required>
                                            <option value="">Bitte wählen Sie aus</option>
                                            <option value="0" {{ old('emission_source') == '0' ? 'selected' : '' }}>Typ A
                                            </option>
                                            <option value="1" {{ old('emission_source') == '1' ? 'selected' : '' }}>Typ B
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="beam_type" class="form-label">Laserart *</label>
                                        <select class="form-control @error('beam_type') is-invalid @enderror" id="beam_type"
                                            name="beam_type" required>
                                            <option value="">Bitte wählen Sie die Laserart des Geräts aus</option>
                                            <option value="0" {{ old('beam_type') == '0' ? 'selected' : '' }}>Punktlaser
                                            </option>
                                            <option value="1" {{ old('beam_type') == '1' ? 'selected' : '' }}>Zeilenlaser
                                            </option>
                                            <option value="2" {{ old('beam_type') == '2' ? 'selected' : '' }}>Flächenlaser
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="beam_profile" class="form-label">Strahlprofil *</label>
                                        <input type="text" class="form-control @error('beam_profile') is-invalid @enderror"
                                            id="beam_profile" name="beam_profile" value="{{ old('beam_profile') }}"
                                            required>
                                        <div class="form-text">
                                            Bitte geben Sie eine eindeutige Bezeichnung für das Strahlprofil an, z.B.
                                            Top-Hat-Strahlprofil.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="wavelength" class="form-label">Wellenlänge *</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('wavelength') is-invalid @enderror" id="wavelength"
                                            name="wavelength" value="{{ old('wavelength') }}" required>
                                        <div class="form-text">
                                            Bitte geben Sie die Wellenlänge des Lasergeräts in nm an.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Beschreibung</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            name="description" rows="3">{{ old('description') }}</textarea>
                                        <div class="form-text">
                                            Optional, falls weitere Beschreibungen des Lasergeräts vorliegen.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="reset" class="btn btn-secondary">Werte zurücksetzen</button>
                                <button type="submit" class="btn btn-primary">Gerät hinzufügen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection