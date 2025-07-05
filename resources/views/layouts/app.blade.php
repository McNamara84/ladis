<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-vh-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Theme Color: Should be set to the primary color of the website -->
    <meta name="theme-color" content="#f5f4f3" />
    <meta name="theme-color" content="#141414" media="(prefers-color-scheme: dark)" />

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

    <!-- Metadata associated with the site in web application context -->
    <link rel="manifest" href="/site.webmanifest">

    <!-- Favicons -->
    <link rel="icon" href="/icon.svg" type="image/svg+xml">
    <link rel="icon" href="/favicon.ico" sizes="16x16 32x32 48x48">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- SVG Symbols Sprite -->
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <!-- LADIS Logo -->
        <symbol id="ladis-logo" viewBox="0 0 3300 3300" fill="none">
            <path class="app-logo-primary"
                d="m 1446.5,2950.3712 c -74.2025,-3.7592 -137.7224,-11.6313 -205,-25.4059 C 860.88816,2847.0382 533.00015,2595.5521 357.56746,2247 307.87445,2148.2692 270.818,2043.4398 249.57539,1941.5 c -1.94839,-9.35 -4.01691,-18.4289 -4.59672,-20.1754 -0.57981,-1.7465 -0.76342,-4.334 -0.40803,-5.75 L 245.21682,1913 h 331.77027 331.77027 l 1.22487,2.9571 c 0.67368,1.6264 1.2593,3.3139 1.30137,3.75 0.19044,1.9742 12.6746,28.4714 21.18288,44.9599 60.51064,117.2657 158.38152,214.9443 275.95202,275.4098 78.6664,40.4574 159.9162,63.2597 249.5815,70.0436 20.0959,1.5204 68.2172,1.5115 88,-0.016 90.5331,-6.9918 170.8104,-29.5159 249.5815,-70.0272 77.8523,-40.0388 148.4506,-97.3841 203.8431,-165.5768 5.3611,-6.6 11.2766,-13.8771 13.1455,-16.1714 l 3.398,-4.1714 26.766,6.8453 c 29.8329,7.6296 51.9053,14.2306 75.7659,22.6586 86.3653,30.5058 206.7475,90.6395 284.1279,141.9285 82.5895,54.7417 116.4267,96.1718 139.385,170.6628 l 5.0915,16.5202 -17.9169,23.8949 c -40.9244,54.579 -71.8617,90.1953 -121.0966,139.4113 -39.4059,39.3907 -67.2931,64.5 -106.0909,95.5227 -163.4196,130.67 -356.9338,219.5183 -561.5,257.8019 -49.456,9.2554 -99.2641,15.4938 -157,19.664 -14.2435,1.0287 -122.157,2.0557 -137,1.3038 z M 225.99339,1788.75 c -0.004,-1.2375 -0.65925,-10.575 -1.45692,-20.75 -5.13133,-65.4548 -4.53509,-152.4173 1.48781,-217 17.20496,-184.4863 72.43975,-359.3535 163.77712,-518.5 45.06194,-78.51604 97.94698,-151.39288 161.10028,-222 17.48237,-19.54577 72.25055,-74.26303 92.38103,-92.29513 C 694.11104,672.6748 742.4346,635.38604 798.44325,598.47561 973.09863,483.37543 1173.8908,413.10663 1382.5,394.0803 c 44.9657,-4.10112 57.6548,-4.58084 120.5,-4.55554 64.3869,0.0259 80.3298,0.71151 129,5.54743 161.2062,16.01762 321.356,63.97796 464.1202,138.99096 217.5803,114.32381 397.2398,287.59373 519.2614,500.79395 l 7.6447,13.3572 -4.0802,15.6428 c -25.4321,97.5008 -42.1011,153.7288 -59.6295,201.1429 -9.752,26.379 -32.2926,67.942 -53.0004,97.7283 -19.9198,28.6529 -48.786,60.3454 -73.6359,80.8458 -40.4674,33.3843 -98.6915,67.4351 -181.1803,105.9584 -28.2451,13.1908 -106.946,48.2904 -109.9915,49.0547 -2.1081,0.5291 -2.2547,0.1695 -2.919,-7.1618 -1.0467,-11.5505 -6.1532,-41.5394 -10.1149,-59.4022 -19.7134,-88.8841 -58.0984,-172.5511 -112.6419,-245.5232 -70.9203,-94.8821 -166.743,-168.426 -276.8327,-212.469 -60.8333,-24.3373 -124.9369,-39.0019 -193,-44.1514 -19.9379,-1.5085 -68.0621,-1.5085 -88,0 -89.7136,6.7876 -170.8728,29.5645 -249.5815,70.0436 -118.0005,60.6867 -215.80861,158.4948 -276.49525,276.4953 -40.47992,78.7101 -63.09656,159.3266 -70.01907,249.5815 -1.52924,19.9379 -1.52924,68.0621 0,88 1.83398,23.9113 6.72615,61.9005 9.62613,74.75 l 0.50779,2.25 H 549.01905 226 Z" />
            <path class="app-logo-accent"
                d="m 2684.6181,2436.25 c -1.5507,-15.9062 -3.9424,-32.5618 -6.2768,-43.711 -23.73,-113.335 -118.8231,-217.4102 -278.5901,-304.9048 C 2198.5369,1977.4415 1900.185,1897.7608 1570,1866.033 c -11.6694,-1.1213 -53.8803,-4.3673 -78.4055,-6.0293 -8.748,-0.5928 -16.173,-1.2389 -16.5,-1.4358 -0.327,-0.1969 -8.6609,-0.6524 -18.5198,-1.0123 -9.8589,-0.3598 -18.1839,-0.8058 -18.5,-0.9911 -0.3161,-0.1852 -13.6247,-0.6368 -29.5747,-1.0035 -15.95,-0.3667 -40.25,-1.084 -54,-1.5941 -13.75,-0.51 -30.9625,-0.9362 -38.25,-0.9471 -7.2875,-0.011 -13.25,-0.3858 -13.25,-0.8331 0,-0.4474 21.0375,-1.3741 46.75,-2.0593 25.7125,-0.6853 50.125,-1.4305 54.25,-1.6561 4.125,-0.2256 16.05,-0.6503 26.5,-0.9437 10.45,-0.2935 21.925,-0.8003 25.5,-1.1262 3.575,-0.3258 9.2,-0.7198 12.5,-0.8753 15.4625,-0.7289 89.9659,-6.9512 127,-10.6067 261.37,-25.7987 500.1092,-81.4771 685.3827,-159.8439 10.5711,-4.4713 23.499,-10.1425 28.7288,-12.6026 5.2298,-2.4601 9.6869,-4.4729 9.9046,-4.4729 0.2177,0 12.3024,-5.8133 26.855,-12.9184 188.4477,-92.008 301.9103,-207.2522 331.2398,-336.4413 2.9639,-13.0551 6.3639,-34.5408 6.3785,-40.3085 0.011,-4.4854 0.7753,-7.3318 1.9678,-7.3318 0.8569,0 2.4757,15.1294 4.6006,43 2.2616,29.6621 6.1307,52.6717 14.5452,86.5 37.7264,151.6692 123.2861,276.1544 244.6069,355.8913 88.5232,58.1809 195.9201,93.0155 321.5401,104.2928 3.7125,0.3333 6.75,0.8937 6.75,1.2453 0,0.3516 -10.9125,1.4392 -24.25,2.4168 -31.2644,2.2918 -51.5057,4.8212 -73.5257,9.1882 -104.2977,20.6842 -203.5391,67.7024 -282.7071,133.94 -81.106,67.859 -140.6002,154.9965 -175.5162,257.0677 -14.3922,42.0732 -26.1092,93.852 -30.4264,134.4579 -2.251,21.1722 -4.5816,47.0089 -4.5778,50.75 0.01,5.9004 -1.7081,3.3785 -2.3787,-3.5 z" />
        </symbol>
        <!-- Database Icon -->
        <symbol id="bi-database" viewBox="0 0 16 16">
            <path
                d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313M13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A5 5 0 0 0 13 5.698M14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A5 5 0 0 0 13 8.698m0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525" />
        </symbol>
        <!-- Magic Icon -->
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
                    <!-- LADIS Logo -->
                    <svg class="app-logo">
                        <use xlink:href="#ladis-logo"></use>
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
                        <form class="d-flex d-lg-none" role="search" action="{{ route('search_results') }}" method="GET">
                            <input class="form-control me-2" type="search" name="q" placeholder="Suche..." aria-label="Suche">
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
                                <a class="nav-link" href="{{ route('advanced_search') }}">
                                    Erweiterte Suche
                                </a>
                            </li>
                        </ul>

                        <hr class="d-lg-none">

                        <!-- Truly centered Search on Desktop -->
                        <div class="position-absolute start-50 translate-middle-x d-none d-lg-block"
                            style="width: 25vw">
                            <form id="nav-search-form" class="d-flex" role="search" action="{{ route('search_results') }}" method="GET">
                                <input id="nav-search-input" class="form-control me-2" type="search" name="q"
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
                                    <a class="nav-link {{ request()->routeIs('inputform_material.index') ? 'active' : '' }}"
                                        href="{{ route('inputform_material.index') }}">
                                        + Material
                                    </a>
                                </li>
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
                        <h6 class="fw-bold">{{ config('app.name') }} {{ $appVersion }}</h6>
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
