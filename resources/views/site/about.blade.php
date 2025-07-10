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
                    machen, bedarf es eines systematischen Erfahrungstransfers, den das hier durch die <a
                        href="https://www.dbu.de">Deutsche Bundesstiftung Umwelt (DBU) </a> unterstützte Projekt der <a
                        href="https://www.kulturstiftung-st.de">Kulturstiftung Sachsen-Anhalt</a> befördern soll. So
                    wurden aktuell
                    in
                    der Denkmalpflege für verschiedene Reinigungsaufgaben <x-link text="eingesetzte Lasergeräte" />
                    anhand von
                    unterschiedlichen Musterflächen vergleichend getestet. Welches Gerät ist für welchen Zweck geeignet
                    und was sind
                    erfolgversprechende Einstellparamater? Im Mittepunkt der Betrachtungen stand der <x-link
                        text="Halberstädter Dom" />
                    mit seinen stark verkrusteten Kalksteinoberflächen. Aber auch Sandsteine an den <x-link
                        text="Domen in Magdeburg und Halle" /> sowie Alabasteruntergründe wurden systematisch
                    untersucht. Ein
                    wesentlicher Pfeiler für die systematische Erfassung umfassender Ergebnisse bildeten verschiedene
                    Qualifikationsarbeiten im Studiengang <a
                        href="https://www.fh-potsdam.de/studium-weiterbildung/studiengaenge/konservierung-und-restaurierung-ba">Konservierung
                        und Restaurierung der FH Potsdam</a>. So wurden materialübergreifend auch verruste oder mit
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
            für
            typische
            Verschmutzungsbilder unterschiedlicher Materialien sowohl die Oberflächen- und Schadensbeschreibung als auch die
            jeweils optimalen Laser und deren Einstellparameter zusammenfasst.</p>
        <p>Der Katalog wurde als fortschreibbare Datenbank konzipiert. Sie ist mit dem Ziel angelegt, eine kontinuierliche
            Erweiterung durch weitere Fachanwender*innen zu ermöglichen.</p>
        <p>Erstellt wurde die Datenbank von Studierenden im <a href="#">Fachbereich Informationswissenschaften der
                Fachhochschule Potsdam</a> im Rahmen eines Semesterprojekts in enger Zusammenarbeit mit betreuenden
            Restauratorinnen.</p>

        <h2>Projektleitung und Kooperationspartner</h2>
        <dl class="row">
            <dt class="col-sm-4">Kulturstiftung Sachsen-Anhalt</dt>
            <dd class="col-sm-8">Bauabteilung Zuständigkeitsbereich Halberstadt Dom, Frau Weigelt Röseler<br>
                Am Schloss 4, 39279 Leitzkau</dd>
            <dt class="col-sm-4">Landesamt für Denkmalpflege und Archäologie Sachsen-Anhalt</dt>
            <dd class="col-sm-8">Abteilung Bau- und Kunstdenkmalpflege<br>
                Referat Denkmaluntersuchung, Dipl. Restaurator Karsten Böhm<br>
                Richard-Wagner-Str. 9, 06114 Halle (Saale)</dd>
            <dt class="col-sm-4">Dipl. Rest. Dr. Corinna Grimm-Remus</dt>
            <dd class="col-sm-8">Am Schäferbrunnen 12, 39128 Magdeburg</dd>
            <dt class="col-sm-4">Institut für Diagnostik und Konservierung an Denkmalen in Sachsen und Sachsen-Anhalt e. V.
            </dt>
            <dd class="col-sm-8">Domplatz 3, 06108 Halle</dd>
            <dt class="col-sm-4">Ulrich Bauer Bornemann</dt>
            <dd class="col-sm-8">Oberer Stephansberg 37, 96049 Bamberg</dd>
            <dt class="col-sm-4">Fachbeirat</dt>
            <dd class="col-sm-8">Prof. Dr. Jeannine Meinhardt<br>Fachhochschule Potsdam<br>Kiepenheuerallee 5, 14469 Potsdam
            </dd>
        </dl>
    </div>
@endsection
