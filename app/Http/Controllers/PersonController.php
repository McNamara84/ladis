<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Person;

class PersonController extends Controller
{
    /**
     * Display a listing of persons.
     */
    public function index(): View
    {
        $persons = Person::with('institution')->orderBy('name')->get();

        return view('persons.index', compact('persons'));
    }

    public function show(Person $person): View
    {
        $person->load([
            'institution',
            'projects' => static function ($query) {
                $query->with([
                    'venue.city.federalState',
                    'images',
                ])->orderBy('started_at');
            },
        ]);

        return view('persons.show', compact('person'));
    }

    /**
     * Remove the specified person from storage.
     */
    public function destroy(Person $person): RedirectResponse
    {
        $person->delete();

        return redirect()->route('persons.all')->with('success', 'Person wurde gelöscht.');
    }
}
