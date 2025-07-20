<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\RedirectResponse;

class MaterialController extends Controller
{
    public function index()
    {
        // Load only top level materials and eager load their children
        // for a hierarchical display. Ordering by name keeps the list
        // deterministic and easier to read.
        $materials = Material::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('materials.index', compact('materials'));
    }

    public function destroy(Material $material): RedirectResponse
    {
        $material->delete();

        return redirect()->route('materials.all')->with('success', 'Material wurde gelöscht.');
    }
}
