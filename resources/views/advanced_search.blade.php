@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-primary">Erweiterte Suche</h1>
                        <form action="{{ route('search_results') }}" method="GET">
                            <input type="hidden" name="advanced" value="1">

                            <div class="mb-3">
                                <label for="federal_state_id" class="form-label">Bundesland</label>
                                <select class="form-control" id="federal_state_id" name="federal_state_id">
                                    <option disabled selected value="">Wählen Sie das Bundesland aus</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="project_name" class="form-label"> Projektname</label>
                                <input type="text" id="project_name" name="project_name" class="form-control"
                                    placeholder="Geben Sie den Namen des Projekts an">
                            </div>

                            <div class="mb-3">
                                <label for="person_name" class="form-label"> Projektleitung</label>
                                <input type="text" id="person_name" name="person_name" class="form-control"
                                    placeholder="Geben Sie die Projektleitung an">
                            </div>

                            <div class="mb-3">
                                <label for="institution_id" class="form-label">Institution</label>
                                <select class="form-control" id="institution_id" name="institution_id" size="3">
                                    <option disabled selected value="">Wählen Sie den Namen der Institution aus</option>
                                    @foreach ($institutions as $institution)
                                        <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="device_name" class="form-label">Gerätename</label>
                                <input type="search" id="device_name" name="q" class="form-control"
                                    placeholder="Geben Sie den Namen des Lasergeräts ein">
                            </div>

                            <div class="mb-3">
                                <label for="material_id" class="form-label">Material</label>
                                <select class="form-control" id="material_id" name="material_id" size="3">
                                    <option disabled selected value="">Wählen Sie das Material aus</option>
                                    <option>Holz</option>
                                    <option>Stein</option>
                                    <option>Material2</option>
                                    <option>Material3</option>
                                    <option>Material4</option>
                                    <option>Sonstiges</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <svg class="bi" width="16" height="16" aria-hidden="true">
                                        <use xlink:href="#bi-search"></use>
                                    </svg> Suchen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection