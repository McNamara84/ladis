<?php

namespace App\Http\Controllers;

// This controller handles the display of the Privacy Policy page.
class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $pageTitle = 'Datenschutzerklärung';
        $lastUpdated = '2025-06-19';
        $url = 'https://www.example.com';

        return view('privacy-policy', ['pageTitle' => $pageTitle, 'lastUpdated' => $lastUpdated, 'URL' => $URL]);
    }
}
