@extends('layouts.app')

@section('title', 'Eingabeformular Projekt')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Projekt anlegen</h4>
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
                                <label for="project_name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="project_name" name="project_name" required
                                    placeholder="Projektname">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige Bezeichnung für das Projekt an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_description" class="form-label">Beschreibung <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="project_description" name="project_description" required
                                    rows="3" required placeholder="Projektbeschreibung"></textarea>
                                <div class="form-text">
                                    Bitte geben Sie eine Beschreibung für das Projekt an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_url" class="form-label">URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="project_url" name="project_url" required
                                    placeholder="Projekt-URL">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige URL des Projektes an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_started_at" class="form-label">Beginn <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="project_started_at" name="project_started_at">
                                <div class="form-text">
                                    Bitte geben Sie das Startdatum des Projektes an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_ended_at" class="form-label">Ende <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="project_ended_at" name="project_ended_at">
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