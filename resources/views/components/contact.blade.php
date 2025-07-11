<div class="contact">
    <span class="fw-bold">{!! $name() !!}</span><br>
    {{ $contact['street'] }}<br>
    {{ $contact['postal_code'] }} {{ $contact['city'] }}<br>
    <br>
    <span class="fw-bold">Telefon:</span><a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a><br>
    <span class="fw-bold">Fax: </span>{{ $contact['fax'] }}<br>
    <span class="fw-bold">E-Mail: </span><a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a><br>
</div>
