<?php

namespace App\Http\Controllers;
use App\Models\Location;

class ArtifactInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Objekt Eingabeformular';
        $locations = Location::orderBy('name')->get();

        return view('inputform_artifact', compact('pageTitle', 'locations'));
    }

}
