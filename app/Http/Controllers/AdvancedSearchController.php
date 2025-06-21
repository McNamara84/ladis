<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvancedSearchController extends Controller
{
    public function index()
    {
        $pageTitle = 'Suche';

        return view('advanced_search', compact('pageTitle'));
    }
}
