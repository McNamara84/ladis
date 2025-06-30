<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialInputController extends Controller
{
    public function index()
    {
        $pageTitle = 'Materialeingabe';

        return view('inputform_material', compact('pageTitle'));
    }
     public function store(Request $request)
    {
       $material = Material::create([
            'name' => $request['material_name'],
        ]);
        
        return redirect ()->route('inputform_material')->with('success','Material wurde gespeichert');
    }
}