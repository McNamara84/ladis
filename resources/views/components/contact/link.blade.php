<span itemscope itemtype="https://schema.org/{{ $contact->{'@type'} }}">
    <a itemprop="{{ $itemprop }}" href="{{ $href }}">
        @if ($slot->isEmpty())
            <span itemprop="name">{!! $contact->formatName($nameFormat) !!}</span>
        @else
            {{ $slot }}
        @endif
    </a>
</span>
