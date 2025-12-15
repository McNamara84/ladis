<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\View\View;

class ConditionController extends Controller
{
    public function show(Condition $condition): View
    {
        $condition->load([
            'damagePattern',
            'images',
            'conditionOf.sampleSurface.artifact.location.venue.city.federalState',
            'conditionOf.foundationMaterial',
            'conditionOf.coatingMaterial',
            'conditionOf.process.device',
            'resultOf.sampleSurface.artifact.location.venue.city.federalState',
            'resultOf.foundationMaterial',
            'resultOf.coatingMaterial',
            'resultOf.process.device',
        ]);

        return view('conditions.show', compact('condition'));
    }
}
