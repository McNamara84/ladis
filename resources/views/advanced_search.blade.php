@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-primary">{{ __("Advanced Search") }}</h1>
                        <form action="{{ route('search_results') }}" method="GET">
                            <input type="hidden" name="advanced" value="1">

                            <div class="mb-3">
                                <label for="federal_state_id" class="form-label">{{ __("Federate State" )}}</label>
                                <select class="form-control" id="federal_state_id" name="federal_state_id">
                                    <option disabled selected value="">{{ __("Choose federate state …") }}</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="project_name" class="form-label">{{ __("Project Name") }}</label>
                                <input type="text" id="project_name" name="project_name" class="form-control"
                                    placeholder="{{ __("Specify project title …") }}">
                            </div>

                            <div class="mb-3">
                                <label for="person_name" class="form-label">{{ __("Project Leader") }}</label>
                                <input type="text" id="person_name" name="person_name" class="form-control"
                                    placeholder="{{ __("Specify project leader name …") }}">
                            </div>

                            <div class="mb-3">
                                <label for="institution_id" class="form-label">{{ __("Institution") }}</label>
                                <select class="form-control" id="institution_id" name="institution_id" size="3">
                                    <option disabled selected value="">{{ __("Choose institution …") }}</option>
                                    @foreach ($institutions as $institution)
                                        <option value="{{ $institution->name }}">{{ $institution->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="device_name" class="form-label">{{ __("Device Model") }}</label>
                                <input type="search" id="device_name" name="q" class="form-control"
                                    placeholder="{{ __("Specify device model …") }}">
                            </div>

                            <div class="mb-3">
                                <label for="material_id" class="form-label">{{ __("Material") }}</label>
                                <select class="form-control" id="material_id" name="material_id" size="3">
                                    <option disabled selected value="">{{ __("Choose material …") }}</option>
                                    <option>{{ __("Wood") }}</option>
                                    <option>{{ __("Stone") }}</option>
                                    <option>{{ __("Miscellaneous") }}</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <svg class="bi" width="16" height="16" aria-hidden="true">
                                        <use xlink:href="#bi-search"></use>
                                    </svg> {{ __("Start Search") }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection