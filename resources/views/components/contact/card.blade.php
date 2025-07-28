<article itemscope itemtype="https://schema.org/{{ $contact->{'@type'} }}" {{ $attributes->class(['card', 'contact']) }}>
    <header class="card-header">
        <{{ $headingLevel }} itemprop="name">{!! $contact->formatName($nameFormat) !!}</{{ $headingLevel }}>
        @if(isset($contact->{'affiliation.roleName'}))
            <div itemprop="affiliation" itemscope itemtype="https://schema.org/OrganizationRole">
                <span itemprop="roleName">{{ $contact->{'affiliation.roleName'} }}</span>
            </div>
        @endif
    </header>
    @if($contact->hasDetails())
        <div class="card-body dl-container">
            <dl>
                @if(isset($contact->address))
                    <dt>Postanschrift</dt>
                    <dd itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                        @if(isset($contact->{'address.extendedAddress'}))
                            <span itemprop="extendedAddress">{{ $contact->{'address.extendedAddress'} }}</span><br>
                        @endif
                        <span itemprop="streetAddress">{{ $contact->{'address.streetAddress'} }}</span><br>
                        <span itemprop="postalCode">{{ $contact->{'address.postalCode'} }}</span>
                        <span itemprop="addressLocality">{{ $contact->{'address.addressLocality'} }}</span>
                    </dd>
                @endif
                @if(isset($contact->url))
                    <dt>Website</dt>
                    <dd>
                        <a itemprop="url" href="{{ $contact->url }}">{{ $contact->url }}</a>
                    </dd>
                @endif
                @if(isset($contact->email))
                    <dt>E-Mail</dt>
                    <dd>
                        <a itemprop="email" href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </dd>
                @endif
                @if(isset($contact->telephone))
                    <dt>Telefon</dt>
                    <dd>
                        <a href="tel:{{ $contact->telephone }}"><span itemprop="telephone">{{ $contact->telephone }}</span></a>
                    </dd>
                @endif
                @if(isset($contact->faxNumber))
                    <dt>Fax</dt>
                    <dd itemprop="faxNumber">{{ $contact->faxNumber }}</dd>
                @endif
            </dl>
        </div>
    @endif
</article>
