<?php

namespace App\Http\Controllers\App\Processes;

use App\Http\Controllers\Controller;
use App\Models\Process;
use Illuminate\View\View;

class ProcessesController extends Controller
{
    public function index(): View
    {
        $processes = Process::with([
            'device',
            'partialSurface.foundationMaterial',
            'partialSurface.coatingMaterial',
            'partialSurface.sampleSurface.artifact.location.venue.projects'
        ])->get();

        return view('processes.index', compact('processes'));
    }

    public function show(Process $process): View
    {
        $process->load([
            'device.institution',
            'configuration.lens',
            'partialSurface.sampleSurface.artifact.location.venue.city.federalState',
            'partialSurface.foundationMaterial',
            'partialSurface.coatingMaterial',
            'partialSurface.condition.damagePattern',
            'partialSurface.condition.images',
            'partialSurface.result.damagePattern',
            'partialSurface.result.images',
        ]);

        return view('processes.show', compact('process'));
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
