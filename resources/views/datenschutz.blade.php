@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ENTWURF (bitte nicht verklagen, danke!)</h1>>
        <h1>{{ $pageTitle }}</h1>
        <p>Wir verarbeiten personenbezogene Daten, die beim Besuch unserer Webseite erhoben werden, unter Beachtung der geltenden datenschutzrechtlichen Bestimmungen, insbesondere der EU-Datenschutz-Grundverordnung (DSGVO).</p>
        <p>Diese Datenschutzhinweise (Stand: <time datetime="{{ $lastUpdated }}">{{ $lastUpdated }}</time>) gelten für folgende von der FH Potsdam betriebenen Seiten:</p>
        <ul>
            <li><a href="">{{ $URL }}</a></li>
        </ul>
        <h2>1. Verantwortlicher</h2>
        <p>Verantwortliche*r im Sinne der DSGVO und anderer nationaler Datenschutzgesetze der Mitgliedsstaaten sowie sonstiger datenschutzrechtlicher Bestimmungen ist die <strong>Präsidentin Prof. Dr. Eva Schmitt-Rodermund</strong>.</p>
        <h3>Anschrift</h3>
        <address>
            <strong>Fachhochschule Potsdam<br>
            University of Applied Sciences</strong><br>
            Fachbereich 5 – Informationswissenschaften<br>
            Kiepenheuerallee 5<br>
            14469 Potsdam<br>
        </address>
        <h2>2. Zweck und Rechtsgrundlagen</h2>
        <p>Die personenbezogenen Daten (insbesondere E-Mail-Adresse und Benutzername) dienen zur Verifikation von Datensätzen, um nachvollziehen zu können, wer Inhalte erstellt hat und wer als Kontaktperson fungiert. Soweit Sie dieses Angebot nutzen, geschieht das auf freiwilliger Basis. Die entsprechende Rechtsgrundlage bildet Art. 6 Abs. 1 S. 1 lit. a DSGVO.</p>
        <h2>3. Erläuterung der Datenverarbeitung</h2>
        <h3>Protokollierung</h3>
        <p>Bei jedem Zugriff auf unsere Webseite werden durch den auf dem Server der Fachhochschule Potsdam betriebenen Webserver zum Zwecke der Betriebs- und Datensicherheit sowie zu statistischen Zwecken folgende Daten in Protokolldateien gespeichert:</p>
        <ul>
            <li>Browsertyp und -version</li>
            <li>Rechnername oder IP-Adresse des zugreifenden Rechners</li>
            <li>Uhrzeit der Anfrage an den Server</li>
            <li>angefragte Webseite</li>
        </ul>
        <p>Diese Daten werden ausschließlich zur Sicherstellung des technischen Betriebs sowie zu statistischen Zwecken ausgewertet und nicht mit anderen Datenquellen zusammengeführt.</p>
        <p>Die vorübergehende Speicherung der IP-Adresse durch das System ist notwendig, um eine Auslieferung der Website an Ihren Rechner zu ermöglichen. Hierfür muss die IP-Adresse Ihres Rechners für die Dauer der Sitzung gespeichert bleiben. Zudem dienen uns die Daten zur Sicherstellung der Sicherheit unserer informationstechnischen Systeme.</p>
        <p>Von den genannten Daten gilt die IP-Adresse als personenbezogen bzw. personenbeziehbar. Ihre IP-Adresse wird nur für einen kurzen Zeitraum gespeichert und dann vollständig anonymisiert (gelöscht oder verfremdet). Danach sind die genannten Daten nicht mehr personenbezogen. Sie werden gelöscht, sobald sie für die Erreichung des Zwecks ihrer Erhebung nicht mehr erforderlich sind.</p>
        <h3>Cookies</h3>
        <p>Zurzeit werden keine Cookies eingesetzt.</p>
        <h3>Kontaktformular</h3>
        <p>Sofern auf unserer Webseite die Möglichkeit zur Eingabe persönlicher oder geschäftlicher Daten wie Namen, E-Mail-Adressen, Anschriften usw. besteht, erfolgt die Preisgabe dieser Daten auf freiwilliger Basis.</p>
        <h3>Löschfristen</h3>
        <p>Die erhobenen personenbezogenen Daten werden gelöscht, sobald der Zweck der Speicherung entfällt oder Sie Ihre Einwilligung widerrufen. Sofern gesetzliche Aufbewahrungspflichten bestehen, werden die Daten für die Dauer dieser Fristen gespeichert und danach gelöscht.</p>
        <h2>4. Ihre Rechte</h2>
        <p>Nach der Datenschutz-Grundverordnung stehen Ihnen zudem folgende Rechte zu: Werden Ihre personenbezogenen Daten verarbeitet, so haben Sie das Recht, Auskunft über die zu Ihrer Person gespeicherten Daten zu erhalten (Art. 15 DSGVO). Sollten unrichtige personenbezogene Daten verarbeitet werden, steht Ihnen ein Recht auf Berichtigung zu (Art. 16 DSGVO). Liegen die gesetzlichen Voraussetzungen vor, so können Sie die Löschung oder Einschränkung der Verarbeitung verlangen sowie Widerspruch gegen die Verarbeitung einlegen (Art. 17, 18 und 21 DSGVO). Wenn Sie in die Datenverarbeitung eingewilligt haben oder ein Vertrag zur Datenverarbeitung besteht und die Datenverarbeitung mithilfe automatisierter Verfahren durchgeführt wird, steht Ihnen gegebenenfalls ein Recht auf Datenübertragbarkeit zu (Art. 20 DSGVO). Sollten Sie von Ihren oben genannten Rechten Gebrauch machen, prüft die Fachhochschule Potsdam, ob die gesetzlichen Voraussetzungen hierfür erfüllt sind. Wenn Sie Fragen zum Webauftritt haben oder Ihre genannten Rechte ausüben wollen, wenden Sie sich gerne an die Stabsstelle Hochschulkommunikation (<a href="mailto:webredaktion@fh-potsdam.de">webredaktion@fh-potsdam.de</a>) oder an den Datenschutzbeauftragten (<a href="mailto:datenschutz@fh-potsdam.de">datenschutz@fh-potsdam.de</a>) der Hochschule. Jede betroffene Person hat das Recht auf Beschwerde bei der Aufsichtsbehörde, wenn sie der Ansicht ist, dass ihre personenbezogenen Daten rechtswidrig verarbeitet werden. Wenn Sie sich an die Landesbeauftragte für den Datenschutz und für das Recht auf Akteneinsicht wenden möchten, können Sie sie wie folgt kontaktieren:</p>
        <h4>Die Landesbeauftragte für den Datenschutz und für das Recht auf Akteneinsicht</h4>
        <address>
            <strong>Dagmar Hartge</strong><br>
            Stahnsdorfer Damm 77<br>
            14532 Kleinmachnow<br>
            <strong>E-mail: </strong><a href="mailto:poststelle@LDA.brandenburg.de">poststelle@LDA.brandenburg.de</a><br>
        </address>
        <p>Weitere Informationen können Sie dem offiziellen Internetauftritt der Landesbeauftragten unter <a href="https://www.lda.brandenburg.de" title="Externer Link: Weitere Informationen können Sie dem offiziellen Internetauftritt der Landesbeauftragten unter www.lda.brandenburg.de (Öffnet neues Fenster)">www.lda.brandenburg.de</a> entnehmen.</p>
        <h2>5. Hosting</h2>
        <p>Die Webseite wird über Server der Fachhochschule Potsdam gehostet. Es besteht ein entsprechender Vertrag zur Auftragsverarbeitung gemäß Art. 28 DSGVO.</p>
        <h2>6. Änderungen dieser Datenschutzerklärung</h2>
        <p>Wir behalten uns vor, diese Datenschutzerklärung zu ändern, um sie an geänderte rechtliche Rahmenbedingungen oder bei Änderungen des Dienstes anzupassen. Die aktuelle Version wurde am <time datetime="{{ $lastUpdated }}">{{ $lastUpdated }}</time> ist stets auf unserer Webseite verfügbar. Bitte informieren Sie sich regelmäßig über die geltenden Datenschutzbestimmungen.</p>
        <h2>Technische Umsetzung</h2>
        <h3>Ansprechpartner*innen</h3>
        <h4>Verantwortliche Stelle ist:</h4>
        <address>
            <strong>Präsidentin<br>
            Prof. Dr. Eva Schmitt-Rodermund</strong><br>
            Fachhochschule Potsdam<br>
            Kiepenheuerallee 5<br>
            14469 Potsdam<br>
            <strong>E-mail: </strong><a href="mailto:praesidentin@fh-potsdam.de">praesidentin@fh-potsdam.de</a><br>
        </address>
        <h4>Sie erreichen unseren behördlichen Datenschutzbeauftragten unter: </h4>
        <address>
            <strong>Sven Hirsch</strong><br>
            Datenschutzbeauftragter<br>
            Fachhochschule Potsdam<br>
            Kiepenheuerallee 5<br>
            14469 Potsdam<br>
            <strong>E-mail: </strong><a href="mailto:datenschutz@fh-potsdam.de">datenschutz@fh-potsdam.de</a><br>
        </address>
        <h4>Technische Umsetzung:</h4>
        <p>Der Web-Server für den Betrieb der Website wird technisch durch die <a href="https://www.fh-potsdam.de/campus-services/it-service">Zentrale IT der FH Potsdam</a> betrieben.</p>
        <p><strong>E-mail: </strong><a href="mailto:it-service@fh-potsdam.de">it-service@fh-potsdam.de</a></p>
        </h3>
    </div>
@endsection
