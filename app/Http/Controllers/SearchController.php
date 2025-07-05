<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        // Check if the request is comming from the advanced search
        $advanced = $request->boolean('advanced');

        $devices = [];
        if ($query) {
            $devices = Device::where('name', 'like', "%{$query}%")
            ->orWhereHas('institution', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->get();
        }

        $pageTitle = 'Suchergebnisse';

        return view('search.index', compact('devices', 'query', 'pageTitle'));
    }
}
