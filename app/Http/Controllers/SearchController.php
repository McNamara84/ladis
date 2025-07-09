<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Institution;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $advanced = $request->boolean('advanced'); // Check if the request is coming from the advanced search
        $institution = $request->input('institution_id');
        $filterInstitution = $request->input('filter_institution_id');
        $weightMin = $request->input('weight_min');
        $weightMax = $request->input('weight_max');
        $minYear = $request->input('year_min', Device::min('year'));
        $maxYear = $request->input('year_max', Device::max('year'));
        $cooling = $request->input('cooling');

        $devices = collect();
        $devicesQuery = Device::query();
        $hasConditions = false;

        if ($advanced && ($query || $institution)) {
            if ($query) {
                $devicesQuery->where('name', 'like', "%{$query}%");
                $hasConditions = true;
            }

            if ($institution) {
                $devicesQuery->whereHas('institution', function ($q) use ($institution) {
                    $q->where('name', 'like', "%{$institution}%");
                });
                $hasConditions = true;
            }
        } elseif ($query) {
            $devicesQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhereHas('institution', function ($q2) use ($query) {
                        $q2->where('name', 'like', "%{$query}%");
                    });
            });
            $hasConditions = true;
        }
        if (!$hasConditions) {
            $hasConditions = $filterInstitution !== null
                || $request->filled('weight_min')
                || $request->filled('weight_max')
                || $request->filled('year_min')
                || $request->filled('year_max')
                || ($cooling !== null && $cooling !== '');
        }

        if ($hasConditions) {
            if ($filterInstitution) {
                $devicesQuery->where('institution_id', $filterInstitution);
            }

            if ($weightMin !== null && $weightMin !== '') {
                $devicesQuery->where('weight', '>=', $weightMin);
            }

            if ($weightMax !== null && $weightMax !== '') {
                $devicesQuery->where('weight', '<=', $weightMax);
            }

            if ($minYear !== null && $minYear !== '') {
                $devicesQuery->where('year', '>=', $minYear);
            }

            if ($maxYear !== null && $maxYear !== '') {
                $devicesQuery->where('year', '<=', $maxYear);
            }

            if ($cooling === '1') {
                $devicesQuery->where('cooling', '==', 1);
            } elseif ($cooling === '0') {
                $devicesQuery->where('cooling', '==', 0);
                $devicesQuery->where('cooling', '==', null); // TODO: those devices with no information for cooling are added categorised under the devices with no coolers - the descision needs to be validated by stakeholders
            }

            $devices = $devicesQuery->get();
        }

        $pageTitle = 'Suchergebnisse';
        $institutions = Institution::orderBy('name')->get();
        $minWeight = Device::min('weight');
        $maxWeight = Device::max('weight');

        return view('search.index', compact('devices', 'query', 'pageTitle', 'institutions', 'minWeight', 'maxWeight', 'minYear', 'maxYear', 'cooling'));
    }
}
