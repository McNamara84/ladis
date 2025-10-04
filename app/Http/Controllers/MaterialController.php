<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PartialSurface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(): View
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

    public function show(Material $material): View
    {
        $material->load([
            'parent',
            'children' => static function ($query) {
                $query->orderBy('name');
            },
        ]);

        $partialSurfaces = PartialSurface::with([
            'sampleSurface.artifact.location.venue.city.federalState',
            'foundationMaterial',
            'coatingMaterial',
            'condition.damagePattern',
            'result.damagePattern',
            'process.device',
            'process.configuration.lens',
        ])->where(function ($query) use ($material) {
            $query->where('foundation_material_id', $material->id)
                ->orWhere('coating_material_id', $material->id);
        })
            ->orderBy('identifier')
            ->orderBy('id')
            ->get();

        return view('materials.show', [
            'material' => $material,
            'partialSurfaces' => $partialSurfaces,
        ]);
    }

    public function destroy(Material $material): RedirectResponse
    {
        $material->delete();

        return redirect()->route('materials.all')->with('success', 'Material wurde gelöscht.');
    }
}
