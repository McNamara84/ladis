@extends('layouts.app')
@section('title', $pageTitle)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Bild hochladen</h4>
                    </div>
                    <div class="card-body">
                        <x-form.alerts />

                        <form action="{{ route('inputform_image.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form.select
                                        name="project_id"
                                        label="Projekt"
                                        :options="$projects"
                                        placeholder="Bitte wählen Sie ein Projekt aus"
                                        :required="true"
                                    />
                                    <div class="form-group mb-3">
                                        <label for="condition_id" class="form-label">Zustand</label>
                                        <select
                                            class="form-select @error('condition_id') is-invalid @enderror"
                                            id="condition_id"
                                            name="condition_id"
                                            aria-describedby="conditionHelp"
                                        >
                                            <option value="">Bitte wählen Sie optional einen Zustand aus</option>
                                            @foreach ($conditions as $condition)
                                                <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                                                    {{ $condition->damage_pattern_id }} – {{ $condition->severity }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div id="conditionHelp" class="form-text">
                                            Wählen Sie bei Bedarf den Zustand, der auf dem Bild dargestellt ist.
                                        </div>
                                        @error('condition_id')
                                            <div class="invalid-feedback">{{ __('Die ausgewählte Zustandsoption ist nicht verfügbar. Bitte wählen Sie einen anderen Wert aus.') }}</div>
                                        @enderror
                                    </div>
                                    <x-form.textarea
                                        name="description"
                                        label="Beschreibung"
                                        hint="Bitte geben Sie eine Beschreibung an."
                                    />
                                    <x-form.textarea
                                        name="alt_text"
                                        label="Alternativer Text"
                                        hint="Bitte geben Sie einen alternativen Text an."
                                        :required="true"
                                    />
                                    <x-form.input
                                        name="year_created"
                                        label="Entstehungsjahr"
                                        type="number"
                                        hint="Bitte geben Sie das Entstehungsjahr an."
                                        :required="true"
                                    />
                                    <x-form.input
                                        name="creator"
                                        label="Urheber"
                                        hint="Bitte geben Sie den Urheber an."
                                        :required="true"
                                    />
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Bild auswählen *</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="image" name="image" required>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="reset" class="btn btn-secondary">Werte zurücksetzen</button>
                                <button type="submit" class="btn btn-primary">Hochladen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection