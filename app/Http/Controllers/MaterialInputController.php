<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Materialeingabe';

        return view('inputform_material', compact('pageTitle'));
    }
}