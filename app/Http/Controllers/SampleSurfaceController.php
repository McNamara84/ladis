<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\SampleSurface;
use App\Models\Artifact;

class SampleSurfaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'destroy']);
        $this->middleware('can:create,' . SampleSurface::class)->only(['create', 'store']);
        $this->middleware('can:delete,sampleSurface')->only('destroy');
    }

    public function index(): View
    {
        $sampleSurfaces = SampleSurface::with(['artifact:id,name'])
            ->withCount('partialSurfaces')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('sample_surfaces.index', [
            'sampleSurfaces' => $sampleSurfaces,
        ]);
    }

    public function create(): View
    {
        $artifacts = Artifact::orderBy('name')->get(['id', 'name']);

        return view('sample_surfaces.create', [
            'artifacts' => $artifacts,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'artifacts_id' => ['required', 'exists:artifacts,id'],
            'name' => ['required', 'string', 'max:50', 'unique:sample_surfaces,name'],
            'description' => ['required', 'string'],
        ]);

        SampleSurface::create($validated);

        return redirect()
            ->route('sample_surfaces.all')
            ->with('success', 'Probenfläche wurde erfolgreich angelegt.');
    }

    public function destroy(SampleSurface $sampleSurface): RedirectResponse
    {
        $sampleSurface->delete();

        return redirect()
            ->route('sample_surfaces.all')
            ->with('success', 'Probenfläche wurde gelöscht.');
    }
}
