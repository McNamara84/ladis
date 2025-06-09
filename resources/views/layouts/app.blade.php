<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') | @endif{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Scripts -->
    @if (app()->environment('testing'))
        <!-- Bootstrap CSS from CDN (für Tests) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @else
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-light">
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
            <div class="container">
                <!-- Brand/Logo -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
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
                    <span class="fw-bold">{{ config('app.name') }}</span>
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Left Side Navigation -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('welcome') || request()->is('/') ? 'active' : '' }}"
                                href="{{ url('/') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" aria-disabled="true">
                                Erweiterte Suche
                            </a>
                        </li>
                    </ul>

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

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-light py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="fw-bold">{{ config('app.name') }}</h6>
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
