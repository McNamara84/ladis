<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Person;
use App\Models\Institution;

class InputFormPersonController extends Controller
{
    /**
     * Display the form to create a new person.
     */
    public function index()
    {
        $pageTitle = 'Eingabeformular - Person - LADIS - FH Potsdam';
        $institutions = Institution::orderBy('name')->get();

        return view('inputform_person', compact('pageTitle', 'institutions'));
    }

    /**
     * Store a new person in the database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50|unique:persons,name',
            'institution_id' => 'required|exists:institutions,id',
        ]);

        try {
            $person = Person::create($validatedData);

            return redirect()
                ->route('inputform_person.index')
                ->with('success', 'Person "' . $person->name . '" wurde erfolgreich hinzugefügt!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Fehler beim Speichern der Person: ' . $e->getMessage());
        }
    }
}
