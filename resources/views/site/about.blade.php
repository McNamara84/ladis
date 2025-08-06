@extends('layouts.page.default')

@section('title', 'Über das Projekt LADIS')

@section('excerpt')
    <p>
        <span class="fst-italic">Optimierung von Lasertechnik zur Reinigung und Desinfektion von historischen Oberflächen
            (AZ 35765/01)</span><br>Ein Forschungsprojekt der Kulturstiftung Sachsen-Anhalt<br>
    </p>
@endsection

@section('page-content')
    <div class="flow">
        <h2>Über das Projekt</h2>
        <div class="row">
            <div class="col-lg-8">
                <p>Die Laserreinigung hat in den vergangenen Jahren einen immer höheren Stellenwert in der Restaurierung
                    historischer
                    Oberflächen eingenommen. Um diese Technologie einem noch größeren Kreis anwendender
                    Restaurator*innen zugänglich
                    zu
                    machen, bedarf es eines systematischen Erfahrungstransfers, den das hier durch die <x-contact.link
                        :contact="$inlineContacts['dbu']" /> unterstützte Projekt der <x-contact.link
                        :contact="$inlineContacts['ksa']" /> befördern soll. So
                    wurden aktuell
                    in
                    der Denkmalpflege für verschiedene Reinigungsaufgaben <x-link route="devices.all"
                        text="eingesetzte Lasergeräte" />
                    anhand von
                    unterschiedlichen Musterflächen vergleichend getestet. Welches Gerät ist für welchen Zweck geeignet
                    und was sind
                    erfolgversprechende Einstellparamater? Im Mittepunkt der Betrachtungen stand der <x-link
                        text="Halberstädter Dom" />
                    mit seinen stark verkrusteten Kalksteinoberflächen. Aber auch Sandsteine an den <x-link
                        text="Domen in Magdeburg und Halle" /> sowie Alabasteruntergründe wurden systematisch
                    untersucht. Ein
                    wesentlicher Pfeiler für die systematische Erfassung umfassender Ergebnisse bildeten verschiedene
                    Qualifikationsarbeiten im <x-contact.link :contact="$inlineContacts['fb2-konservierung']" />.
                    So wurden materialübergreifend auch verruste oder mit
                    Graffiti
                    verschmutzte Holzoberflächen zum Gegenstand des Forschungsprojektes. Die für viele Anwender*innen
                    interessanten
                    Ergebnisse sind in vorbildlicher Weise in eine Datenbank im Sinne eines „Offenen
                    Anwendungskataloges“
                    eingeflossen.
                </p>
            </div>
            <div class="col-lg-4">
                <figure class="figure">
                    <img class="img-fluid rounded-circle"
                        srcset="/images/ladis-illustration-01-400w.webp 400w, /images/ladis-illustration-01-600w.webp 600w, /images/ladis-illustration-01-800w.webp 800w, /images/ladis-illustration-01-1000w.webp 1000w, /images/ladis-illustration-01-1200w.webp 1200w, /images/ladis-illustration-01-1600w.webp 1600w, /images/ladis-illustration-01-2000w.webp 2000w"
                        sizes="(max-width: 400px) 400px, (max-width: 600px) 600px, (max-width: 800px) 800px, (max-width: 1000px) 1000px, (max-width: 1200px) 1200px, (max-width: 1600px) 1600px, (min-width: 1601px) 2000px"
                        src="/images/ladis-illustration.jpg" alt="" width="2881" height="2815" />
                    <figcaption class="figure-caption text-center">Ein Bild in schwarz/weiß</figcaption>
                </figure>

            </div>
        </div>

        <h2>Die Datenbank</h2>
        <p>Ein erklärtes Ziel des Projekts ist ein detaillierter <x-link text="Anwendungs- und Einstellungskatalog" />, der
            für typische Verschmutzungsbilder unterschiedlicher Materialien sowohl die Oberflächen- und Schadensbeschreibung
            als auch die
            jeweils optimalen Laser und deren Einstellparameter zusammenfasst.</p>
        <p>Der Katalog wurde als fortschreibbare Datenbank konzipiert. Sie ist mit dem Ziel angelegt, eine kontinuierliche
            Erweiterung durch weitere Fachanwender*innen zu ermöglichen.</p>
        <p>Erstellt wurde die Datenbank von Studierenden im <x-contact.link :contact="$inlineContacts['fb5-iud']" /> im
            Rahmen
            eines Semesterprojekts in enger
            Zusammenarbeit mit betreuenden Restauratorinnen.</p>

        <h2>Projektleitung und Kooperationspartner</h2>

        <x-contact.grid :contacts="$projectContacts" variant="card" />

@endsection
