<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Contacts\ContactsService;

/**
 * AboutController
 *
 * This controller is used to display the about page.
 *
 * @package App\Http\Controllers\Site
 * @author LADIS Team FB5 FHP
 * @since 0.1.0
 */
class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @param ContactsService $contactsService
     * @return \Illuminate\View\View
     */
    public function index(ContactsService $contactsService)
    {
        // Load contacts used in inline links
        $inlineContacts = $contactsService->getMultiple([
            'dbu',
            'ksa',
            'fb2-konservierung',
            'fb5-iud'
        ]);

        // Load project leadership contacts and partners
        $projectContacts = $contactsService->getMultiple([
            'ksa',
            'ldasa',
            'grimm-remus-corinna',
            'idk',
            'bauer-bornemann-ulrich',
            'meinhardt-jeannine'
        ]);

        return view('site.about', [
            'inlineContacts' => $inlineContacts,
            'projectContacts' => $projectContacts
        ]);
    }
}
