@extends('layouts.app')

@section('content')
    <!-- Hero section -->
    <div class="vh-section">
        <div class="container content hero">
            <h1 class="hero-title">{{ $appName }}</h1>
            <p><span class="brand-name">{{ $appName }}</span> ({{ $appNameLong }}) ist ein Informationssystem zur
                Dokumentation von
                Laserreinigungsverfahren bei der Restaurierung historischer Oberflächen. Das System wurde 2025 vom <a
                    href="https://www.fh-potsdam.de/studium-weiterbildung/fachbereiche/fachbereich-stadt-bau-kultur">Fachbereich
                    STADT | BAU | KULTUR</a> in Kooperation mit dem <a
                    href="https://www.fh-potsdam.de/studium-weiterbildung/fachbereiche/fachbereich-informationswissenschaften">Fachbereich
                    Informationswissenschaften</a> der <a href="https://www.fh-potsdam.de">Fachhochschule Potsdam (FHP) –
                    University of Applied Sciences</a> entwickelt.</p>
        </div>
    </div>
    <div class="container">
        <!-- Project/dataset information section -->
        <section class="row g-md-5 pb-md-5 mb-5 align-items-center">
            <div class="col-lg-8 mb-5">
                <h2 class="display-5 mb-3 fw-semibold lh-sm">Erfasste Daten</h2>
                <p class="lead fw-normal">Das System dokumentiert umfassende Informationen zu Laserreinigungsverfahren für
                    wissenschaftliche Forschung und Restaurierungspraxis.</p>
            </div>
            <div class="row gx-md-5">
                <div class="col-lg-6 mb-5">
                    <h3 class="fw-semibold">Statistiken</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Schema</th>
                                <th>Erfassten Datensätze</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Projekte</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Laser</td>
                                <td>{{ $deviceCount }}</td>
                            </tr>
                            <tr>
                                <td>Messreihen</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Artefakte</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>…</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 mb-3">
                    <h3 class="fw-semibold">Technische Parameter</h3>
                    <p>
                        Detaillierte Aufzeichnung der verwendeten Lasergeräte, Optiken und Einstellungen.
                    </p>
                    <h3 class="fw-semibold mt-5">Objekt- und Projektdokumentation</h3>
                    <p>
                        Erfassung von Artefakten und deren Materialien, Schadensmuster und Erhaltungszustand vor und nach
                        der Laserreinigung. Projektdaten, Standortdaten und beteiligte Personen und Institutionen ergänzen
                        die Dokumentation.
                    </p>
                </div>
            </div>
        </section>

        <!-- Research features section -->
        <section class="row g-md-5 pb-md-5 mb-5 align-items-center">
            <div class="col-lg-8 mb-5">
                <h2 class="display-5 mb-3 fw-semibold lh-sm">Funktionen</h2>
                <p class="lead fw-normal">Das System bietet umfassende Recherche- und Analysefunktionen.</p>
            </div>
            <div class="row gx-md-5">
                <div class="col-lg-8 mb-3">
                    <h3 class="fw-semibold">Suche</h3>
                    <p>
                        Die einfache Suche ermöglicht die schnelle Recherche mit Schlagworten.
                    </p>
                    <p>
                        <button class="btn btn-outline-primary"
                            onclick="document.getElementById('nav-search-input').focus()">→ Jetzt suchen</button>
                    </p>
                    <h3 class="fw-semibold mt-5">Erweiterte Suche</h3>
                    <p>
                        Die erweiterte Suche bietet umfassende Filter- und Sortierfunktionen für detailliertere
                        Recherchen.
                    </p>
                    <p>
                        <a class="btn btn-outline-primary" href="{{ route('advanced_search') }}">→ Recherche starten</a>
                    </p>
                </div>
                <div class="col-lg-4 mb-5 text-secondary">
                    <svg class="bi bi-fluid" aria-hidden="true">
                        <use xlink:href="#bi-sliders"></use>
                    </svg>
                </div>
            </div>
        </section>

        <!-- Research features section -->
        <section class="row g-md-5 pb-md-5 mb-5 align-items-center">
            <div class="col-lg-8 mb-5">
                <h2 class="display-5 mb-3 fw-semibold lh-sm">… weitere Informationen folgen</h2>
            </div>
        </section>
    </div>
@endsection
