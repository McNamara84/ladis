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

                        <form action="{{ route('inputform_image.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="project_id" class="form-label">Projekt *</label>
                                        <select class="form-control @error('project_id') is-invalid @enderror"
                                            id="project_id" name="project_id" required>
                                            <option value="" disabled hidden>Bitte wählen Sie ein Projekt aus</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                                    {{ $project->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('project_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                                    <div class="form-group mb-3">
                                        <label class="form-label">Beschreibung</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            name="description" rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Bitte geben Sie eine Beschreibung an.
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Alternativer Text *</label>
                                        <textarea class="form-control @error('alt_text') is-invalid @enderror"
                                            name="alt_text" rows="3">{{ old('alt_text') }}</textarea>
                                        <div class="form-text">
                                            Bitte geben Sie einen alternativen Text an.
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="year_created" class="form-label">Entstehungsjahr *</label>
                                        <input type="number" class="form-control @error('year_created') is-invalid @enderror"
                                            id="year_created" name="year_created" value="{{ old('year_created') }}"
                                            required>
                                        <div class="form-text">
                                            Bitte geben Sie das Entstehungsjahr an.
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="creator" class="form-label">Urheber *</label>
                                        <input type="text" class="form-control @error('creator') is-invalid @enderror"
                                            id="creator" name="creator" value="{{ old('creator') }}" required>
                                        <div class="form-text">
                                            Bitte geben Sie den Urheber an.
                                        </div>
                                    </div>
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