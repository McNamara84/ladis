<?php

return [
    'test' => 'Ich liebe Programmieren.',

    /**
     * --- views/layouts/app.blade.php ---
     */

    // Footer
    '000' => 'Datenbank zu Reinigungslasern in der Restaurierung<br>Fachhochschule Potsdam - Studentisches Projekt<br>
        <a href=":link00">Datenschutzerklärung</a>',
    '001' => 'Vorname Nachname, Vorname Nachname, …<br>Vorname Nachname, Vorname Nachname, …',

    /**
     * --- views/welcome.blade.php ---
     */

    // LADIS
    'a00' => 'ist ein Informationssystem zur Dokumentation von Laserreinigungsverfahren bei der Restaurierung historischer Oberflächen.',
    'a01' => 'Das System wurde 2025 vom <a href=":link01">Fachbereich STADT | BAU | KULTUR</a> in Kooperation mit dem 
        <a href=":link02">Fachbereich Informationswissenschaften</a> der <a href=":link03">Fachhochschule Potsdam (FHP)</a> entwickelt.',
    
    // Erfasste Daten
    'a02' => 'Das System dokumentiert umfassende Informationen zu Laserreinigungsverfahren für wissenschaftliche Forschung und Restaurierungspraxis.',

    // Technische Parameter
    'a03' => 'Detaillierte Aufzeichnung der verwendeten Lasergeräte, Optiken und Einstellungen.',
    'a04' => 'Erfassung von Artefakten und deren Materialien, Schadensmuster und Erhaltungszustand vor und nach der Laserreinigung. 
        Projektdaten, Standortdaten und beteiligte Personen und Institutionen ergänzen die Dokumentation.',
    
    // Funktionen
    'a05' => 'Das System bietet umfassende Recherche- und Analysefunktionen.',
    'a06' => 'Die einfache Suche ermöglicht die schnelle Recherche mit Schlagworten.',
    'a07' => 'Die erweiterte Suche bietet umfassende Filter- und Sortierfunktionen für detaillierte Recherchen.',

    /**
     * --- views/layouts/user_management.blade.php ---
     */

    'b00' => 'Soll der Account <strong>{{ :userName }}</strong> wirklich gelöscht werden?',

    /**
     * --- views/layouts/home.blade.php ---
     */

    // Welcome Header
    'c00' => 'Willkommen zurück, {{ :userName }}!',
    'c01' => 'Verwalten Sie Ihre Reinigungslaser-Datenbank und Restaurierungsprojekte.',
    
    // Quick Actions
    'c02' => 'Starten Sie mit der Erfassung von Reinigungslasern',
    
    // Getting Started
    'c03' => 'Willkommen im {{ :appName }}!',
    'c04' => 'Beginnen Sie mit der Erfassung und Verwaltung von Reinigungslasern für Restaurierungsprojekte. 
        Achtung: Das System befindet sich noch in der Entwicklung.'

];
