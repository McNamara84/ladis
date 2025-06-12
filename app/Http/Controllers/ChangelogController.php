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
        return view('changelog');
    }
}
