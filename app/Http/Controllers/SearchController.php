<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Institution;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $queryString = $request->input('q');
        $advanced = $request->boolean('advanced');
        $institution = $request->input('institution_id');
        $filterInstId = $request->input('filter_institution_id');
        $minWeightInput = $request->input('weight_min');
        $maxWeightInput = $request->input('weight_max');
        $minYearInput = $request->input('year_min');
        $maxYearInput = $request->input('year_max');
        $cooling = $request->input('cooling');

        $devicesQuery = Device::query();

        if ($advanced) {
            if ($queryString) {
                $devicesQuery->where('name', 'like', "%{$queryString}%");
            }

            if ($institution) {
                $devicesQuery->whereHas('institution', function ($q) use ($institution) {
                    $q->where('name', 'like', "%{$institution}%");
                });
            }
        } else {
            if ($queryString) {
                $devicesQuery->where(function ($q) use ($queryString) {
                    $q->where('name', 'like', "%{$queryString}%")
                        ->orWhereHas('institution', function ($q2) use ($queryString) {
                            $q2->where('name', 'like', "%{$queryString}%");
                        });
                });
            }
        }

        if ($filterInstId) {
            $devicesQuery->where('institution_id', $filterInstId);
        }

        if ($minWeightInput !== null && $minWeightInput !== '') {
            $devicesQuery->where('weight', '>=', $minWeightInput);
        }

        if ($maxWeightInput !== null && $maxWeightInput !== '') {
            $devicesQuery->where('weight', '<=', $maxWeightInput);
        }

        if ($minYearInput !== null && $minYearInput !== '') {
            $devicesQuery->where('year', '>=', $minYearInput);
        }

        if ($maxYearInput !== null && $maxYearInput !== '') {
            $devicesQuery->where('year', '<=', $maxYearInput);
        }

        if ($cooling === '1') {
            $devicesQuery->where('cooling', 1);
        } elseif ($cooling === '0') {
            $devicesQuery->where(function ($q) {
                $q->where('cooling', 0)->orWhereNull('cooling');
            });
        }

        $hasConditions = $queryString || $institution || $filterInstId ||
            $request->filled('weight_min') || $request->filled('weight_max') ||
            $request->filled('year_min') || $request->filled('year_max') ||
            $request->has('cooling');

        $devices = $hasConditions ? $devicesQuery->get() : collect();

        $pageTitle = 'Suchergebnisse';
        $institutions = Institution::orderBy('name')->get();
        $minWeight = Device::min('weight');
        $maxWeight = Device::max('weight');
        $minYear = $minYearInput ?? Device::min('year');
        $maxYear = $maxYearInput ?? Device::max('year');

        $query = $queryString; // preserve original variable name for the view

        return view('search.index', compact(
            'devices',
            'query',
            'pageTitle',
            'institutions',
            'minWeight',
            'maxWeight',
            'minYear',
            'maxYear',
            'cooling'
        ));
    }
}