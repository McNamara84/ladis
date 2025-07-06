@extends('layouts.app')

@section('content')
    <!-- Hero section -->
    <div class="vh-section">
        <div class="container content hero">
            <h1 class="hero-title">{{ config('app.name') }}</h1>
            <p><span class="brand-name">{{ config('app.name') }}</span> {{ __("messages.a01") }}</p>
            <p>{!! __("messages.a02", [
                "link01" => url('https://www.fh-potsdam.de/studium-weiterbildung/fachbereiche/fachbereich-stadt-bau-kultur'),
                "link02" => url('https://www.fh-potsdam.de/studium-weiterbildung/fachbereiche/fachbereich-informationswissenschaften'),
                "link03" => url('https://www.fh-potsdam.de'),
            ]) !!}</p>
        </div>
    </div>
    <div class="container">
        <!-- Project/dataset information section -->
        <section class="row g-md-5 pb-md-5 mb-5 align-items-center">
            <div class="col-lg-8 mb-5">
                <h2 class="display-5 mb-3 fw-semibold lh-sm">{{ __("Erfasste Daten") }}</h2>
                <p class="lead fw-normal">{{ __("messages.b01") }}</p>
            </div>
            <div class="row gx-md-5">
                <div class="col-lg-6 mb-5">
                    <h3 class="fw-semibold">{{ __(key: "Statistiken") }}</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __("Schema") }}</th>
                                <th>{{ __("erfasste Datensätze") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __("Projekte") }}</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>{{ __("Lasergeräte") }}</td>
                                <td>{{ $deviceCount }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Messreihen") }}</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>{{ __("Artefakte") }}</td>
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
                    <h3 class="fw-semibold">{{ __("Technische Parameter") }}</h3>
                    <p>{{ __("messages.c01") }}</p>
                    <h3 class="fw-semibold mt-5">{{ __("Objekt- und Projektdokumentation") }}</h3>
                    <p>{{ __("messages.c02") }}</p>
                </div>
            </div>
        </section>

        <!-- Research features section -->
        <section class="row g-md-5 pb-md-5 mb-5 align-items-center">
            <div class="col-lg-8 mb-5">
                <h2 class="display-5 mb-3 fw-semibold lh-sm">{{ __("Funktionen") }}</h2>
                <p class="lead fw-normal">{{ __("messages.d01") }}</p>
            </div>
            <div class="row gx-md-5">
                <div class="col-lg-8 mb-3">
                    <h3 class="fw-semibold">{{ ("Suche") }}</h3>
                    <p>{{ __("messages.d02") }}</p>
                    <p>
                        <button class="btn btn-outline-primary"
                            onclick="document.getElementById('nav-search-input').focus()">{{ ("→ Jetzt suchen") }}</button>
                    </p>
                    <h3 class="fw-semibold mt-5">{{ ("Erweiterte Suche") }}</h3>
                    <p>{{ __("messages.d03") }}</p>
                    <p>
                        <a class="btn btn-outline-primary" href="{{ route('advanced_search') }}">{{ ("→ Recherche starten") }}</a>
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
                <h2 class="display-5 mb-3 fw-semibold lh-sm">{{ ("Weitere Informationen folgen …") }}</h2>
            </div>
        </section>
    </div>
@endsection
