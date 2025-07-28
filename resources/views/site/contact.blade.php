@extends('layouts.page.default')

@section('title', 'Kontakt')

@section('excerpt')
    <p>In Zukunft wird diese Seite als zentrale Anlaufstelle für die Anwender*innen und Interessent*innen zur
        Kontaktaufnahme
        mit dem {{ $appName }} Team dienen.</p>
    <p>In der vorliegenden Version dient sie als Demonstrations- und Testplatz für die <code>x-contact</code>
        View-Komponente.</p>
    <p>Die Komponente ermöglicht es, Kontaktdaten in verschiedenen <a
            href="https://schema.org/docs/gs.html">Schema.org-kompatiblen Formaten</a>
        darzustellen.
        Neben der einheitlichen Darstellung und Formatierung stellt die Verwendung von zentral verwalteten Kontaktdaten
        sicher, dass diese angezeigten Informationen auf allen Seiten stets aktuell und identisch sind.</p>
@endsection

@section('page-content')
    <div class="flow">
        <h2><code>x-contact</code></h2>
        <x-contact :contact="$demoOrganization" />
        <x-contact :contact="$demoPerson" class="my-5" />

        <h2><code>x-contact.card</code></h2>
        <div class="row g-5">
            <div class="col-md-6">
                <x-contact.card :contact="$demoOrganization" />
            </div>
            <div class="col-md-6">
                <x-contact.card :contact="$demoPerson" />
            </div>
        </div>

        <h2><code>x-contact.card-list</code></h2>
        <x-contact.card-list :contacts="$allContacts" />

        <h2><code>x-contact.link</code></h2>
        <p>Lorem ipsum, dolor sit amet <x-contact.link :contact="$demoOrganization" /> consectetur
            adipisicing elit. Tempora architecto, pariatur aliquam eius ipsum labore aut vero vitae libero distinctio
            ratione, ipsam officia accusantium nihil illo maiores excepturi, et similique.</p>
        <h2>Namen formatieren</h2>
        <p>Das Ausgabeformat für Namen kann in allen Komponenten mit dem Attribut <code>name-format</code> individualisiert
            werden. Einzelne Bestandteile werden jeweils von <code>[</code> und <code>]</code> umschlossen und können
            weitere, optionale Formatierungen wie etwa Klammern beinhalten. Im Datensatz nicht vorhandene Elmente werdden
            bei der Ausgabe ignoriert.
        </p>
        <p>Die folgende Tabelle zeigt die verfügbaren Platzhalter und deren Bedeutung.</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Platzhalter</th>
                    <th>Datenfeld</th>
                    <th>Ausgabe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>[n]</code></td>
                    <td><code>name</code></td>
                    <td><x-contact.link :contact="$demoOrganization" name-format="[n]" /></td>
                </tr>
                <tr>
                    <td><code>[a]</code></td>
                    <td><code>alternateName</code></td>
                    <td><x-contact.link :contact="$demoOrganization" name-format="[a]" /></td>
                </tr>
            </tbody>
        </table>

        <h3>Weitere Beispiele</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Format</th>
                    <th>Ausgabe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>[a ][(n)]</code></td>
                    <td><x-contact.link :contact="$demoOrganization" name-format="[a ][(n)]" /></td>
                </tr>
                <tr>
                    <td><code>[n][&lt;br&gt;a]</code></td>
                    <td><x-contact.link :contact="$demoOrganization" name-format="[n][<br>a]" /></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
