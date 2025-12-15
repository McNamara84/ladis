<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        // Load all projects with related person and venue for display
        $projects = Project::with(['person', 'venue'])->get();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project): View
    {
        $project->load([
            'person.institution',
            'venue.city.federalState',
            'coverImage',
            'thumbnailImage',
            'images' => static function ($query) {
                $query->with('condition.damagePattern')->orderBy('year_created');
            },
        ]);

        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.all')->with('success', 'Projekt wurde gelöscht.');
    }
}
