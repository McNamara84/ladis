<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Materialeingabe';
        // Only offer materials without a parent as potential parents
        $materials = Material::whereNull('parent_id')->get();

        return view('inputform_material', compact('pageTitle', 'materials'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_name' => 'required|string|max:50|unique:materials,name',
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

            return redirect()->route('materials.all')
                ->with('success', 'Material wurde gespeichert');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()
                ->with('error', 'Fehler beim Speichern des Materials: ' . $e->getMessage());
        }
    }
}
