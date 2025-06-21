<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class InputFormController extends Controller
{

    public function index()
    {
        $pageTitle = 'Input Form - LADIS - FH Potsdam';

        return view('inputform_device', compact('pageTitle'));
    }

    /**
     * Store a new device in the database
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->back()->with('success', 'Device has been successfully added.');
    }
}
