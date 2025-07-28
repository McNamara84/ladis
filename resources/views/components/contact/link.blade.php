<span itemscope itemtype="https://schema.org/{{ $contact->{'@type'} }}">
    <a itemprop="url" href="{{ $contact->url }}"><span
            itemprop="name">{!! $contact->formatName($nameFormat) !!}</span></a>
</span>
