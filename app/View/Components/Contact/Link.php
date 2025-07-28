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

    public $href = null;

    /**
     * Create a new component instance.
     *
     * @todo: Don't violate the Liskov Substitution Principle by hiding constructor parameters.
     *
     * @param ContactModel $contact The contact information
     * @param string $nameFormat Optional. The format of the name
     * @param string $itemprop Optional. The itemprop attribute for the link. Defaults to 'url'.
     */
    public function __construct(
        public ContactModel $contact,
        public string $nameFormat = self::DEFAULT_NAME_FORMAT,
        public string $itemprop = 'url',
    ) {
        parent::__construct(
            contact: $contact,
            nameFormat: $nameFormat,
        );

        $this->href = $contact->{$itemprop};
        if ($this->itemprop === 'email') {
            $this->href = "mailto:{$this->href}";
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.contact.link');
    }

}
