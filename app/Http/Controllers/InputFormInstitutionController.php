<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Institution;

class InputFormInstitutionController extends Controller
{

    public function index()
    {
        $pageTitle = 'Eingabeformular - Institution - LADIS - FH Potsdam';

        return view('inputform_institution', compact('pageTitle'));
    }


}