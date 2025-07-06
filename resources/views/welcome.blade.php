@extends('layouts.app')

@section('content')
    <!-- Hero section -->
    <div class="vh-section">
        <div class="container content hero">
            <h1 class="hero-title">{{ config('app.name') }}</h1>
            <p><span class="brand-name">{{ config('app.name') }}</span> {{ __("messages.a00") }}</p>
            <p>{!! __("messages.a01", [
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
                <h2 class="display-5 mb-3 fw-semibold lh-sm">{{ __("Recorded Data") }}</h2>
                <p class="lead fw-normal">{{ __("messages.a02") }}</p>
            </div>
            <div class="row gx-md-5">
                <div class="col-lg-6 mb-5">
                    <h3 class="fw-semibold">{{ __(key: "Statistics") }}</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __("Schema") }}</th>
                                <th>{{ __("Recorded Datasets") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __("Projects") }}</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>{{ __("Laser Devices") }}</td>
                                <td>{{ $deviceCount }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Data Sheets") }}</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>{{ __("Artifacts") }}</td>
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
                    <h3 class="fw-semibold">{{ __("Technical Parameters") }}</h3>
                    <p>{{ __("messages.a03") }}</p>
                    <h3 class="fw-semibold mt-5">{{ __("Object and Project Documentation") }}</h3>
                    <p>{{ __("messages.a04") }}</p>
                </div>
            </div>
        </section>

        <!-- Research features section -->
        <section class="row g-md-5 pb-md-5 mb-5 align-items-center">
            <div class="col-lg-8 mb-5">
                <h2 class="display-5 mb-3 fw-semibold lh-sm">{{ __("Functions") }}</h2>
                <p class="lead fw-normal">{{ __("messages.a05") }}</p>
            </div>
            <div class="row gx-md-5">
                <div class="col-lg-8 mb-3">
                    <h3 class="fw-semibold">{{ __("Search") }}</h3>
                    <p>{{ __("messages.a06") }}</p>
                    <p>
                        <button class="btn btn-outline-primary"
                            onclick="document.getElementById('nav-search-input').focus()">{{ __("→ Search Now") }}</button>
                    </p>
                    <h3 class="fw-semibold mt-5">{{ __("Advanced Search") }}</h3>
                    <p>{{ __("messages.a07") }}</p>
                    <p>
                        <a class="btn btn-outline-primary" href="{{ route('advanced_search') }}">{{ __("→ Begin Research") }}</a>
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
                <h2 class="display-5 mb-3 fw-semibold lh-sm">{{ __("More information to follow …") }}</h2>
            </div>
        </section>
    </div>
@endsection
