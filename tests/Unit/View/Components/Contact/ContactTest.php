<?php

namespace Tests\Unit\View\Components\Contact;

use Tests\TestCase;
use App\View\Components\Contact\Contact;
use App\Services\Contacts\Models\Contact as ContactModel;

class ContactTest extends TestCase
{
    private function getSampleContact(array $extras = []): ContactModel
    {
        $data = [
            '@type' => 'Person',
            'name' => 'Alice Liddell',
            'alternateName' => 'Alice',
        ];

        return new ContactModel(json_encode(array_merge($data, $extras)));
    }

    public function test_component_renders_correctly(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->component(Contact::class, [
            'contact' => $contact,
        ]);

        $view->assertSeeInOrder([
            '<article itemscope itemtype="https://schema.org/Person" class="contact"',
            '<header class="contact-header">',
            '<h3 itemprop="name">Alice Liddell (Alice)</h3>',
        ]);

        $view->assertDontSee('itemprop="affiliation"', false);
        $view->assertDontSee('itemprop="roleName"', false);
        $view->assertDontSee('class="contact-body dl-container"', false);
        $view->assertDontSee('itemprop="address"', false);
        $view->assertDontSee('itemprop="extendedAddress"', false);
        $view->assertDontSee('itemprop="streetAddress"', false);
        $view->assertDontSee('itemprop="postalCode"', false);
        $view->assertDontSee('itemprop="addressLocality"', false);
        $view->assertDontSee('itemprop="url"', false);
        $view->assertDontSee('itemprop="email"', false);
        $view->assertDontSee('itemprop="telephone"', false);
        $view->assertDontSee('itemprop="faxNumber"', false);
    }

    public function test_component_renders_extras_correctly(): void
    {
        $extras = [
            'affiliation' => [
                '@type' => 'OrganizationRole',
                'roleName' => 'Protagonist',
            ],
            'email' => 'alice@wonderland',
            'telephone' => '1234567890',
            'faxNumber' => '1234567890',
            'url' => 'https://alice.wonderland',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Cheshire Cat Crossroads',
                'addressLocality' => 'Wonderland',
                'postalCode' => '12345',
                'addressCountry' => 'Wonderland',
                'extendedAddress' => 'c/o Cheshire Cat',
            ]
        ];

        $contact = $this->getSampleContact($extras);

        $view = $this->component(Contact::class, [
            'contact' => $contact,
        ]);

        $view->assertSeeInOrder([
            '<div itemprop="affiliation" itemscope itemtype="https://schema.org/OrganizationRole">',
            '<span itemprop="roleName">Protagonist</span>',
            '<div class="contact-body dl-container">',
            '<dd itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">',
            '<span itemprop="extendedAddress">c/o Cheshire Cat</span>',
            '<span itemprop="streetAddress">Cheshire Cat Crossroads</span>',
            '<span itemprop="postalCode">12345</span>',
            '<span itemprop="addressLocality">Wonderland</span>',
            '<a itemprop="url" href="https://alice.wonderland">https://alice.wonderland</a>',
            '<a itemprop="email" href="mailto:alice@wonderland">alice@wonderland</a>',
            '<a href="tel:1234567890"><span itemprop="telephone">1234567890</span></a>',
            '<dd itemprop="faxNumber">1234567890</dd>',
        ]);
    }

    public function test_component_renders_with_heading_level(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->component(Contact::class, [
            'contact' => $contact,
            'headingLevel' => 'h2',
        ], );

        $view->assertSeeInOrder([
            '<h2 itemprop="name">Alice Liddell (Alice)</h2>',
        ]);

        $view->assertDontSee('<h3 itemprop="name">Alice Liddell (Alice)</h3>', false);
    }

    public function test_component_renders_with_custom_attributes(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->blade(
            '<x-contact.contact :contact="$contact" class="test-class" id="test-id" />',
            ['contact' => $contact]
        );

        $view->assertSee('<article itemscope itemtype="https://schema.org/Person" class="contact test-class" id="test-id">', false);
    }

    public function test_component_renders_with_name_format(): void
    {
        $contact = $this->getSampleContact();

        $view = $this->component(Contact::class, [
            'contact' => $contact,
            'nameFormat' => '[a]',
        ]);

        $view->assertSee('<h3 itemprop="name">Alice</h3>', false);
    }

    public function test_component_renders_with_variant(): void
    {
        $contact = $this->getSampleContact(['telephone' => '1234567890']);

        $view = $this->component(Contact::class, [
            'contact' => $contact,
            'variant' => 'card',
        ]);

        $view->assertSeeInOrder([
            '<article itemscope itemtype="https://schema.org/Person" class="contact card">',
            '<header class="card-header">',
            '<div class="card-body dl-container">',
        ]);
    }
}
