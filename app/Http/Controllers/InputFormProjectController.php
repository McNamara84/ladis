<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InputFormProjectController extends Controller
{

    public function index()
    {
        $pageTitle = 'Input Form - Project';

        return view('inputform_project', compact('pageTitle'));
    }
}
