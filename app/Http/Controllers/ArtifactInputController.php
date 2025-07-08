<?php

namespace App\Http\Controllers;
use App\Models\Location;
use App\Models\Material;
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
            'location_id' => 'required|integer|exists:locations,id',
            'name' => 'required|string|max:50|unique:artifacts,name',
            'inventory_number' => 'string',

            'material_name' => 'string|max:50|unique:materials,name',
            'material_parent_id' => 'nullable|exists:materials,id',
        ]);

        $data = [
            'name' => $validated['material_name'],
            'parent_id' => $validated['material_parent_id'] ?? null,
        ];

        // ensure selected parent is a top level material
        if ($data['parent_id']) {
            $parent = Material::find($data['parent_id']);
            if ($parent && $parent->parent_id) {
                return redirect()->back()->withInput()
                    ->with('error', 'Übergeordnetes Material darf kein Unter-Material sein.');
            }
        }

        try {
            Material::create($data);

            return redirect()->route('inputform_material.index')
                ->with('success', 'Material wurde gespeichert');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()
                ->with('error', 'Fehler beim Speichern des Materials: ' . $e->getMessage());
        }
    }
}
