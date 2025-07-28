<ul class="list-unstyled row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-5 card-list" role="list">
    @foreach($contacts as $contact)
        <li class="col">
            <x-contact.card :contact="$contact" :name-format="$nameFormat" :heading-level="$headingLevel" />
        </li>
    @endforeach
</ul>
