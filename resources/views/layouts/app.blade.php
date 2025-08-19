<!doctype html>
<html lang="{{ localeToBCP47() }}" class="min-vh-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Theme Color: Should be set to the primary color of the website -->
    <meta name="theme-color" content="#f5f4f3" />
    <meta name="theme-color" content="#141414" media="(prefers-color-scheme: dark)" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') | @endif{{ $appName }}</title>

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
    <!-- Include SVG Symbols Sprite -->
    @include('partials._svg-sprite')

    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- Skip to content -->
        <a class="visually-hidden-focusable d-inline-flex p-2 m-1" href="#content">Springe zum Inhalt</a>

        <!-- Header -->
        <header class="navbar navbar-expand-lg sticky-top bg-body-secondary">
            <!-- Navigation -->
            <nav class="container-fluid" aria-label="Hauptnavigation">
                <!-- Brand/Logo -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('frontpage') }}"
                    aria-label="{{ $appName }}">
                    <!-- LADIS Logo -->
                    <x-icon icon="ladis-logo" />
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                    aria-label="Navigation ein-/ausblenden">
                    <x-icon icon="bi-menu" />
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
                        <!-- Search Form -->
                        <form id="nav-search-form" class="d-flex mx-lg-2" role="search"
                            action="{{ route('search_results') }}" method="GET">
                            <input id="nav-search-input" class="form-control me-2" type="search" name="q"
                                placeholder="Suche..." aria-label="Suche">
                            <button type="submit" class="btn btn-outline-secondary" aria-label="Suchen">
                                <x-icon icon="bi-search" />
                            </button>
                        </form>

                        <hr class="d-lg-none">

                        <!-- Left Side Navigation -->
                        <ul class="navbar-nav me-auto">
                            <x-nav.item route="advanced_search" text="Erweiterte Suche" />
                            <x-nav.divider />
                            <li class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <x-icon icon="bi-database" class="me-2" />
                                    <span>Daten</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><x-link class="dropdown-item" route="projects.all" text="Projekte"
                                            icon="bi-rocket-takeoff" /></li>
                                    <li><x-link class="dropdown-item" route="institutions.all" text="Institutionen"
                                            icon="bi-bank2" /></li>
                                    <li><x-link class="dropdown-item" route="devices.all" text="Laser"
                                            icon="bi-lightning-charge" /></li>
                                    <li><x-link class="dropdown-item" route="persons.all" text="Personen"
                                            icon="bi-person-vcard-fill" /></li>
                                    <li><x-link class="dropdown-item" route="materials.all" text="Material"
                                            icon="bi-stack" /></li>
                                    <li><x-link class="dropdown-item" route="processes.all" text="Prozesse"
                                            icon="bi-vignette" /></li>
                                    <li><x-link class="dropdown-item" route="venues.all" text="Orte"
                                            icon="bi-geo-alt" /></li>
                                    @auth
                                        <li>
                                            <x-link class="dropdown-item" route="inputform_image.index" text="Image-Upload"
                                                icon="bi-images" />
                                        </li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>

                        <hr class="d-lg-none">

                        <!-- Right Side Navigation -->
                        <ul class="navbar-nav">
                            @guest
                                <x-nav.item route="login" text="Login" />
                            @else
                                <x-nav.item route="home" text="Dashboard" icon="bi-columns" />
                                <x-nav.divider />
                                <x-nav.item route="user-management.index" text="Benutzer" icon="bi-person-gear" />
                                <x-nav.divider />
                                <x-nav.item route="help" text="Hilfe" disabled icon="bi-question-circle" />
                            @endguest
                            <x-nav.divider />
                            <li class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" aria-label="Sprache wählen">
                                    <x-icon icon="bi-translate" />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-size-auto">
                                    <li><x-link class="dropdown-item" text="DE" disabled /></li>
                                    <li><x-link class="dropdown-item" text="EN" disabled /></li>
                                </ul>
                            </li>
                            @auth
                                <x-nav.divider />
                                <li class="nav-item">
                                    <button type="button" class="nav-link" aria-label="Logout" data-bs-toggle="modal"
                                        data-bs-target="#logout-modal">
                                        <span class="d-lg-none me-2">Logout</span>
                                        <x-icon icon="bi-box-arrow-right" />
                                    </button>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        @auth
            <!-- Logout Confirmation Modal -->
            <!-- This MUST NOT be inside the header because of z-index issues! -->
            <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="logout-modal-label" aria-hidden="true"
                role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logout-modal-label">Logout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                        </div>
                        <div class="modal-body">
                            <p>Sind Sie sicher, dass Sie sich abmelden möchten?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Main Content -->
        <main id="content" class="flex-grow-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="site-footer bg-body-secondary py-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <ul class="list-inline mb-0" role="list">
                            <li class="list-inline-item d-block d-md-inline-block">
                                <x-link route="frontpage" text="Startseite" />
                            </li>
                            <li class="list-inline-item d-block d-md-inline-block">
                                <x-link route="faq" text="FAQ" disabled />
                            </li>
                            <li class="list-inline-item d-block d-md-inline-block">
                                <x-link route="site.about" text="Das Projekt" />
                            </li>
                            <li class="list-inline-item d-block d-md-inline-block">
                                <x-link route="datenschutz" text="Datenschutzerklärung" />
                            </li>
                            <li class="list-inline-item d-block d-md-inline-block">
                                <x-link route="tos" text="Nutzungsbedingungen" disabled />
                            </li>
                            <li class="list-inline-item d-block d-md-inline-block">
                                <x-link route="impressum" text="Impressum" />
                            </li>
                            <li class="list-inline-item d-block d-md-inline-block">
                                <x-link route="site.contact" text="Kontakt" />
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 d-md-none">
                        <hr class="my-5">
                    </div>
                    <div class="col-md-3 text-md-end">
                        <ul class="list-inline mb-0" role="list">
                            <li class="list-inline-item">
                                <a href="{{ $appRepoURL }}">
                                    <x-icon icon="{{ $appRepoIcon }}" />
                                    <span class="visually-hidden">{{ $appName }} auf {{ $appRepoPlatformName }}</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="disabled">
                                    <x-icon icon="bi-mastodon" />
                                    <span class="visually-hidden">{{ $appName }} auf Mastodon</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="disabled">
                                    <x-icon icon="bi-rss-fill" />
                                    <span class="visually-hidden">{{ $appName }} RSS Feed</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold">{{ $appName }} {{ $appVersion }}</h6>
                        <p>{{ $appTagline }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p><time datetime="{{ now()->year }}-01-01">{{ date('Y') }}</time> <x-contact.link
                                :contact="$appContactPrimary()" name-format="[n][ (a)]" /><br>
                            {{ $appName }} wird unter der <a href="{{ $appLicenseURL }}">{{ $appLicenseName }}</a>
                            bereitgestellt.
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
