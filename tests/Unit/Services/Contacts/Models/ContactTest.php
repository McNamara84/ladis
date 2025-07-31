<?php

namespace Tests\Unit\Services\Contacts\Models;

use Tests\TestCase;
use App\Services\Contacts\Models\Contact;

class ContactTest extends TestCase
{
    /**
     * Get sample contact data for testing
     */
    private function getSampleContactData(): array
    {
        return [
            'name' => 'Alice Liddell',
            'alternateName' => 'Alice',
            'email' => 'alice@wonderland',
            'address' => [
                'street' => 'Cheshire Cat Crossroads',
                'country' => 'Wonderland'
            ]
        ];
    }

    /**
     * Get sample contact as JSON string
     */
    private function getSampleContactJson(): string
    {
        return json_encode($this->getSampleContactData());
    }

    /**
     * Get sample contact instance
     */
    private function getSampleContact(): Contact
    {
        return new Contact($this->getSampleContactJson());
    }

    /**
     * Test that Contact constructor properly stores and decodes JSON data
     */
    public function test_constructor_stores_and_decodes_json_data(): void
    {
        $json = $this->getSampleContactJson();
        $data = $this->getSampleContactData();

        $contact = new Contact($json);

        $this->assertEquals($json, $contact->getJson());
        $this->assertEquals($data, $contact->getData());
    }

    /**
     * Test any() method returns true when contact has any of the specified properties
     */
    public function test_any_returns_true_when_contact_has_specified_properties(): void
    {
        $contact = $this->getSampleContact();

        $this->assertTrue($contact->any(['name']));
        $this->assertTrue($contact->any(['nonexistent', 'name']));
    }

    /**
     * Test any() method returns false when contact doesn't have any of the specified properties
     */
    public function test_any_returns_false_when_contact_lacks_specified_properties(): void
    {
        $contact = $this->getSampleContact();

        $this->assertFalse($contact->any(['nonexistent']));
        $this->assertFalse($contact->any(['missing', 'absent']));
        $this->assertFalse($contact->any([]));
    }

    /**
     * Test hasDetails() method returns true when contact has detail properties
     */
    public function test_hasDetails_returns_true_when_contact_has_details(): void
    {
        $contact = $this->getSampleContact();

        $this->assertTrue($contact->hasDetails());
    }

    /**
     * Test hasDetails() method returns false when contact lacks detail properties
     */
    public function test_hasDetails_returns_false_when_contact_lacks_details(): void
    {
        $contact = new Contact(json_encode(['name' => 'Alice']));

        $this->assertFalse($contact->hasDetails());
    }

    /**
     * Test magic __get() method for property access
     */
    public function test_magic_get_provides_property_access(): void
    {
        $contact = $this->getSampleContact();
        $data = $this->getSampleContactData();

        $this->assertEquals($data['name'], $contact->name);
        $this->assertEquals($data['address']['street'], $contact->{'address.street'});
        $this->assertNull($contact->nonexistent);
        $this->assertNull($contact->{'nonexistent.property'});
    }

    /**
     * Test magic __isset() method for property existence checking
     */
    public function test_magic_isset_checks_property_existence(): void
    {
        $contact = $this->getSampleContact();

        $this->assertTrue(isset($contact->name));
        $this->assertTrue(isset($contact->{'address.street'}));
        $this->assertFalse(isset($contact->nonexistent));
        $this->assertFalse(isset($contact->{'address.nonexistent'}));
        $this->assertFalse(isset($contact->{'nonexistent.property'}));
    }

    /**
     * Test formatName() method with default format
     */
    public function test_formatName_uses_default_format(): void
    {
        $contact = $this->getSampleContact();

        $result = $contact->formatName();

        $this->assertEquals('Alice Liddell (Alice)', $result);
    }

    /**
     * Test formatName() method with custom format
     */
    public function test_formatName_uses_custom_format_when_provided(): void
    {
        $contact = $this->getSampleContact();

        $result = $contact->formatName('[a]');

        $this->assertEquals($contact->alternateName, $result);
    }

    /**
     * Test formatName() method with unknown token
     */
    public function test_formatName_handles_unknown_token(): void
    {
        $contact = $this->getSampleContact();

        $result = $contact->formatName('[n][ x]');

        $this->assertEquals($contact->name, $result);
    }

    /**
     * Test formatName() method with missing property
     */
    public function test_formatName_handles_missing_property(): void
    {
        $contact = new Contact(json_encode(['name' => 'Alice']));

        $result = $contact->formatName();

        $this->assertEquals($contact->name, $result);
    }
}
