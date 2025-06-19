@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <!-- Hero Section -->
                <div class="text-center mb-5">
                    <!-- Laser-Icon -->
                    <!-- <div class="mx-auto mb-4 bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 100px; height: 100px;">
                                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    class="text-white">
                                                    <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"
                                                        fill="currentColor" />
                                                    <circle cx="12" cy="18" r="2" fill="currentColor" />
                                                    <path d="M8 20H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                            </div> -->

                    <h1 class="display-4 fw-bold text-primary mb-3">{{ config('app.name') }}</h1>
                    <p class="lead text-muted">Datenbank zu Reinigungslasern in der Restaurierung</p>
                    <p class="text-muted">Aktuell sind <strong>{{ $deviceCount }}</strong> Lasergeräte registriert.</p>
                </div>

                <!-- Main Content Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <!-- Construction Icon
                                                        <div class="mb-4">
                                                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg" class="text-warning">
                                                                <path d="M12 2L15.09 8.26L22 9L15.09 9.74L12 16L8.91 9.74L2 9L8.91 8.26L12 2Z"
                                                                    fill="currentColor" />
                                                                <circle cx="12" cy="18" r="2" fill="currentColor" />
                                                            </svg>
                                                        </div>
                                                        -->

                            <h2 class="h4 fw-bold mb-4">Hier entsteht das {{ config('app.name') }}</h2>

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
                                            <svg class="bi" aria-hidden="true">
                                                <use xlink:href="#bi-search"></use>
                                            </svg>
                                        </div>
                                        <h6 class="fw-bold small">Lasersuche</h6>
                                        <p class="small text-muted mb-0">Erweiterte Suchfunktionen</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <div class="text-primary mb-2">
                                            <svg class="bi" aria-hidden="true">
                                                <use xlink:href="#bi-database"></use>
                                            </svg>
                                        </div>
                                        <h6 class="fw-bold small">Datenbank</h6>
                                        <p class="small text-muted mb-0">Strukturierte Informationen</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <div class="text-primary mb-2">
                                            <svg class="bi" aria-hidden="true">
                                                <use xlink:href="#bi-magic"></use>
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
            </div>
        </div>
    </div>
@endsection
