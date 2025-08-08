@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-warning" role="alert">
            ENTWURF (bitte nicht verklagen, danke!)
        </div>
        <h1>{{ $pageTitle }}</h1>
        <p>Diese Impressum wurde zuletzt am <time datetime="{{ $lastUpdated }}">{{ $lastUpdatedFormatted }}</time>
            bearbeitet.</p>
        <h2>Zuständige Institutionen</h2>
        <h3>Fachhochschule Potsdam</h3>
        <p>Die Fachhochschule Potsdam ist eine Körperschaft des Öffentlichen Rechts. Sie wird durch die amtierende
            Präsidentin / den amtierenden Präsidenten vertreten. Inhaltlich verantwortlich für die Inhalte dieses
            Webauftritts ist der Studiengang „Konservierung und Restaurierung“ der Fachhochschule Potsdam.</p>
        <x-contact variant="card" :contact="$appContactPrimary()" class="my-5 mis" />
        <h2>Zuständige Aufsichtsbehörde</h2>
        <x-contact variant="card" :contact="$supervisoryAuthority" class="my-5 mis" />
        <h2>Finanzierung</h2>
        <p>Diese Web-Veröffentlichung ist Resultat einer Masterarbeit von Lale Baudissin und einem Projekt von Frau
            Grimm-Remus sowie des Labs „PD11 Konzipierung und Entwicklung eines Informationssystems“ der Fachhochschule
            Potsdam.</p>
        <p>Die Laserfachdatenbank wurde im Rahmen des DBU-Projekts AZ 35765/01 „Optimierung der Einsatzmöglichkeit von
            Lasertechnik zur Reinigung von historischen Oberflächen von Ablagerungen sowie von mikrobiologisch aktiven
            Besiedlungen am Halberstädter Dom“ (2019-2021) durch die Deutsche Bundesstiftung Umwelt (DBU) realisiert,
            vielen Dank!</p>
        <h2>Realisierung/ Inhaltliche Umsetzung/ Gestaltung/ Technische Umsetzung</h2>
        <p>Durch die Teilnehmer der Lab-Seminargruppe „Konzipierung und Entwicklung eines Informationssystems“: </p>
        <ul>
            <li>Nicolai Bach</li>
            <li>Michael Graf</li>
            <li>Helin Kisa</li>
            <li>Carolin Möckel</li>
            <li>Arthur Neufeld</li>
            <li>Maria Schendel</li>
            <li>Paula Wiedmann</li>
            <li>Maya Lea Wussow</li>
        </ul>
        <p>unter Leitung der Dozierenden aus dem FB5 Informationswissenschaften - Studiengang „Informations- und
            Datenmanagement“:</p>
        <ul>
            <li>Prof. Dr. Rolf Däßler</li>
            <li>Holger Ehrmann</li>
            <li>Prof. Dr. Günther Neher</li>
            <li>Dipl. Phil. Wiss. Dok. Elena Semenova</li>
        </ul>
        <p>und den Auftraggebern aus dem FB2 Architektur und Städtebau - Studiengang „Konservierung und Restaurierung“: </p>
        <ul>
            <li>Lale Baudissin</li>
            <li>Dr. phil. Corinna Grimm-Remus </li>
        </ul>
        <p>wurde diese Web-Veröffentlichung von 2025/04 - 2025/07 erarbeitet.</p>
        <h2>Rechte (Daten)</h2>
        <p>tbc</p>
        <h2>Lizenzen der verwendeten Bilder</h2>
        <p>tbc</p>
        <h2>Haftungsausschluss</h2>
        <p>Eine Haftung für die Richtigkeit, Vollständigkeit und Aktualität dieser Webseiten kann trotz sorgfältiger Prüfung
            nicht übernommen werden. Die Fachhochschule Potsdam übernimmt insbesondere keine Haftung für eventuelle Schäden
            oder Konsequenzen, die durch eine direkte oder indirekte Nutzung der angebotenen Inhalte entstehen. Es wird
            ausdrücklich darauf hingewiesen, dass für den Inhalt verlinkter Seiten ausschließlich deren Betreiber
            verantwortlich ist. Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die Inhalte
            externer Links. Für Schäden, die aus der Nutzung oder Nichtnutzung dieser Informationen entstehen, haftet
            ausschließlich der Betreiber der Seite, auf die verwiesen wurde. Sollten Sie Kenntnis von verlinkten Seiten mit
            rechtswidrigen Inhalten erlangen, bitten wir Sie, uns dies mitzuteilen.</p>
        <h2>Urheberrecht</h2>
        <p>Alle im Internetangebot des Studiengangs Kulturarbeit veröffentlichten Inhalte (Layout, Texte, Bilder, Grafiken
            usw.) unterliegen dem Urheberrecht. Jede vom Urheberrechtsgesetz nicht zugelassene Verwertung bedarf vorheriger
            ausdrücklicher Zustimmung. Dies gilt insbesondere für Vervielfältigung, Bearbeitung, Übersetzung,
            Einspeicherung, Verarbeitung bzw. Wiedergabe von Inhalten in Datenbanken oder anderen elektronischen Medien und
            Systemen. Fotokopien und Downloads von Webseiten für den privaten, wissenschaftlichen und nicht kommerziellen
            Gebrauch dürfen hergestellt werden. Wir erlauben ausdrücklich und begrüßen das Zitieren unserer Dokumente und
            Webseiten sowie das Setzen von Links auf unsere Website.</p>
    </div>
@endsection
