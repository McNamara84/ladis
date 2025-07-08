<?php

namespace App\Http\Controllers;
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
        $partialSurface = PartialSurface::orderBy('sample_surface_id')->get();
        $configurations = Configuration::orderBy('description')->get();

        return view('inputform_process', compact('pageTitle', 'partialSurface', 'devices', 'configurations'));
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

        try {
            // Create a new process record in the database
            $process = Process::create($validated);

            return redirect()->route('inputform_process.index')
                ->with('success', 'Prozess wurde erfolgreich gespeichert!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Fehler beim Speichern des Prozesses: ' . $e->getMessage());
        }
    }
