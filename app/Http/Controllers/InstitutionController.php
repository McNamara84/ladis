<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Institution;

class InstitutionController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->get('type');

        $mapping = [
            null => [
                'title' => 'Alle Institutionen',
                'type' => null,
            ],
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

        if (!array_key_exists($type, $mapping)) {
            abort(404);
        }

        $institutions = Institution::when(
            $mapping[$type]['type'],
            fn($query, $type) => $query->where('type', $type)
        )->get();
        $pageTitle = $mapping[$type]['title'];

        return view('institutions.index', compact('institutions', 'pageTitle', 'type'));
    }

    public function show(Institution $institution): View
    {
        $institution->load([
            'devices' => static function ($query) {
                $query->with([
                    'institution',
                    'lenses',
                    'processes.partialSurface.sampleSurface.artifact.location.venue.city.federalState',
                ])->orderBy('name');
            },
            'persons' => static function ($query) {
                $query->with([
                    'institution',
                    'projects.venue.city.federalState',
                ])->orderBy('name');
            },
        ]);

        return view('institutions.show', compact('institution'));
    }

    public function destroy(Request $request, Institution $institution): RedirectResponse
    {
        $institution->delete();

        return redirect()->back()->with('success', 'Institution wurde gelöscht.');
    }
}
