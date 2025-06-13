<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangelogController extends Controller
{
    /**
     * Display the changelog view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pageTitle = 'Project Changelog';
        $lastUpdated = '2025-06-12';
        
        return view('changelog', compact('pageTitle', 'lastUpdated'));
    }
}
