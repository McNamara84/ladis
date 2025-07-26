<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        // Load all projects with related person and venue for display
        $projects = Project::with(['person', 'venue'])->get();

        return view('projects.index', compact('projects'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.all')->with('success', 'Projekt wurde gel\xC3\xB6scht.');
    }
}
