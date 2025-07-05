<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $advanced = $request->boolean('advanced'); // Check if the request is comming from the advanced search
        $institution = $request->input('institution_id');

        $devices = [];
        if ($advanced && ($query || $institution)) {
            $devices = Device::query();

            if ($query) {
                $devices->where('name', 'like', "%{$query}%");
            }

            if ($institution) {
                $devices->orWhereHas('institution', function ($q) use ($institution) {
                    $q->where('name', 'like', "%{$institution}%");
                });
            }

            $devices = $devices->get();

        } elseif ($query) {
            $devices = Device::where('name', 'like', "%{$query}%")
            ->orWhereHas('institution', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            // TODO: Implement simple search other strings togehter with the device names and institution names
            ->get();
        
        }

        $pageTitle = 'Suchergebnisse';

        return view('search.index', compact('devices', 'query', 'pageTitle'));
    }
}
