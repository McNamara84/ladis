<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\PartialSurface;
use App\Models\SampleSurface;
use App\Models\Material;
use App\Models\Condition;

class PartialSurfaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'destroy']);
        $this->middleware('can:create,' . PartialSurface::class)->only(['create', 'store']);
        $this->middleware('can:delete,partialSurface')->only('destroy');
    }

    public function index(): View
    {
        $partialSurfaces = PartialSurface::with([
            'sampleSurface:id,name',
            'sampleSurface.artifact:id,name',
            'foundationMaterial:id,name',
            'coatingMaterial:id,name',
            'condition:id,description',
            'result:id,description',
        ])
            ->orderBy('identifier')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        return view('partial_surfaces.index', [
            'partialSurfaces' => $partialSurfaces,
        ]);
    }

    public function show(PartialSurface $partialSurface): View
    {
        $partialSurface->load([
            'sampleSurface.artifact.location.venue.city.federalState',
            'foundationMaterial.parent',
            'coatingMaterial.parent',
            'condition.damagePattern',
            'condition.images',
            'result.damagePattern',
            'result.images',
            'process.device.institution',
            'process.configuration.lens',
        ]);

        return view('partial_surfaces.show', compact('partialSurface'));
    }

    public function create(): View
    {
        $sampleSurfaces = SampleSurface::orderBy('name')->get(['id', 'name']);
        $materials = Material::orderBy('name')->get(['id', 'name']);
        $conditions = Condition::orderBy('id')->get(['id', 'description']);

        return view('partial_surfaces.create', [
            'sampleSurfaces' => $sampleSurfaces,
            'materials' => $materials,
            'conditions' => $conditions,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sample_surface_id' => ['required', 'exists:sample_surfaces,id'],
            'foundation_material_id' => ['required', 'exists:materials,id'],
            'coating_material_id' => ['required', 'exists:materials,id', 'different:foundation_material_id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'result_id' => ['required', 'exists:conditions,id'],
            'identifier' => ['nullable', 'string', 'max:100'],
            'size' => ['required', 'numeric', 'min:0.01', 'max:999.99'],
        ]);

        PartialSurface::create($validated);

        return redirect()
            ->route('partial_surfaces.all')
            ->with('success', 'Teilfläche wurde erfolgreich angelegt.');
    }

    public function destroy(PartialSurface $partialSurface): RedirectResponse
    {
        $partialSurface->delete();

        return redirect()
            ->route('partial_surfaces.all')
            ->with('success', 'Teilfläche wurde gelöscht.');
    }
}
