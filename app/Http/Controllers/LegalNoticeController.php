<?php

namespace App\Http\Controllers;

class LegalNoticeController extends Controller
{
     public function index()
    {
        $pageTitle = 'Impressum';
        $lastUpdated = '2025-07-02 T00:00:00Z';

        return view('legal_notice', ['pageTitle' => $pageTitle, 'lastUpdated' => $lastUpdated]);
    }
}
