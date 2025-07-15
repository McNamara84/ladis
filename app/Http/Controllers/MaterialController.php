<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\RedirectResponse;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('parent')->get();

        return view('materials.index', compact('materials'));
    }

    public function destroy(Material $material): RedirectResponse
    {
        $material->delete();

        return redirect()->route('materials.all')->with('success', 'Material wurde gelöscht.');
    }
}
