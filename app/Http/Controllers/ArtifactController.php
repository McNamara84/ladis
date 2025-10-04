<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\View\View;

class ArtifactController extends Controller
{
    public function index(): View
    {
        $artifacts = Artifact::with('location')->orderBy('name')->get();

        return view('artifacts.index', compact('artifacts'));
    }

    public function show(Artifact $artifact): View
    {
        $artifact->load([
            'location.venue.city.federalState',
            'sampleSurfaces' => static function ($query) {
                $query->with([
                    'partialSurfaces.foundationMaterial',
                    'partialSurfaces.coatingMaterial',
                    'partialSurfaces.condition.damagePattern',
                    'partialSurfaces.result.damagePattern',
                    'partialSurfaces.process.device',
                    'partialSurfaces.process.configuration.lens',
                ])->orderBy('name');
            },
        ]);

        return view('artifacts.show', compact('artifact'));
    }

    public function destroy(Artifact $artifact)
    {
        $artifact->delete();

        return redirect()->route('artifacts.all')->with('success', 'Objekt wurde gelöscht.');
    }
}
