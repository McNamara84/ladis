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
        try {
            $process->delete();
        } catch (\Exception $e) {
            return redirect()->route('processes.all')->with('error', 'Prozess konnte nicht gelöscht werden: ' . $e->getMessage());
        }

        return redirect()->route('processes.all')->with('success', 'Prozess wurde gelöscht.');
    }
}
