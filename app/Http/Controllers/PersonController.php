<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Person;

class PersonController extends Controller
{
    /**
     * Display a listing of persons.
     */
    public function index()
    {
        $persons = Person::with('institution')->orderBy('name')->get();

        return view('persons.index', compact('persons'));
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
