<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsOfUseController extends Controller
{
    public function index()
    {
        $pageTitle = 'Nutzungsbedingungen';
        $lastUpdated = '2025-07-10 T00:00:00Z';

        return view('terms_of_use', ['pageTitle' => $pageTitle, 'lastUpdated' => $lastUpdated]);
    }
}
