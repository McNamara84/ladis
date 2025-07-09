<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Institution;

class InstitutionController extends Controller
{
    public function index(string $category)
    {
        $mapping = [
            'manufacturers' => [
                'title' => 'Alle Hersteller',
                'type' => Institution::TYPE_MANUFACTURER,
            ],
            'clients' => [
                'title' => 'Alle Auftraggeber',
                'type' => Institution::TYPE_CLIENT,
            ],
            'contractors' => [
                'title' => 'Alle Auftragnehmer',
                'type' => Institution::TYPE_CONTRACTOR,
            ],
        ];

        if (!isset($mapping[$category])) {
            abort(404);
        }

        $institutions = Institution::where('type', $mapping[$category]['type'])->get();
        $pageTitle = $mapping[$category]['title'];

        return view('institutions.index', compact('institutions', 'pageTitle'));
    }

    public function destroy(Request $request, Institution $institution): RedirectResponse
    {
        $institution->delete();

        return redirect()->back()->with('success', 'Institution wurde gelöscht.');
    }
}
