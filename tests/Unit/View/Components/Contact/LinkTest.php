<?php

namespace Tests\Unit\View\Components\Contact;

use Tests\TestCase;
use App\View\Components\Contact\Link;
use App\Services\Contacts\Models\Contact as ContactModel;

class LinkTest extends TestCase
{
    private function getSampleContact(array $extras = []): ContactModel
    {
        $data = [
            '@type' => 'Person',
            'name' => 'Alice Liddell',
            'alternateName' => 'Alice',
            'url' => 'https://alice.wonderland',
            'email' => 'alice@wonderland',
            'telephone' => '1234567890',
        ];

        return new ContactModel(json_encode(array_merge($data, $extras)));
    }

    public function test_component_renders_correctly_with_defaults(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->blade(
            '<x-contact.link :contact="$contact" />',
            ['contact' => $contact]
        );

        $view->assertSeeInOrder([
            '<span itemscope itemtype="https://schema.org/Person" >',
            '<a itemprop="url" href="https://alice.wonderland">',
            '<span itemprop="name">Alice Liddell</span>',
            '</a>',
            '</span>',
        ]);
    }

    public function test_component_renders_email_link_with_mailto_protocol(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->blade(
            '<x-contact.link :contact="$contact" itemprop="email" />',
            ['contact' => $contact]
        );

        $view->assertSeeInOrder([
            '<span itemscope itemtype="https://schema.org/Person" >',
            '<a itemprop="email" href="mailto:alice@wonderland">',
            '<span itemprop="name">Alice Liddell</span>',
            '</a>',
            '</span>',
        ]);
    }

    public function test_component_renders_telephone_link_with_tel_protocol(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->blade(
            '<x-contact.link :contact="$contact" itemprop="telephone" />',
            ['contact' => $contact]
        );

        $view->assertSeeInOrder([
            '<span itemscope itemtype="https://schema.org/Person" >',
            '<a itemprop="telephone" href="tel:1234567890">',
            '<span itemprop="name">Alice Liddell</span>',
            '</a>',
            '</span>',
        ]);
    }

    public function test_component_renders_with_custom_name_format(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->blade(
            '<x-contact.link :contact="$contact" name-format="[a]" />',
            ['contact' => $contact]
        );

        $view->assertSeeInOrder([
            '<a itemprop="url" href="https://alice.wonderland">',
            '<span itemprop="name">Alice</span>',
        ]);

        $view->assertDontSee('Alice Liddell');
    }

    public function test_component_renders_with_slot_content(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->blade(
            '<x-contact.link :contact="$contact">Custom Link Text</x-contact.link>',
            ['contact' => $contact]
        );

        $view->assertSeeInOrder([
            '<a itemprop="url" href="https://alice.wonderland">',
            'Custom Link Text',
            '</a>',
        ]);

        $view->assertDontSee('<span itemprop="name">');
        $view->assertDontSee('Alice Liddell');
    }

    public function test_component_renders_with_custom_attributes(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->blade(
            '<x-contact.link :contact="$contact" class="test-class" id="test-id" />',
            ['contact' => $contact]
        );

        $view->assertSeeInOrder([
            '<span itemscope itemtype="https://schema.org/Person" class="test-class" id="test-id">',
        ]);
    }

    /**
     * @todo I don't think a broken link is severe enough to let the app crash but
     *       we could log a warning or guard against broken links.
     */
    public function test_component_handles_missing_property_gracefully(): void
    {
        $contact = $this->getSampleContact();

        // Test with an itemprop that doesn't exist on the contact
        $view = $this->blade(
            '<x-contact.link :contact="$contact" itemprop="nonexistentProperty" />',
            ['contact' => $contact]
        );

        // Should render without error, href will be empty or null value
        $view->assertSee('itemprop="nonexistentProperty"', false);
        $view->assertSee('href=""', false);
    }
}
