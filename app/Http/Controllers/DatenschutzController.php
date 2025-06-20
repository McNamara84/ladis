<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatenschutzController extends Controller
{
    public function index()
    {
        $pageTitle = 'Datenschutzerklärung';
        $lastUpdated = '2025-06-19';

        return view('datenschutz', ['pageTitle' => $pageTitle, 'lastUpdated' => $lastUpdated]);
    }
}
// This controller handles the display of the Datenschutz (Data Protection) page.
// It returns the 'changelog' view when the index method is called.
