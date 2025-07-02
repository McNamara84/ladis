@extends('layouts.app')

@section('title', 'Eingabeformular Project')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Projekt anlegen</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="project_name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="project_name" name="project_name" required
                                    placeholder="Geben Sie den Namen des Projektes an">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige Bezeichnung für das Projekt an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_description" class="form-label">Beschreibung <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="project_description" name="project_description" required
                                    rows="3" required placeholder="Geben Sie die Beschreibung des Projektes an"></textarea>
                                <div class="form-text">
                                    Bitte geben Sie eine Beschreibung für das Projekt an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_url" class="form-label">URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="project_url" name="project_url" required
                                    placeholder="Geben Sie die URL des Projektes an">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige URL des Projektes an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_started_at" class="form-label">Beginn <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="project_started_at" name="project_started_at"
                                    required placeholder="Geben Sie das Startdatum des Projektes an">
                                <div class="form-text">
                                    Bitte geben Sie das Startdatum des Projektes an.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_ended_at" class="form-label">Ende <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="project_ended_at" name="project_ended_at"
                                    required placeholder="Geben Sie das Enddatum des Projektes an">
                                <div class="form-text">
                                    Bitte geben Sie das Enddatum des Projektes an.
                                </div>
                            </div>


                            <!-- Group container for the two buttons -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="reset" class="btn btn-danger text-center">
                                    <i class="bi bi-plus-circle"></i> Werte zurücksetzen
                                </button>

                                <button type="submit" class="btn btn-primary text-center">
                                    <i class="bi bi-plus-circle"></i> Projekt hinzufügen
                                </button>


                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection