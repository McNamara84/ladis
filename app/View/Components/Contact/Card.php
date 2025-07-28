<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use App\View\Components\Contact\Contact;
use App\Services\Contacts\Models\Contact as ContactModel;

class Card extends Contact
{
    /**
     * Create a new component instance.
     *
     * @param ContactModel $contact The contact to render
     * @param string $nameFormat Optional. The format of the name
     * @param string $headingLevel Optional. The heading level for the contact name
     */
    public function __construct(
        public ContactModel $contact,
        public string $nameFormat = ContactModel::DEFAULT_NAME_FORMAT,
        public string $headingLevel = parent::DEFAULT_HEADING_LEVEL,
    ) {
        parent::__construct(
            contact: $contact,
            nameFormat: $nameFormat,
            headingLevel: $headingLevel,
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.contact.card');
    }

}
