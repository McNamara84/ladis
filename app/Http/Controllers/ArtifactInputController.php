<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtifactInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Objekt Eingabeformular';

        return view('inputform_artifact', compact('pageTitle'));
    }

}
