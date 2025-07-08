<?php

namespace App\Http\Controllers;
use App\Models\Configuration;
use App\Models\Device;
use App\Models\PartialSurface;
use Illuminate\Http\Request;
use App\Models\Process;

class ProcessInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Prozesseingabe';
        // Fetch necessary data for the view, e.g., partial surfaces, devices, configurations
        $devices = Device::orderBy('name')->get();
        $partialSurface = PartialSurface::orderBy('sample_surface_id')->get();
        $configurations = Configuration::orderBy('description')->get();

        return view('inputform_process', compact('pageTitle', 'partialSurface', 'devices', 'configurations'));
    }   

