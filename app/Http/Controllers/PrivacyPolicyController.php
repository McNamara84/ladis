<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $pageTitle = 'Datenschutzerklärung';
        $lastUpdated = '2025-06-21T00:00:00Z';
        $lastUpdatedFormatted = Carbon::parse($lastUpdated)
            ->timezone('Europe/Berlin')
            ->format('d. F Y');

        return view('privacy-policy', [
            'pageTitle' => $pageTitle,
            'lastUpdated' => $lastUpdated,
            'lastUpdatedFormatted' => $lastUpdatedFormatted,
        ]);
    }
}
