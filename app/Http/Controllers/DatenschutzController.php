<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatenschutzController extends Controller
{
    public function index()
    {
        return view('datenschutz');
    }
}
// This controller handles the display of the Datenschutz (Data Protection) page.
// It returns the 'changelog' view when the index method is called.
