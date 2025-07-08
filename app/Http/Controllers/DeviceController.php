<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        // TODO: Fetch all devices from the database

        return view('devices.index');
    }
}
