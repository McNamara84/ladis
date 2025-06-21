@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-primary">Erweiterte Suche</h1>
                        <p class="card-text">Willkommen zur erweiterten Suche!</p>
                        <form>

                            <div class="mb-3">
                                <label for="project_name" class="form-label"> Projektname</label>
                                <input type="text" id="project_name" name="project_name" class="form-control"
                                    placeholder="Geben Sie den Namen des Projekts an">
                            </div>

                            <div class="mb-3">
                                <label for="project_started_at" class="form-label">Projektstart</label>
                                <input type="date" class="form-control" id="project_started_at" name="project_started_at">
                            </div>

                            <div class="mb-3">
                                <label for="project_ended_at" class="form-label">Projektende</label>
                                <input type="date" class="form-control" id="project_ended_at" name="project_ended_at">
                            </div>

                            <div class="mb-3">
                                <label for="person_name" class="form-label">Projektleitung
                                    <select class="form-control" id="person_name" name="person_name" size="3">
                                        <option disabled selected value="">Bitte wählen Sie die Projektleitung aus
                                        </option>
                                        <option>Name1</option>
                                        <option>Name2</option>
                                        <option>Name3</option>
                                        <option>Name4</option>
                                        <option>Name5</option>
                                        <option>Name5</option>
                                    </select>
                                    </div>

                            <div class="mb-3">
                                <label for="device_name" class="form-label">Gerätename
                                    <select class="form-control" id="device_name" name="device_name">
                                        <option disabled selected value="">Bitte wählen Sie den Namen des Lasergeräts aus
                                        </option>
                                        <option>CL20</option>
                                        <option>CL50</option>
                                        <option>Infinito Laser p/n I054C1</option>
                                        <option>Thunder Compact</option>
                                        <option>Soliton LT300</option>
                                        <option>Smart 300</option>
                                        <option>Sonstiges</option>
                                    </select>
                                    </div>


                             <div class="mb-3">
                                <label for="institution_name" class="form-label">Institution</label>
                                <select class="form-control" id="institution_name" name="institution_name" size="3">
                                    <option disabled selected value="">Bitte wählen Sie den Namen der Institution aus</option>
                                    <option>FH Potsdam</option>
                                    <option>Institution2</option>
                                    <option>Institution3</option>
                                    <option>Institution4</option>
                                    <option>Institution5</option>
                                    <option>Sonstiges</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="material_name" class="form-label">Material</label>
                                <select class="form-control" id="material_name" name="material_name" size="3">
                                    <option disabled selected value="">Bitte wählen Sie das Material aus</option>
                                    <option>Holz</option>
                                    <option>Stein</option>
                                    <option>Material2</option>
                                    <option>Material3</option>
                                    <option>Material4</option>
                                    <option>Sonstiges</option>
                                </select>
                            </div>


                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection