<div itemscope itemtype="https://schema.org/{{ $contact['type'] }}" class="contact">
    <h5 itemprop="name">{!! $name() !!}</h5>
    <dl class="row">
        <dt class="col-sm-2">Postanschrift</dt>
        <dd class="col-sm-10" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            <span itemprop="streetAddress">{{ $contact['street'] }}</span><br>
            <span itemprop="postalCode">{{ $contact['postal_code'] }}</span>
            <span itemprop="addressLocality">{{ $contact['city'] }}</span>
        </dd>
        <dt class="col-sm-2">Website</dt>
        <dd class="col-sm-10">
            <a itemprop="url" href="{{ $contact['website'] }}">{{ $contact['website'] }}</a>
        </dd>
        <dt class="col-sm-2">E-Mail</dt>
        <dd class="col-sm-10">
            <a itemprop="email" href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
        </dd>
        <dt class="col-sm-2">Telefon</dt>
        <dd class="col-sm-10">
            <a href="tel:{{ $contact['phone'] }}"><span itemprop="telephone">{{ $contact['phone'] }}</span></a>
        </dd>
        <dt class="col-sm-2">Fax</dt>
        <dd class="col-sm-10" itemprop="faxNumber">{{ $contact['fax'] }}</dd>
    </dl>
</div>
