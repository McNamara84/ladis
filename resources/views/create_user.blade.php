@extends('layouts.app')

@section('title', 'Benutzer anlegen')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Header -->
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold text-primary">Neuen Account erstellen</h1>
                    <p class="text-muted">Erstellen Sie einen neuen Benutzer</p>
                </div>

                <!-- Form Card -->
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <form method="POST" action="#">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    Vollständiger Name
                                </label>
                                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Max Mustermann">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    E-Mail-Adresse
                                </label>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ihre.email@beispiel.de">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    Passwort
                                </label>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Mindestens 8 Zeichen">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label fw-semibold">
                                    Passwort bestätigen
                                </label>
                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" autocomplete="new-password" placeholder="Passwort wiederholen">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Benutzer anlegen
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
                        Zurück zur Benutzerverwaltung
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection