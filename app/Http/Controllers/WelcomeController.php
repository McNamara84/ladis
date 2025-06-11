<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }
}
