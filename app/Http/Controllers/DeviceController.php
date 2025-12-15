<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\View\View;

class DeviceController extends Controller
{
    public function index(): View
    {
        $devices = Device::with('institution')->get();

        return view('devices.index', compact('devices'));
    }

    public function show(Device $device): View
    {
        $device->load([
            'institution',
            'lenses.configurations',
            'lastEditor',
            'processes' => static function ($query) {
                $query->with([
                    'configuration.lens',
                    'partialSurface.sampleSurface.artifact.location.venue.city.federalState',
                    'partialSurface.foundationMaterial',
                    'partialSurface.coatingMaterial',
                    'partialSurface.condition.damagePattern',
                    'partialSurface.result.damagePattern',
                ])->orderBy('id');
            },
        ]);

        return view('devices.show', compact('device'));
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.all')->with('success', 'Gerät wurde gelöscht.');
    }
}
