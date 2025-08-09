<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Institution;

class InstitutionController extends Controller
{
    public function index(Request $request)
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

    public function destroy(Request $request, Institution $institution): RedirectResponse
    {
        $institution->delete();

        return redirect()->back()->with('success', 'Institution wurde gelöscht.');
    }
}
