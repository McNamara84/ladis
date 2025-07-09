@php
    use App\Models\Institution;
@endphp

@extends('layouts.app')
@section('title', $pageTitle)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __("Add New Institution") }}</h4>
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

                        <form action="{{ route('inputform_institution.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">{{ __("Institution Name") }}<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        <div class="form-text">
                                            {{ __("messages.k00") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="type" class="form-label">{{ __("Institution Type") }}<span class="text-danger"> *</span></label>
                                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="">{{ __("Please select …") }}</option>
                                            <option value="{{ Institution::TYPE_CLIENT}}" {{ old('type') == Institution::TYPE_CLIENT ? 'selected' : '' }}>{{ __("Client") }}</option>
                                            <option value="{{ Institution::TYPE_CONTRACTOR}}" {{ old('type') == Institution::TYPE_CONTRACTOR ? 'selected' : '' }}>{{ __("Contractor") }}</option>
                                            <option value="{{ Institution::TYPE_MANUFACTURER}}" {{ old('type') == Institution::TYPE_MANUFACTURER ? 'selected' : '' }}>{{ __("Manufacturer") }}</option>
                                        </select>
                                        <div class="form-text">
                                            {{ __("messages.k01") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="contact_information" class="form-label">{{ __("Contact Information") }}<span class="text-danger"> *</span></label>
                                        <textarea class="form-control @error('contact_information') is-invalid @enderror"
                                            name="contact_information" rows="3" required>{{ old('contact_information') }}</textarea>
                                        <div class="form-text">
                                            {{ __("messages.k02") }}
                                        </div>
                                    </div>
                                    <div class="form-text mb-3">
                                        <span class="text-danger">* </span>{{ __("Mandatory Field") }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="reset" class="btn btn-secondary">{{ __("Reset Values") }}</button>
                                <button type="submit" class="btn btn-primary">{{ __("Submit") }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection