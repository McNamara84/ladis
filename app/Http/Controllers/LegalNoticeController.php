<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalNoticeController extends Controller
{
     public function index()
    {
        $pageTitle = 'Datenschutzerklärung';
        $lastUpdated = '2025-06-21T00:00:00Z';

        return view('privacy-policy', ['pageTitle' => $pageTitle, 'lastUpdated' => $lastUpdated]);
    }
}
