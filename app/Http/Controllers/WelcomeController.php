<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $deviceCount = Device::count();

        return view('welcome', ['deviceCount' => $deviceCount]);
    }
}
