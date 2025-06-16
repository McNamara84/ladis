<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Theme Color: Should be set to the primary color of the website -->
    <meta name="theme-color" content="#000">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') | @endif{{ config('app.name') }}</title>

    <!-- Scripts -->
    @if (app()->environment('testing'))
        <!-- Bootstrap CSS from CDN (für Tests) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @else
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif
</head>

<body>
    <div id="app">
        <!-- Skip to content -->
        <a class="visually-hidden-focusable d-inline-flex p-2 m-1" href="#content">Springe zum Inhalt</a>

        <!-- Header -->
        <header class="navbar navbar-expand-lg sticky-top bg-secondary-subtle">
            <!-- Navigation -->
            <nav class="container-fluid" aria-label="Hauptnavigation">
                <!-- Brand/Logo -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"
                    aria-label="{{ config('app.name') }}">
                    <!-- Laser-Symbol Logo -->
                    <svg class="navbar-logo" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background Circle -->
                        <circle cx="20" cy="20" r="20" class="logo-bg" />
                        <!-- Laser Icon (scaled and centered) -->
                        <g transform="translate(8, 8)">
                            <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"
                                class="logo-icon" />
                            <circle cx="12" cy="18" r="2" class="logo-icon" />
                        </g>
                    </svg>
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                    aria-label="Navigation ein-/ausblenden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bi"
                        height="24" width="24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z">
                        </path>
                    </svg> <span class="d-none fs-6 pe-1">Navigation ein-/ausblenden</span>
                </button>

                <!-- Offcanvas Menu -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navigation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Navigation schließen"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- Mobile Search -->
                        <form class="d-flex d-lg-none" role="search">
                            <input class="form-control me-2" type="search" placeholder="Suche..." aria-label="Suche">
                            <button type="submit" class="btn btn-outline-secondary" aria-label="Suchen">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16" aria-hidden="true">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                    </path>
                                </svg>
                            </button>
                        </form>

                        <hr class="d-lg-none">

                        <!-- Left Side Navigation -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" aria-disabled="true">
                                    Hilfe
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" aria-disabled="true">
                                    Erweiterte Suche
                                </a>
                            </li>
                        </ul>

                        <hr class="d-lg-none">

                        <!-- Truly centered Search on Desktop -->
                        <div class="position-absolute start-50 translate-middle-x d-none d-lg-block"
                            style="width: 25vw">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Suche..."
                                    aria-label="Suche">
                                <button type="submit" class="btn btn-outline-secondary" aria-label="Suchen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Right Side Navigation -->
                        <ul class="navbar-nav">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                                        href="{{ route('login') }}">
                                        Login
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                                            href="{{ route('register') }}">
                                            Registrieren
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            Dashboard
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main id="content" class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 mt-5 border-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="fw-bold">{{ config('app.name') }} Version {{ $projectVersion }}</h6>
                        <p class="small mb-0">
                            Datenbank zu Reinigungslasern in der Restaurierung<br>
                            Fachhochschule Potsdam - Studentisches Projekt
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <p class="small mb-0">
                            LIZENZ {{ date('Y') }} FH Potsdam<br>
                            Vorname Nachname, Vorname Nachname, ...<br>
                            Vorname Nachname, Vorname Nachname, ...
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @if (app()->environment('testing'))
        <!-- Bootstrap JS from CDN (for Tests) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    @endif
</body>

</html>
