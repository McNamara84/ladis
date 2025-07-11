<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Project;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ProjectInputController extends Controller
{
    // Display the input form for a project
    public function index()
    {
        $pageTitle = 'Neues Projekt anlegen';
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
            'name' => 'required|string|max:50|unique:projects,name',
            'description' => 'required|string',
            'url' => 'required|string|max:255|unique:projects,url',
            'started_at' => 'required|date',
            'ended_at' => 'required|date|after_or_equal:started_at',
            'person_id' => 'required|exists:persons,id',
            'venue_id' => 'required|exists:venues,id',
        ], [
            'ended_at.after_or_equal' => 'Das Enddatum darf nicht vor dem Startdatum liegen.',
        ]);

        try {
            $project = Project::create($validatedData);

            return redirect()
                ->route('inputform_project.index')
                ->with('success', 'Projekt "'.$project->name.'" wurde erfolgreich angelegt!');

        } catch (\Exception $e) {
            Log::error('Fehler beim Speichern des Projekts: ' . $e->getMessage(), [
                'attributes' => $validatedData,
            ]);
            return redirect()->back()->withInput()
                ->with('error', 'Fehler beim Speichern des Projekts: '.$e->getMessage());
        }
    }
}