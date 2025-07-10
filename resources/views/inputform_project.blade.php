@extends('layouts.app')

@section('title', __('Input Form: Project'))

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
                                <label for="person_id" class="form-label">Projektleitung <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('person_id') is-invalid @enderror" id="person_id"
                                    name="person_id" required>
                                    <option disabled selected value="">Wählen Sie die Projektleitung aus</option>
                                    @foreach ($persons as $person)
                                        <option value="{{ $person->id }}">{{ $person->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="venue_id" class="form-label">Objektname <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('venue_id') is-invalid @enderror" id="venue_id"
                                    name="venue_id" required>
                                    <option disabled selected value="">Wählen Sie den Objektnamen aus</option>
                                    @foreach ($venues as $venue)
                                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __("Project Title") }}<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" required placeholder="{{ __('Specify project title …') }}">
                                <div class="form-text">
                                    {{ __("messages.f00") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __("Description") }}<span
                                        class="text-danger"> *</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                    name="description" rows="3" required placeholder="{{ __("Add project description …") }}"></textarea>
                                <div class="form-text">
                                    {{ __("messages.f01") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">{{ __("URL Adress") }}<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                    name="url" required placeholder="{{ __("Specify URL adress of project …") }}">
                                <div class="form-text">
                                    {{ __("messages.f02") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="started_at" class="form-label">{{ __("Start") }}<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control @error('started_at') is-invalid @enderror"
                                    id="started_at" name="started_at" required>
                                <div class="form-text">
                                    {{ __("messages.f03") }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="ended_at" class="form-label">{{ __("End") }}<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control @error('ended_at') is-invalid @enderror"
                                    id="ended_at" name="ended_at">
                                @error('ended_at')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    {{ __("messages.f04") }}
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">{{ __("Save") }}</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __("Cancel") }}</a>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection