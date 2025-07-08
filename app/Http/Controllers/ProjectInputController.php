<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Project;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProjectInputController extends Controller
{
    // Display the input form for a project
    public function index()
    {
        $pageTitle = 'Projekteingabe';
        $persons = Person::orderBy('name')->get();
        $venues = Venue::orderBy('name')->get();


        return view('inputform_project', compact('pageTitle', 'persons', 'venues'));
    }

    /**
     * Store a new project in the database
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:50|unique:projects,name',
            'project_description' => 'nullable|string',
            'project_url' => 'required|string|max:255|unique:projects,url',
            'project_started_at' => 'required|date',
            'project_ended_at' => 'required|date',
            'person_id' => 'required|exists:persons,id',
            'venue_id' => 'required|exists:venues,id',
        ]);

        $data = [
            'name' => $validatedData['project_name'],
            'description' => $validatedData['project_description'] ?? null,
            'url' => $validatedData['project_url'],
            'started_at' => $validatedData['project_started_at'],
            'ended_at' => $validatedData['project_ended_at'],
            'person_id' => $validatedData['person_id'],
            'venue_id' => $validatedData['venue_id'],
        ];

        try {
            Project::create($data);

            return redirect()->route('inputform_project.index')
                ->with('success', 'Projekt wurde angelegt');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()
                ->with('error', 'Fehler beim Speichern des Projekts: ' . $e->getMessage());
        }
    }
}