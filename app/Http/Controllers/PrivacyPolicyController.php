<?php

namespace App\Http\Controllers;

use App\Services\Contacts\ContactsService;

// This controller handles the display of the Privacy Policy page.
class PrivacyPolicyController extends Controller
{
    public function index(ContactsService $contactsService)
    {
        $pageTitle = 'Datenschutzerklärung';
        $lastUpdated = '2025-06-21T00:00:00Z';

        $contactResponsible = $contactsService->{config('site.contact.responsible')};
        $contactPrivacy = $contactsService->{config('site.contact.privacy')};
        $contactHosting = $contactsService->{config('site.contact.hosting')};
        $contactLdabb = $contactsService->ldabb;
        $contactFhpKommunikation = $contactsService->{'fhp-kommunikation'};

        return view('privacy-policy', compact(
            'pageTitle',
            'lastUpdated',
            'contactResponsible',
            'contactPrivacy',
            'contactHosting',
            'contactLdabb',
            'contactFhpKommunikation',
        ));
    }
}
