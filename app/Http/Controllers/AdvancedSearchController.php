<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvancedSearchController extends Controller
{
    public function index()
    {
        $pageTitle = 'Advanced Search - Laser-Projekt - FH Potsdam';
        $lastUpdated = '2025-06-15';

        return view('advanced_search', compact('pageTitle', 'lastUpdated'));
    }
}
