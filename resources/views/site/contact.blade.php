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
        <hr>
        <details class="flow">
            <summary class="h2">Demo und Dokumentation Contact View Component</summary>
            <p>In Ermangelung eines besseren Ortes für die Dokumentation der <code>x-contact</code>-Komponente mit
                Live-Beispielen, wird diese hier dokumentiert.</p>
            <p>Die Komponente ermöglicht es, Kontaktdaten in verschiedenen <a
                    href="https://schema.org/docs/gs.html">Schema.org-kompatiblen Formaten</a> darzustellen. Neben der
                einheitlichen Darstellung und Formatierung stellt die Verwendung von zentral verwalteten Kontaktdaten
                sicher, dass diese angezeigten Informationen auf allen Seiten stets aktuell und identisch sind.</p>

            <h2><code>x-contact</code></h2>
            <p>Rendert einen Kontakt in der Standard-Darstellung.</p>
            <x-contact :contact="$demoOrganization" />
            <x-contact :contact="$demoPerson" class="my-5" />

            <h3 id="attribute">Attribute</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Attribut</th>
                        <th>Beschreibung</th>
                        <th>Standard</th>
                        <th>Optionen</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>contact</code></td>
                        <td>Die <code>id</code> des Kontakt-Datensatzes.</td>
                        <td><code>null</code></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><code>variant</code></td>
                        <td>Die Darstellungsvariante für den Kontakt.<br>Die Änderungen sind rein kosmetisch (CSS).
                            Markup
                            und
                            Informationen bleiben unberührt. </td>
                        <td><code>contact</code></td>
                        <td><code>contact</code><br><code>card</code></td>
                    </tr>
                    <tr>
                        <td><code>name-format</code></td>
                        <td>Das Format für den Namen des Kontakts.</td>
                        <td class="text-nowrap"><code>[n][ (a)]</code></td>
                        <td>Siehe <a href="#namen-formatieren">Namen formatieren</a></td>
                    </tr>
                    <tr>
                        <td><code>heading-level</code></td>
                        <td>Die Überschriftenstufe für das Kontakt-Element.</td>
                        <td><code>h3</code></td>
                        <td><code>h1</code><br><code>h2</code><br><code>h3</code><br><code>h4</code><br><code>h5</code><br><code>h6</code>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h3><code>x-contact variant="card"</code></h3>
            <p>Rendert einen Kontakt mit dem Bootstrap <code>.card</code>-Layout.</p>
            <div class="row g-5">
                <div class="col-md-6">
                    <x-contact variant="card" :contact="$demoOrganization" />
                </div>
                <div class="col-md-6">
                    <x-contact variant="card" :contact="$demoPerson" />
                </div>
            </div>

            <h2><code>x-contact.grid</code></h2>
            <p>Rendert eine Liste von Kontakten in einem responsiven Grid. Alle <a href="#attribute">Attribute</a> von
                <code>x-contact</code> sind
                auch für <code>x-contact.grid</code> verfügbar.
            </p>
            <x-contact.grid variant="card" :contacts="$allContacts" />

            <h2><code>x-contact.link</code></h2>
            <p>Rendert einen Kontakt als einfachen Link (<code>&lt;a&gt;</code>).</p>

            <h3>Attribute</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Attribut</th>
                        <th>Beschreibung</th>
                        <th>Standard</th>
                        <th>Optionen</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>name-format</code></td>
                        <td>Das Format für den Namen des Kontakts.</td>
                        <td><code>[n]</code></td>
                        <td>Siehe <a href="#namen-formatieren">Namen formatieren</a></td>
                    </tr>
                    <tr>
                        <td><code>itemprop</code></td>
                        <td>Die verwendete Eigenschaft des Kontakts als Link-Ziel (<code>href</code> und
                            <code>itemprop</code>
                            Attribut).<br>Hat keinen Einfluss auf den angezeigten Text.
                        </td>
                        <td><code>url</code></td>
                        <td><code>url</code><br><code>email</code><br><code>telephone</code></td>
                    </tr>
                </tbody>
            </table>

            <h3>Slots</h3>
            <p>Die Komponente unterstützt einen <code>slot</code>, der den Inhalt des Links ersetzt.</p>

            <h3>Beispiele</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Markup</th>
                        <th>Ausgabe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>&lt;x-contact.link :contact=&quot;$demo&quot; /&gt;</code></td>
                        <td><x-contact.link :contact="$demoOrganization" /></td>
                    </tr>
                    <tr>
                        <td><code>&lt;x-contact.link :contact=&quot;$demo&quot; itemprop=&quot;email&quot; /&gt;</code>
                        </td>
                        <td><x-contact.link :contact="$demoOrganization" itemprop="email" /></td>
                    </tr>
                    <tr>
                        <td><code>&lt;x-contact.link :contact=&quot;$demo&quot;&gt;&lt;span&gt;Custom content&lt;/span&gt;&lt;/x-contact.link&gt;</code>
                        </td>
                        <td><x-contact.link :contact="$demoOrganization"><span>Custom content</span></x-contact.link>
                        </td>
                    </tr>
                    <tr>
                        <td><code>&lt;x-contact.link :contact=&quot;$demo&quot;&gt;Link zur &lt;span itemprop=&quot;alternateName&quot;&gt;&#123;&#123; $demo-&gt;alternateName &#125;&#125;&lt;/span&gt;&lt;/x-contact.link&gt;</code>
                        </td>
                        <td><x-contact.link :contact="$demoOrganization">Link zur <span
                                    itemprop="alternateName">{{ $demoOrganization->alternateName }}</span></x-contact.link>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h2 id="namen-formatieren">Namen formatieren</h2>
            <p>Das Ausgabeformat für Namen kann in allen Komponenten mit dem Attribut <code>name-format</code>
                individualisiert
                werden. Einzelne Bestandteile werden jeweils von <code>[</code> und <code>]</code> umschlossen und
                können
                weitere, optionale Formatierungen wie etwa Klammern beinhalten. Im Datensatz nicht vorhandene Elmente
                werden
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
        </details>
    </div>
@endsection
