<?php

namespace App\Http\Controllers;

use App\Models\Device;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('institution')->get();

        return view('devices.index', compact('devices'));
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.all')->with('success', 'Gerät wurde gelöscht.');
    }
}
