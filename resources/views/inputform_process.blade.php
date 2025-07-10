@extends('layouts.app')

@section('title', 'Eingabeformular Reinigungsprozess')

@section('content')
<div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neuen Reinigungsprozess hinzufügen</h4>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('inputform_process.store') }}">
                            @csrf

                        <div class="mb-5">
                             <label for="partial_surface_id" class="form-label">Partielle Oberfläche<span class="text-danger"></span></label>
                            <select class="form-select" id="partial_surface_id" name="partial_surface_id" required>
                                <option value="">-</option>
                                @foreach($partialSurfaces as $surface)
                                    <option value="{{ $surface->id }}" {{ old(key: 'partial_surface_id') == $surface->id ? 'selected' : '' }}>
                                        {{ $surface->identifier ?? ('Oberfläche'.$surface->id) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('partial_surface_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                    <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="device_id" class="form-label">Gerät<span class="text-danger"></span></label>
                            <select class="form-select" id="device_id" name="device_id" required>
                                <option value="">-</option>
                                @foreach($devices as $device)
                                    <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                                        {{ $device->name ?? ('Gerät'.$device->id) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('device_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                    <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="configuration_id" class="form-label">Einstellung<span class="text-danger"></span></label>
                            <select class="form-select" id="configuration_id" name="configuration_id" required>
                                <option value="">-</option>
                                @foreach($configurations as $configuration)
                                    <option value="{{ $configuration->id }}" {{ old('configuration_id') == $configuration->id ? 'selected' : '' }}>
                                        {{ $configuration->name ?? ('Einstellung'.$configuration->id) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('configuration_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                    <strong>{{ $message }}</strong>
                            @enderror       
                        </div> 

                        <div class="mb-5 form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                    placeholder="Anmerkung" 
                                    id="description" 
                                    name="description" 
                                    required 
                                    style="height: 120px">{{ old('description') }}</textarea>
                            <label for="description">Anmerkung <span class="text-danger">*</span></label>

                            <div class="form-text">
                                Bitte fügen Sie Ihre Anmerkung ein.
                            </div>

                            @error('description')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="duration" class="form-label">Dauer<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="duration" name="duration"
                                value="{{ old('duration') }}" required min="0" max="3" step="1" placeholder="Dauer (0-3)" />
                            <div class="form-text">
                                Bitte geben Sie die Dauer ein (mögliche Werte: 0, 1, 2, 3).
                                <p>0: 0-3 Minuten</p> 
                                <p>1: 3-5 Minuten</p> 
                                <p>2: 5-10 Minuten</p> 
                                <p>3: 10+ Minuten</p> 
                            </div>
                            @error('duration')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Feuchtigkeitszustand</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="wet_yes" name="wet" value="1"
                                    {{ old('wet') === '1' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="wet_yes">
                                    Nass
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="wet_no" name="wet" value="0"
                                    {{ old('wet') === '0' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="wet_no">
                                    Trocken
                                </label>
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