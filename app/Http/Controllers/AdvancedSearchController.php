<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FederalState;
use App\Models\Institution;

class AdvancedSearchController extends Controller
{
    public function index()
    {
        $pageTitle = 'Advanced Search - Laser-Projekt - FH Potsdam';
        $states = FederalState::orderBy('name')->get();
        $institutions = Institution::orderBy('name')->get();

        return view('advanced_search', compact('pageTitle', 'states', 'institutions'));
    }
}
