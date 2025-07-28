<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use App\View\Components\Contact\Contact;
use App\Services\Contacts\Models\Contact as ContactModel;

/**
 * Contact Link component
 *
 * Renders a link to a contact.
 *
 * @since 0.2.0
 */
class Link extends Contact
{
    /**
     * The default name format for the link
     *
     * @var string
     */
    public const DEFAULT_NAME_FORMAT = '[n]';

    /**
     * Create a new component instance.
     *
     * @todo: Refeactor so that we don't violate the Liskov Substitution Principle
     *        by hiding the heading level (`$headingLevel`) :).
     *
     * @param ContactModel $contact The contact information
     * @param string $nameFormat Optional. The format of the name
     */
    public function __construct(
        public ContactModel $contact,
        public string $nameFormat = self::DEFAULT_NAME_FORMAT,
    ) {
        parent::__construct(
            contact: $contact,
            nameFormat: $nameFormat,
            headingLevel: parent::DEFAULT_HEADING_LEVEL,
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.contact.link');
    }

}
