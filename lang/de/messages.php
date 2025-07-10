<?php

return [
    'test' => 'Ich liebe Programmieren.',

    /**
     * --- views/layouts/app.blade.php ---
     */

    // Footer
    '000' => '{{ :appName }} auf {{ :appRepo }}',
    '001' => '{{ :appName }} auf Mastodon',
    '002' => '{{ :appName }} RSS Feed',
    '003' => '{{ :appName }} wird unter der <a href="{{ :appLicenseURL }}">{{ :appLicenseName }}</a> bereitgestellt.',

    /**
     * --- views/welcome.blade.php ---
     */

    // LADIS
    'a00' => 'ist ein Informationssystem zur Dokumentation von Laserreinigungsverfahren bei der Restaurierung historischer Materialien.',
    'a01' => 'Das System wurde 2025 vom <a href=":link01">Fachbereich STADT | BAU | KULTUR</a> in Kooperation mit dem 
        <a href=":link02">Fachbereich Informationswissenschaften</a> der <a href=":link03">Fachhochschule Potsdam (FHP)</a> entwickelt.',
    
    // Erfasste Daten
    'a02' => 'Das Informationssystem speichert umfassende Datensätze aus Laserreinigungsverfahren für die wissenschaftliche Forschung und Restaurierungspraxis.',

    // Technische Parameter
    'a03' => 'Detaillierte Aufzeichnung der verwendeten Lasergeräte, Optiken und ihre Einstellungen.',
    'a04' => 'Erfassung von Artefakten und deren Materialien, Schadensmuster und Erhaltungszustand vor und nach der Laserreinigung. 
        Projektdaten, Standortdaten und beteiligte Personen und Institutionen ergänzen die Dokumentation.',
    
    // Funktionen
    'a05' => 'Das System bietet umfassende Recherche- und Analysefunktionen.',
    'a06' => 'Die einfache Suche ermöglicht die schnelle Recherche mit einzelnen oder mehreren Schlagwörtern.',
    'a07' => 'Die erweiterte Suche bietet umfassende Filter- und Sortierfunktionen für detaillierte Recherchen.',

    /**
     * --- views/layouts/user_management.blade.php ---
     */

    'b00' => 'Möchten Sie den Account <strong>{{ :userName }}</strong> wirklich löschen?',

    /**
     * --- views/home.blade.php ---
     */

    // Welcome Header
    'c00' => 'Willkommen zurück, {{ :userName }}!',
    'c01' => 'Verwalten Sie Ihre Reinigungslaser-Datenbank und Ihre Restaurierungsprojekte.',
    
    // Quick Actions
    'c02' => 'Starten Sie mit der Erfassung von Reinigungslasergeräten.',
    
    // Getting Started
    'c03' => 'Willkommen im {{ :appName }}!',
    'c04' => 'Beginnen Sie mit der Erfassung und Verwaltung von Reinigungslasern für Restaurierungsprojekte. 
        Achtung: Das System befindet sich noch in der Entwicklung!',

    /**
     * --- views/inputform_device.blade.php ---
     */

    'd00' => 'Modellbezeichnung des Lasergeräts, z.B. „CL50“',
    'd01' => 'Baujahr des Lasergeräts, vierstellig',
    'd02' => 'Maße des Lasergeräts (in mm), keine Nachkommastellen',
    'd03' => 'Gewicht des Lasergeräts (in kg), zwei Nachkommastellen',
    'd04' => 'Faserlänge des Lasergeräts (in Meter), zwei Nachkommastellen',
    'd05' => 'maximale und mittlere Energieleistung des Lasergeräts (in Watt)',
    'd06' => 'maximaler Stromverbrauch des Lasergeräts (in Watt)',
    'd07' => 'Modellbezeichnung des Bearbeitungskopfs, z.B. „Optik OS A20“',
    'd08' => 'Beschreibung des Strahlprofils, z.B. „Top-Hat“ oder „Gauß“',
    'd09' => 'Wellenlänge des Lasergeräts (in nm), keine Nachkommastellen',
    'd10' => 'optionale Beschreibung wichtiger Lasergerätmerkmale',

    /**
     * --- views/inputform_material.blade.php ---
     */

    'e00' => 'Ohne Auswahl eines Grundmaterials wird neu registriertes Material ebenfalls als Grundmaterial angelegt.',

    /**
     * --- views/inputform_project.blade.php ---
     */

    'f00' => 'Bitte eindeutigen Titel des Projekts angeben.',
    'f01' => 'Bitte kurze Beschreibung des Projekts hinzufügen.',
    'f02' => 'Bitte eindeutige URL-Adresse des Projekts angeben.',
    'f03' => 'Bitte Startdatum des Projektes angeben.',
    'f04' => 'Bitte Enddatum des Projekts angeben.',

    /**
     * --- views/auth/passwords/confirm.blade.php ---
     */

    'g00' => 'Vor dem Fortfahren bitte Passwort bestätigen.',

    /**
     * --- views/auth/login.blade.php ---
     */

    'h00' => 'Melden Sie sich in Ihrem {{ :appName }}-Konto an.',

    /**
     * --- views/auth/register.blade.php ---
     */

    'i00' => 'Erstellen Sie Ihr {{ :appName }}-Konto.',
    'i01' => 'Mit der Registrierung stimmen Sie der Nutzung Ihrer Kontodaten im Rahmen des studentischen Projekts an der FH Potsdam zu.',

    /**
     * --- views/auth/verify.blade.php ---
     */

    'j00' => 'Ein neuer Bestätigungslink wurde an Ihre E-Mail-Adresse versandt.',
    'j01' => 'Überprüfen Sie Ihre E-Mail vor dem Fortfahren auf einen Bestätigungslink.',
    'j02' => 'Sollten Sie keine E-Mail erhalten haben',
    'j03' => 'klicken Sie hier, um eine erneut anzufragen',

    /**
     * --- views/inputform_institution.blade.php ---
     */

    'k00' => 'Bitte formalen Namen der Institution angeben.',
    'k01' => 'Bitte passenden Institutionstyp auswählen.',
    'k02' => 'Bitte Kontaktinformation angeben, z.B. einen Webseitenlink.',

    /**
     * --- views/institutions/index.blade.php ---
     */

    'l00' => 'Soll die Institution <strong>{{ :institutionName }}</strong> wirklich gelöscht werden?',

    /**
     * --- views/devices/index.blade.php ---
     */

    'm00' => 'Soll das Gerät <strong>{{ :deviceName }}</strong> wirklich gelöscht werden?',

    /**
     * --- views/inputform_artifact.blade.php ---
     */

    'n00' => 'Pflichtfelder sind mit einem <span class="text-danger">*</span>-Asterisk gekennzeichnet.',

    /**
     * --- views/site/about.blade.php ---
     */

    'o00' => 'Lasertechnik-Optimierung zur Reinigung und Desinfektion von historischen Oberflächen (AZ 35765/01)',
    'o01' => 'Ein Forschungsprojekt der Kulturstiftung Sachsen-Anhalt',
    'o02' => 'Die Laserreinigung hat in den vergangenen Jahren einen immer höheren Stellenwert in der Restaurierung historischer
                Oberflächen eingenommen. Um diese Technologie einem noch größeren Kreis anwendender Restaurator*innen zugänglich
                zu machen, bedarf es eines systematischen Erfahrungstransfers, den das hier durch die <a href=":link0">Deutsche 
                Bundesstiftung Umwelt (DBU)</a> unterstützte Projekt der <a href=":link1">Kulturstiftung Sachsen-Anhalt</a> befördern soll.',
    'o03' => 'So wurden aktuell in der Denkmalpflege für verschiedene Reinigungsaufgaben <x-link route="devices.all" 
                text="eingesetzte Lasergeräte" /> anhand von unterschiedlichen Musterflächen vergleichend getestet. Welches Gerät 
                ist für welchen Zweck geeignet und was sind erfolgversprechende Einstellparamater? Im Mittepunkt der Betrachtungen 
                stand der <x-link text="Halberstädter Dom" /> mit seinen stark verkrusteten Kalksteinoberflächen. Aber auch Sandsteine 
                an den <x-link  text="Domen in Magdeburg und Halle" /> sowie Alabasteruntergründe wurden systematisch untersucht.',
    'o04' => 'Ein wesentlicher Pfeiler für die systematische Erfassung umfassender Ergebnisse bildeten verschiedene Qualifikationsarbeiten 
                im Studiengang <a  href=":link"> Konservierung und Restaurierung der FH Potsdam</a>. So wurden materialübergreifend auch 
                verkruste oder mit Graffiti verschmutzte Holzoberflächen zum Gegenstand des Forschungsprojektes. Die für viele Anwender*innen 
                interessanten Ergebnisse sind in vorbildlicher Weise in eine Datenbank im Sinne eines „Offenen Anwendungskataloges“ eingeflossen.',
    'o05' => 'Ein erklärtes Ziel des Projekts ist ein detaillierter <x-link text="Anwendungs- und Einstellungskatalog" />, der
                für typische Verschmutzungsbilder bei unterschiedlichen Materialien sowohl die Oberflächen- und Schadensbeschreibung
                als auch die jeweils optimalen Einstellparameter für unterschiedliche Lasergeräte zusammenfasst.',
    'o06' => 'Der Katalog wurde als fortschreibbare Datenbank konzipiert. Sie ist mit dem Ziel angelegt, eine kontinuierliche
                Erweiterung durch weitere Fachanwender*innen zu ermöglichen.',
    'o07' => 'Erstellt wurde die Datenbank von Studierenden im <a href=":link">Fachbereich Informationswissenschaften der Fachhochschule 
                Potsdam</a> im Rahmen eines Semesterprojekts in enger Zusammenarbeit mit betreuenden Restauratorinnen.',
    'o08' => 'Kulturstiftung Sachsen-Anhalt',
    'o09' => 'Bauabteilung Zuständigkeitsbereich „Halberstadt Dom“, Frau Weigelt Röseler<br>Am Schloss 4, 39279 Leitzkau',
    'o10' => 'Landesamt für Denkmalpflege und Archäologie Sachsen-Anhalt',
    'o11' => 'Abteilung Bau- und Kunstdenkmalpflege<br>Referat Denkmaluntersuchung, Dipl. Restaurator Karsten Böhm<br>
                Richard-Wagner-Str. 9, 06114 Halle (Saale)',
    'o12' => 'Dipl. Rest. Dr. Corinna Grimm-Remus',
    'o13' => 'Am Schäferbrunnen 12, 39128 Magdeburg',
    'o14' => 'Institut für Diagnostik und Konservierung an Denkmalen in Sachsen und Sachsen-Anhalt e. V.',
    'o15' => 'Domplatz 3, 06108 Halle',
    'o16' => 'Ulrich Bauer Bornemann',
    'o17' => 'Oberer Stephansberg 37, 96049 Bamberg',
    'o18' => 'Fachbeirat',
    'o19' => 'Prof. Dr. Jeannine Meinhardt<br>Fachhochschule Potsdam<br>Kiepenheuerallee 5, 14469 Potsdam',

];
