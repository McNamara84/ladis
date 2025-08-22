<?php

namespace App\Http\Controllers;

use App\Models\Artifact;

class ArtifactController extends Controller
{
    public function index()
    {
        $artifacts = Artifact::with('location')->orderBy('name')->get();

        return view('artifacts.index', compact('artifacts'));
    }

    public function show(Artifact $artifact)
    {
        return view('artifacts.show', compact('artifact'));
    }
}
