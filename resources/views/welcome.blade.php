@extends('layouts.app')

@section('content')
    <!-- Hero section -->
    <div class="vh-section">
        <div class="container content hero">
            <h1 class="hero-title">{{ config('app.name') }}</h1>
            <p><span class="brand-name">{{ config('app.name') }}</span> ist ein Informationssystem zur Dokumentation von
                Laserreinigungsverfahren bei der Restaurierung historischer Oberflächen. Das System wurde 2025 vom <a
                    href="https://www.fh-potsdam.de/studium-weiterbildung/fachbereiche/fachbereich-stadt-bau-kultur">Fachbereich
                    STADT | BAU | KULTUR</a> in Kooperation mit dem <a
                    href="https://www.fh-potsdam.de/studium-weiterbildung/fachbereiche/fachbereich-informationswissenschaften">Fachbereich
                    Informationswissenschaften</a> der <a href="https://www.fh-potsdam.de">Fachhochschule Potsdam (FHP) –
                    University of Applied Sciences</a> entwickelt.</p>
        </div>
    </div>
    <div class="container">
        <!-- More content here -->
    </div>
@endsection
