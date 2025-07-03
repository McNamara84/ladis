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
        $materials = Material::all();

        return view('inputform_material', compact('pageTitle', 'materials'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_name' => 'required|string|max:50|unique:materials,name',
            'parent_id' => 'nullable|exists:materials,id',
        ]);




        try {
            Material::create($validated);

            return redirect()->route('inputform_material')->with('success', 'Material wurde gespeichert');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Fehler beim Speichern des Materials: ' . $e->getMessage());
        }
    }
}