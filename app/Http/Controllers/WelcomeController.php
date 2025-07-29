<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Services\Contacts\ContactsService;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index(ContactsService $contactsService)
    {
        $deviceCount = Device::count();

        $fb2 = $contactsService->fb2;
        $fb5 = $contactsService->fb5;

        return view('welcome', compact(
            'deviceCount',
            'fb2',
            'fb5',
        ));
    }
}
