@extends('layouts.app')

@section('title', 'Input Form: Project')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __("Add New Project") }}</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="project_name" class="form-label">{{ __("Project Title") }}<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="project_name" name="project_name" required
                                    placeholder="{{ __("Specify project title …") }}">
                                <div class="form-text">
                                    {{ __("messages.f00") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_description" class="form-label">{{ __("Description") }}<span class="text-danger"> *</span></label>
                                <textarea class="form-control" id="project_description" name="project_description" required
                                    rows="3" required placeholder="{{ __("Add project description …") }}"></textarea>
                                <div class="form-text">
                                    {{ __("messages.f01") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_url" class="form-label">{{ __("URL Adress") }}<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="project_url" name="project_url" required
                                    placeholder="{{ __("Specify URL adress of project …") }}">
                                <div class="form-text">
                                    {{ __("messages.f02") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_started_at" class="form-label">{{ __("Start") }}<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" id="project_started_at" name="project_started_at"
                                    required placeholder="{{ __("Specify start date …") }}">
                                <div class="form-text">
                                    {{ __("messages.f03") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="project_ended_at" class="form-label">{{ __("End") }}<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" id="project_ended_at" name="project_ended_at"
                                    required placeholder="{{ __("Specify end date …") }}">
                                <div class="form-text">
                                    {{ __("messages.f04") }}
                                </div>
                            </div>


                            <!-- Group container for the two buttons -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="reset" class="btn btn-danger text-center">
                                    {{ __("Reset Values") }}
                                </button>

                                <button type="submit" class="btn btn-primary text-center">
                                    {{ __("Submit") }}
                                </button>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection