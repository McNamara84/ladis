<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Venue;
use App\Models\FederalState;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $stateId = $request->get('federal_state');

        $federalStates = FederalState::orderBy('name')->get();
        $selectedState = null;
        if ($stateId !== null) {
            $selectedState = $federalStates->firstWhere('id', (int) $stateId);
            if (!$selectedState) {
                abort(404);
            }
        }

        $venues = Venue::with('city.federalState')
            ->when($stateId, function ($query, $stateId) {
                $query->whereHas('city', fn ($q) => $q->where('federal_state_id', $stateId));
            })
            ->get();

        $pageTitle = $selectedState ? 'Alle Orte in ' . $selectedState->name : 'Alle Orte';

        return view('venues.index', [
            'venues' => $venues,
            'federalStates' => $federalStates,
            'federalStateId' => $stateId,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function destroy(Request $request, Venue $venue): RedirectResponse
    {
        $venue->delete();

        return redirect()->back()->with('success', 'Ort wurde gelöscht.');
    }
}
