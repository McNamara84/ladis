<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class InputFormProjectController extends Controller
{

    public function index()
    {
        $pageTitle = 'Input Form - Project';

        return view('inputform_project', compact('pageTitle'));
    }
}

 /**
     * Store a new project in the database
     */

public function store(Request $request): RedirectResponse
{
    $validatedData = $request->validate([
        // Values
        'name' => 'required|string|max:50|unique:projects,name',
        'description' => 'nullable|string',
        'url' => 'required|string|max:255|unique:projects,url',
        'started_at' => 'nullable|date',
        'ended_at' => 'nullable|date'
    ]);

        //Adding Foreign-IDs
         $validatedData['person_id'] = 1;
        $validatedData['venue_id'] = 1;
         $validatedData['cover_image_id'] = 1;
          $validatedData['thumbnail_image_id'] = 1;

      // Catching errors during the database operation
        try {
            // Create a new project record in the database
            $project = Project::create($validatedData);

            return redirect()
                ->route('inputform_project.index')
                ->with('success', 'Projekt "' . $project->name . '" wurde erfolgreich angelegt!');

        } catch (\Exception $e) {

            // Error handling: If an error occurs during the database operation, we catch it and return an error message
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Fehler beim Speichern des Projekts: ' . $e->getMessage());
    }}