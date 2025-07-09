<?php

namespace App\Http\Controllers;
use App\Models\Location;
use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Objekt Eingabeformular';
        $locations = Location::orderBy('name')->get();

        return view('inputform_artifact', compact('pageTitle', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'artifact_location_id' => 'required|integer|exists:locations,id',
            'artifact_name' => 'required|string|max:50|unique:artifacts,name',
            'artifact_inventory_number' => 'nullable|string|max:50',
        ]);

        $data = [
            'location_id' => $validated['artifact_location_id'],
            'name' => $validated['artifact_name'] ?? null,
            'inventory_number' => $validated['artifact_inventory_number'],
        ];

        try {
            Artifact::create($data);

            return redirect()->route('inputform_artifact.index')
                ->with('success', 'Objekt wurde gespeichert');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()
                ->with('error', 'Fehler beim Speichern des Objekts: ' . $e->getMessage());
        }
    }
}
