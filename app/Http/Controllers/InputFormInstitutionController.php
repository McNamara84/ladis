<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Models\Institution;


class InputFormInstitutionController extends Controller
{

    public function index()
    {
        $pageTitle = 'Eingabeformular - Institution - LADIS - FH Potsdam';

        return view('inputform_institution', compact('pageTitle'));
    }
    /**
     * Store a new institution in the database
     */
    public function store(Request $request): RedirectResponse
    {
        // Storing validated data from the incoming data from request
        // Validation rules are defined here
        $validatedData = $request->validate([

            'name' => 'required|string|max:50|unique:institutions,name',
            'type' => ['required',
                Rule::in([
                    Institution::TYPE_CLIENT,
                    Institution::TYPE_CONTRACTOR,
                    Institution::TYPE_MANUFACTURER,
                ])
            ],
            'contact_information' => 'required|string|max:255',

        ]);
        // Catching errors during the database operation
        try {
            // Create a new institution record in the database
            $institution = Institution::create($validatedData);


}