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
                                <label for="person_name" class="form-label">Projektleitung</label>
                                <input type="text" list="person_names" class="form-control" id="person_name"
                                    name="person_name" placeholder="Geben Sie den Namen der Projektleitung an">

                                <datalist id="person_names">
                                    <option value="Name1">
                                    <option value="Name2">
                                    <option value="Name3">
                                    <option value="Sonstiges">
                                </datalist>
                            </div>


                            <div class="mb-3">
                                <label for="institution_name" class="form-label">Institution</label>
                                <input type="text" list="institution_names" class="form-control" id="institution_name"
                                    name="institution_name" placeholder="Geben Sie den Namen der Institution an">

                                <datalist id="institution_names">
                                    <option value="FH Potsdam">
                                    <option value="Institution1">
                                    <option value="Institution2">
                                    <option value="Sonstiges">

                                </datalist>
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
                                    </select>
                            </div>

                            <div class="mb-3">
                                <label for="material_name" class="form-label">Material</label>
                                <input type="text" list="material_names" class="form-control" id="material_name"
                                    name="material_name" placeholder="Geben Sie das Material an">

                                <datalist id="material_names">
                                    <option value="Holz">
                                    <option value="Stein">
                                    <option value="Material3">
                                    <option value="Sonstiges">

                                </datalist>
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