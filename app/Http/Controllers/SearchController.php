<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = "Testdevice";

        $devices = [];

        // TODO: Implement search functionality

        $pageTitle = 'Suchergebnisse';

        return view('search.index', compact('devices', 'query', 'pageTitle'));
    }
}
