<?php

namespace App\Http\Controllers;

use App\Services\Contacts\ContactsService;

class LegalNoticeController extends Controller
{
    public function index(ContactsService $contactsService)
    {
        $pageTitle = 'Impressum';
        $lastUpdated = '2025-07-29T00:00:00Z';
        $lastUpdatedFormatted = formatDate($lastUpdated);

        $supervisoryAuthority = $contactsService->{config('site.contact.supervisory_authority')};

        return view('legal_notice', compact(
            'pageTitle',
            'lastUpdated',
            'lastUpdatedFormatted',
            'supervisoryAuthority',
        ));
    }
}
