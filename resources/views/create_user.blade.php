@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Header -->
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold text-primary">{{ __("Create New Account") }}</h1>
                    <p class="text-muted">{{ __("Set up a new user") }}</p>
                </div>

                <!-- Form Card -->
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('user-management.store') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    {{ __("Full Name") }}
                                </label>
                                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __("John Doe") }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    {{ __("E-Mail-Adress") }}
                                </label>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ihre.email@beispiel.de">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __("Register User") }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Back to Management -->
                <div class="text-center mt-4">
                    <a href="{{ url('/user-management') }}" class="btn btn-link text-muted text-decoration-none">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        {{ __("Back to User Management") }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection