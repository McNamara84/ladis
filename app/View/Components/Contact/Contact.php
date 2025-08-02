<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Contacts\Models\Contact as ContactModel;

/**
 * Contact component
 *
 * Renders contact information in a structured way.
 *
 * @since 0.2.0
 */
class Contact extends Component
{

    /**
     * The default heading level for the contact name
     *
     * @var string
     */
    public const DEFAULT_HEADING_LEVEL = 'h3';

    /**
     * The default layout variant for the contact
     *
     * Variants are purely CSS based and do not affect the content or the markup.
     * Available variants:
     * - contact: The default layout
     * - card: Bootstrap card layout
     *
     * @var string
     */
    public const DEFAULT_VARIANT = 'contact';

    /**
     * The contact model instance
     *
     * @var ContactModel
     */
    protected ContactModel $contactModel;

    /**
     * Create a new component instance.
     *
     * @param ContactModel $contact The contact information
     * @param string $nameFormat Optional. The format of the name
     * @param string $headingLevel Optional. The heading level for the contact name
     * @param string $variant Optional. The layout variant for the contact
     */
    public function __construct(
        public ContactModel $contact,
        public string $nameFormat = ContactModel::DEFAULT_NAME_FORMAT,
        public string $headingLevel = self::DEFAULT_HEADING_LEVEL,
        public string $variant = self::DEFAULT_VARIANT,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact.contact');
    }
}
