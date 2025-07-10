@extends('layouts.app')

@section('title', 'Eingabeformular Projekt')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ $pageTitle }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inputform_project.store') }}">
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

                            <div class="mb-3">
                                <label for="person_id" class="form-label">Projektleitung <span class="text-danger">*</span></label>
                                <select class="form-control @error('name') is-invalid @enderror" id="person_id" name="person_id" required>
                                    <option disabled selected value="">Wählen Sie die Projektleitung aus</option>
                                    @foreach ($persons as $person)
                                        <option value="{{ $person->id }}">{{ $person->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="venue_id" class="form-label">Objektname <span class="text-danger">*</span></label>
                                <select class="form-control @error('name') is-invalid @enderror" id="venue_id" name="venue_id" required>
                                    <option disabled selected value="">Wählen Sie den Objektnamen aus</option>
                                    @foreach ($venues as $venue)
                                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required
                                    placeholder="Projektname">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige Bezeichnung für das Projekt an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Beschreibung <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('name') is-invalid @enderror" id="description" name="description" required
                                    rows="3" required placeholder="Projektbeschreibung"></textarea>
                                <div class="form-text">
                                    Bitte geben Sie eine Beschreibung für das Projekt an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="url" name="url" required
                                    placeholder="Projekt-URL">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige URL des Projektes an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="started_at" class="form-label">Beginn <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('name') is-invalid @enderror" id="started_at" name="started_at" required>
                                <div class="form-text">
                                    Bitte geben Sie das Startdatum des Projektes an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="ended_at" class="form-label">Ende <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('ended_at') is-invalid @enderror" id="ended_at" name="ended_at" required>
                                @error('ended_at')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    Bitte geben Sie das Enddatum des Projektes an.
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