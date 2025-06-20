<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InputFormController extends Controller
{

    public function index()
    {
        $pageTitle = 'Input Form - Laser-Projekt - FH Potsdam';

        return view('inputform_device', compact('pageTitle'));
    }
}
