<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Location;
use App\Models\Venue;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    /**
     * Display a listing of all locations including their venues.
     */
    public function index(): View
    {
        $locations = Location::with('venue.city')
            ->orderBy('name')
            ->get();

        $pageTitle = 'Standorte verwalten';

        return view('locations.index', [
            'locations' => $locations,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Show the form for creating a new location.
     */
    public function create(): View
    {
        $pageTitle = 'Eingabeformular - Standort';
        $venues = Venue::with('city')->orderBy('name')->get();

        return view('inputform_location', [
            'pageTitle' => $pageTitle,
            'venues' => $venues,
        ]);
    }

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('locations')->where(fn ($query) => $query->where('venue_id', $request->input('venue_id'))),
            ],
            'venue_id' => ['required', 'exists:venues,id'],
        ]);

        try {
            $location = Location::create($validated);

            return redirect()
                ->route('locations.create')
                ->with('success', 'Standort "' . $location->name . '" wurde erfolgreich gespeichert.');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Fehler beim Speichern des Standorts: ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroy(Location $location): RedirectResponse
    {
        $location->delete();

        return redirect()
            ->back()
            ->with('success', 'Standort wurde gelöscht.');
    }
}
