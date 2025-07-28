<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Contacts\ContactsService;

/**
 * ContactController
 *
 * This controller is used to display the contact page.
 *
 * @since 0.2.0
 */
class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @param ContactsService $contactsService
     * @return \Illuminate\View\View
     */
    public function index(ContactsService $contactsService)
    {
        // Load all contacts for the card list demo
        $allContacts = $contactsService->all();

        // Assign demo contacts for individual components
        $demoOrganization = $allContacts['fhp'];
        $demoPerson = $allContacts['schmitt-rodermund-eva'];

        return view('site.contact', [
            'demoOrganization' => $demoOrganization,
            'demoPerson' => $demoPerson,
            'allContacts' => $allContacts
        ]);
    }
}
