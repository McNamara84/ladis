<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\View\Components\Contact\Contact;
use App\Services\Contacts\Models\Contact as ContactModel;

/**
 * Contact Card List component
 *
 * Renders a list of contact cards.
 *
 * @since 0.2.0
 */
class CardList extends Component
{

    /**
     * Create a new component instance.
     *
     * @param array<string, ContactModel> $contacts The contacts to render
     * @param string $nameFormat Optional. The format of the name
     * @param string $headingLevel Optional. The heading level for the contact name
     */
    public function __construct(
        public array $contacts,
        public string $nameFormat = ContactModel::DEFAULT_NAME_FORMAT,
        public string $headingLevel = Contact::DEFAULT_HEADING_LEVEL,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact.card-list');
    }

}
