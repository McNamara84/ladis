<?php

namespace Tests\Unit\View\Components\Contact;

use Tests\TestCase;
use App\View\Components\Contact\Grid;
use App\Services\Contacts\Models\Contact as ContactModel;

class GridTest extends TestCase
{
    private function getSampleContact(string $name = 'Alice Liddell', string $alternateName = 'Alice', array $extras = []): ContactModel
    {
        $data = [
            '@type' => 'Person',
            'name' => $name,
            'alternateName' => $alternateName,
        ];

        return new ContactModel(json_encode(array_merge($data, $extras)));
    }

    public function test_component_renders_grid_structure_correctly(): void
    {
        $contacts = [
            $this->getSampleContact(),
            $this->getSampleContact('Bob Smith', 'Bob'),
        ];

        $view = $this->component(Grid::class, [
            'contacts' => $contacts,
        ]);

        $view->assertSeeInOrder([
            '<ul role="list" class="list-unstyled row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-5 contact-grid">',
            '<li class="col">',
            '<article itemscope itemtype="https://schema.org/Person" class="contact"',
            'Alice Liddell',
            '</li>',
            '<li class="col">',
            '<article itemscope itemtype="https://schema.org/Person" class="contact"',
            'Bob Smith',
            '</li>',
            '</ul>',
        ]);
    }

    public function test_component_renders_empty_grid_when_no_contacts(): void
    {
        $view = $this->component(Grid::class, [
            'contacts' => [],
        ]);

        $view->assertSeeInOrder([
            '<ul role="list" class="list-unstyled row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-5 contact-grid">',
            '</ul>',
        ]);

        $view->assertDontSee('<li class="col">', false);
        $view->assertDontSee('<article', false);
    }

    public function test_component_passes_name_format_to_contacts(): void
    {
        $contacts = [
            $this->getSampleContact(),
        ];

        $view = $this->component(Grid::class, [
            'contacts' => $contacts,
            'nameFormat' => '[a]',
        ]);

        $view->assertSee('<h3 itemprop="name">Alice</h3>', false);
        $view->assertDontSeeText('Alice Liddell');
    }

    public function test_component_passes_heading_level_to_contacts(): void
    {
        $contacts = [
            $this->getSampleContact(),
        ];

        $view = $this->component(Grid::class, [
            'contacts' => $contacts,
            'headingLevel' => 'h2',
        ]);

        $view->assertSee('<h2 itemprop="name">Alice Liddell (Alice)</h2>', false);
        $view->assertDontSee('<h3 itemprop="name">', false);
    }

    public function test_component_passes_variant_to_contacts(): void
    {
        $contacts = [
            $this->getSampleContact(),
        ];

        $view = $this->component(Grid::class, [
            'contacts' => $contacts,
            'variant' => 'card',
        ]);

        $view->assertSeeInOrder([
            '<ul role="list" class="list-unstyled row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-5 card-grid">',
            '<article itemscope itemtype="https://schema.org/Person" class="contact card"',
        ]);
    }

    public function test_component_renders_multiple_contacts_in_correct_order(): void
    {
        $contacts = [
            $this->getSampleContact('Alice'),
            $this->getSampleContact('Bob'),
            $this->getSampleContact('Charlie'),
        ];

        $view = $this->component(Grid::class, [
            'contacts' => $contacts,
        ]);

        $view->assertSeeInOrder([
            'Alice',
            'Bob',
            'Charlie',
        ]);
    }

    public function test_component_applies_default_values_correctly(): void
    {
        $contacts = [
            $this->getSampleContact(),
        ];

        $view = $this->component(Grid::class, [
            'contacts' => $contacts,
        ]);

        $view->assertSeeInOrder([
            '<ul role="list" class="list-unstyled row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-5 contact-grid">',
            '<article itemscope itemtype="https://schema.org/Person" class="contact"',
            '<h3 itemprop="name">Alice Liddell (Alice)</h3>',
        ]);
    }

    public function test_component_applies_attributes_correctly(): void
    {
        $contacts = [
            $this->getSampleContact(),
        ];

        $view = $this->blade(
            '<x-contact.grid :contacts="$contacts" id="test-id" class="test-class" role="test-role" />',
            ['contacts' => $contacts]
        );

        $view->assertSee('role="test-role"', false);
        $view->assertSee('class="list-unstyled row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-5 contact-grid test-class"', false);
        $view->assertSee('id="test-id"', false);
    }
}
