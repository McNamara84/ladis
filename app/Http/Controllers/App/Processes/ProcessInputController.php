<?php

namespace App\Http\Controllers\App\Processes;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Device;
use App\Models\PartialSurface;
use Illuminate\Http\Request;
use App\Models\Process;


class ProcessInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Prozesseingabe';
        // Fetch necessary data for the view, e.g., partial surfaces, devices, configurations
        $devices = Device::orderBy('name')->get();
        $partialSurfaces = PartialSurface::orderBy('sample_surface_id')->get();
        $configurations = Configuration::orderBy('description')->get();

        return view('inputform_process', compact('pageTitle', 'partialSurfaces', 'devices', 'configurations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'partial_surface_id' => 'required|exists:partial_surfaces,id',
            'device_id' => 'required|exists:devices,id',
            'configuration_id' => 'required|exists:configurations,id',
            'description' => 'nullable|string|max:255',
            'duration' => 'required|integer|min:0|max:3',
            'wet' => 'required|integer|min:0|max:1',
        ]);

        $data = [
            'partial_surface_id' => $validated['partial_surface_id'],
            'device_id' => $validated['device_id'],
            'configuration_id' => $request->input('configuration_id'),
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'wet' => $validated['wet'],
        ];

        try {
            // Create a new process record in the database
            Process::create($data);

            return redirect()->route('inputform_process.index')
                ->with('success', 'Prozess wurde erfolgreich gespeichert!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Fehler beim Speichern des Prozesses: ' . $e->getMessage());
        }
    }
}
