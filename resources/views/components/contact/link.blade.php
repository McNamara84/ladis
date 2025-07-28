<span itemscope itemtype="https://schema.org/{{ $contact->{'@type'} }}">
    <a itemprop="url" href="{{ $contact->url }}">
        @if ($slot->isEmpty())
            <span itemprop="name">{!! $contact->formatName($nameFormat) !!}</span>
        @else
            {{ $slot }}
        @endif
    </a>
</span>
