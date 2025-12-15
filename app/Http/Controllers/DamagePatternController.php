<?php

namespace App\Http\Controllers;

use App\Models\DamagePattern;
use Illuminate\View\View;

class DamagePatternController extends Controller
{
    public function index(): View
    {
        $damagePatterns = DamagePattern::withCount('conditions')
            ->orderBy('name')
            ->get();

        return view('damage_patterns.index', compact('damagePatterns'));
    }

    public function show(DamagePattern $damagePattern): View
    {
        $damagePattern->load([
            'conditions' => static function ($query) {
                $query->with([
                    'conditionOf.sampleSurface.artifact.location.venue.city',
                    'resultOf.sampleSurface.artifact.location.venue.city',
                    'images',
                ])->orderBy('id');
            },
        ]);

        return view('damage_patterns.show', compact('damagePattern'));
    }
}
