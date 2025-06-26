<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-vh-100">

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

<body class="d-flex flex-column min-vh-100">
    <!-- SVG Symbols Sprite -->
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <!-- Logo placeholder -->
        <symbol id="app-logo" viewBox="0 0 40 40" fill="none">
            <circle cx="20" cy="20" r="20" class="app-logo-bg" />
            <g transform="translate(8, 8)">
                <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"
                    class="app-logo-accent" />
                <circle cx="12" cy="18" r="2" class="app-logo-accent" />
            </g>
        </symbol>
        <!-- Database Icon -->
        <symbol id="bi-database" viewBox="0 0 16 16">
            <path
                d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313M13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A5 5 0 0 0 13 5.698M14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A5 5 0 0 0 13 8.698m0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525" />
        </symbol>
        <!-- Icon Magic -->
        <symbol id="bi-magic" viewBox="0 0 16 16">
            <path
                d="M9.5 2.672a.5.5 0 1 0 1 0V.843a.5.5 0 0 0-1 0zm4.5.035A.5.5 0 0 0 13.293 2L12 3.293a.5.5 0 1 0 .707.707zM7.293 4A.5.5 0 1 0 8 3.293L6.707 2A.5.5 0 0 0 6 2.707zm-.621 2.5a.5.5 0 1 0 0-1H4.843a.5.5 0 1 0 0 1zm8.485 0a.5.5 0 1 0 0-1h-1.829a.5.5 0 0 0 0 1zM13.293 10A.5.5 0 1 0 14 9.293L12.707 8a.5.5 0 1 0-.707.707zM9.5 11.157a.5.5 0 0 0 1 0V9.328a.5.5 0 0 0-1 0zm1.854-5.097a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L8.646 5.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0l1.293-1.293Zm-3 3a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L.646 13.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0z" />
        </symbol>
        <!-- Hamburger Menu Icon -->
        <symbol id="bi-menu" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z">
            </path>
        </symbol>
        <!-- Search Icon -->
        <symbol id="bi-search" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
            </path>
        </symbol>
        <!-- UI Sliders icon -->
        <symbol id="bi-sliders" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z" />
        </symbol>
    </svg>

    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- Skip to content -->
        <a class="visually-hidden-focusable d-inline-flex p-2 m-1" href="#content">Springe zum Inhalt</a>

        <!-- Header -->
        <header class="navbar navbar-expand-lg sticky-top bg-body-secondary">
            <!-- Navigation -->
            <nav class="container-fluid" aria-label="Hauptnavigation">
                <!-- Brand/Logo -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"
                    aria-label="{{ config('app.name') }}">
                    <svg class="app-logo">
                        <use xlink:href="#app-logo"></use>
                    </svg>
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                    aria-label="Navigation ein-/ausblenden">
                    <svg width="24" height="24" aria-hidden="true">
                        <use xlink:href="#bi-menu"></use>
                    </svg>
                    <span class="d-none fs-6 pe-1">Navigation ein-/ausblenden</span>
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
                                <svg class="bi" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#bi-search"></use>
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
                                <a class="nav-link" href="{{ url('/inputform') }}">
                                    Eingabemaske
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/advanced_search') }}">
                                    Erweiterte Suche
                                </a>
                            </li>
                        </ul>

                        <hr class="d-lg-none">

                        <!-- Truly centered Search on Desktop -->
                        <div class="position-absolute start-50 translate-middle-x d-none d-lg-block"
                            style="width: 25vw">
                            <form id="nav-search-form" class="d-flex" role="search">
                                <input id="nav-search-input" class="form-control me-2" type="search"
                                    placeholder="Suche..." aria-label="Suche">
                                <button type="submit" class="btn btn-outline-secondary" aria-label="Suchen">
                                    <svg class="bi" width="16" height="16" aria-hidden="true">
                                        <use xlink:href="#bi-search"></use>
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
        <main id="content" class="flex-grow-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 bg-body-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="fw-bold">{{ config('app.name') }} Version {{ $appVersion }}</h6>
                        <p class="small mb-0">
                            Datenbank zu Reinigungslasern in der Restaurierung<br>
                            Fachhochschule Potsdam - Studentisches Projekt<br>
                            <a href="{{ route('datenschutz') }}">Datenschutzerklärung</a>
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
