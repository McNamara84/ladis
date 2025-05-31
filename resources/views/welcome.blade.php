@extends('layouts.app')

@section('title', 'Willkommen - Laser-Projekt')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <!-- Hero Section -->
                <div class="text-center mb-5">
                    <!-- Laser-Icon -->
                    <div class="mx-auto mb-4 bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 100px; height: 100px;">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="text-white">
                            <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"
                                fill="currentColor" />
                            <circle cx="12" cy="18" r="2" fill="currentColor" />
                            <path d="M8 20H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>

                    <h1 class="display-4 fw-bold text-primary mb-3">Laser-Projekt</h1>
                    <p class="lead text-muted">Datenbank zu Reinigungslasern in der Restaurierung</p>
                </div>

                <!-- Main Content Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <!-- Construction Icon -->
                            <div class="mb-4">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="text-warning">
                                    <path d="M12 2L15.09 8.26L22 9L15.09 9.74L12 16L8.91 9.74L2 9L8.91 8.26L12 2Z"
                                        fill="currentColor" />
                                    <circle cx="12" cy="18" r="2" fill="currentColor" />
                                </svg>
                            </div>

                            <h2 class="h4 fw-bold mb-4">Hier entsteht das Laser-Projekt</h2>

                            <p class="text-muted mb-4">
                                Eine Datenbank zu Reinigungslasern und deren Einsatzmöglichkeiten in der Restaurierung.
                                Die Webanwendung wird entwickelt im Rahmen eines studentischen Projekts an der
                                <strong>FH Potsdam</strong>.
                            </p>

                            <!-- Features Preview -->
                            <div class="row g-3 mt-4">
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <div class="text-primary mb-2">
                                            <svg width="24" height="24" fill="currentColor" class="bi bi-search"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </div>
                                        <h6 class="fw-bold small">Lasersuche</h6>
                                        <p class="small text-muted mb-0">Erweiterte Suchfunktionen</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <div class="text-primary mb-2">
                                            <svg width="24" height="24" fill="currentColor" class="bi bi-database"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M4.318 2.687C6.068 2.31 8.974 2 12 2s5.932.31 7.682.687C15.456 3.088 16 3.5 16 4s-.544.912-2.318 1.313C11.932 5.69 9.026 6 6 6s-5.932-.31-7.682-.687C-3.456 4.912-4 4.5-4 4s.544-.912 2.318-1.313zM6 13c-3.026 0-5.932-.31-7.682-.687C-3.456 11.912-4 11.5-4 11V4c0-.5.544-.912 2.318-1.313C0.068 2.31 2.974 2 6 2s5.932.31 7.682.687C15.456 3.088 16 3.5 16 4v7c0 .5-.544.912-2.318 1.313C11.932 13.69 9.026 14 6 14z" />
                                            </svg>
                                        </div>
                                        <h6 class="fw-bold small">Datenbank</h6>
                                        <p class="small text-muted mb-0">Strukturierte Informationen</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <div class="text-primary mb-2">
                                            <svg width="24" height="24" fill="currentColor" class="bi bi-palette"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                                <path
                                                    d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8z" />
                                            </svg>
                                        </div>
                                        <h6 class="fw-bold small">Restaurierung</h6>
                                        <p class="small text-muted mb-0">Bauwerke & Skulpturen</p>
                                    </div>
                                </div>
                            </div>

                            @guest
                                <div class="mt-5">
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                                        Zum Login
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                            Registrieren
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="mt-5">
                                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                                        Zum Dashboard
                                    </a>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>

                <!-- Development Info -->
                <div class="mt-4 text-center">
                    <p class="small text-muted">
                        Version 0.1.0
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection