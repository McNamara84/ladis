<?php

namespace App\Http\Controllers\App\Processes;

use App\Http\Controllers\Controller;
use App\Models\Process;

class ProcessesController extends Controller
{
    public function index()
    {
        $processes = Process::with([
            'device',
            'partialSurface.foundationMaterial',
            'partialSurface.coatingMaterial',
            'partialSurface.sampleSurface.artifact.location.venue.projects'
        ])->get();

        return view('processes.index', compact('processes'));
    }

    public function destroy(Process $process)
    {

        $process->delete();

        return redirect()->route('processes.all')->with('success', 'Prozess wurde gelöscht.');
    }
}
