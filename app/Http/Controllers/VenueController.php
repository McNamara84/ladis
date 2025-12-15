<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\FederalState;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VenueController extends Controller
{
    public function index(Request $request): View
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

    public function show(Venue $venue): View
    {
        $venue->load([
            'city.federalState',
            'locations' => static function ($query) {
                $query->with([
                    'artifacts.sampleSurfaces.partialSurfaces',
                ])->orderBy('name');
            },
            'projects' => static function ($query) {
                $query->with([
                    'person.institution',
                    'images',
                ])->orderBy('started_at');
            },
        ]);

        return view('venues.show', compact('venue'));
    }

    public function create()
    {
        $pageTitle = 'Eingabeformular - Ort - LADIS - FH Potsdam';
        $cities = City::with('federalState')->orderBy('name')->get();

        return view('inputform_venue', compact('pageTitle', 'cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('venues')->where(fn ($q) => $q->where('city_id', $request->city_id)),
            ],
            'city_id' => 'required|exists:cities,id',
        ]);

        try {
            $venue = Venue::create($validated);

            return redirect()
                ->route('venues.create')
                ->with('success', 'Ort "'.$venue->name.'" wurde erfolgreich hinzugefügt!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Fehler beim Speichern des Ortes: '.$e->getMessage());
        }
    }

    public function destroy(Request $request, Venue $venue): RedirectResponse
    {
        $venue->delete();

        return redirect()->back()->with('success', 'Ort wurde gelöscht.');
    }
}
