@extends('layouts.page.default')

@section('title', 'Kontakt')

@section('excerpt')
    <p>Auf dieser Seite finden Sie die Kontaktmöglichkeiten rund um das {{ $appName }} Projekt.</p>
@endsection

@section('page-content')
    <div class="flow">
        <p>Ansprechpartner und Institutionen zu Fragen, die den Datenschutz betreffen, finden Sie in der <x-link
                route="datenschutz" text="Datenschutzerklärung" />. Informationen zum Betrieb der Website und den
            Verantwortlichen sind im <x-link route="impressum" text="Impressum" /> enthalten.</p>
        <div class="row g-5 my-3">
            <div class="col-md-6 flow">
                <h2>Allgemeiner Kontakt</h2>
                <p>Für allgemeine Fragen und Anregungen wenden Sie sich bitte an:</p>
                <x-contact variant="card" :contact="$allContacts['fb2']" />
            </div>
            <div class="col-md-6 flow">
                <h2>Technische Anliegen</h2>
                <p>Fragen zur Funktionalität der App bzw. Fehler und Bugs können dem EntwicklerInnen-Team auf <a
                        href="{{ $appRepoURL }}"><x-icon icon="{{ $appRepoIcon }}" /> {{ $appRepoPlatformName }}</a>
                    gemeldet werden.</p>
            </div>
        </div>
    </div>
@endsection
