<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Device;

class InputFormController extends Controller
{

    public function index()
    {
        $pageTitle = 'Input Form - LADIS - FH Potsdam';

        return view('inputform_device', compact('pageTitle'));
    }

    /**
     * Store a new device in the database
     */
    public function store(Request $request): RedirectResponse
    {
        // Storing validated data from the incoming data from request
        // Note: The validation rules are defined here, you can adjust them as needed
        // This is a basic example, you might want to customize the rules further
        $validatedData = $request->validate([
            // Basic values
            'name' => 'required|string|max:50|unique:devices,name',
            'year' => 'nullable|integer|min:1900|max:2099',
            'build' => 'nullable|integer|in:0,1',
            'description' => 'nullable|string',
            
            // Dimensions
            'height' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0', 
            'depth' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric|min:0|max:999.99',
            'fiber_length' => 'nullable|numeric|min:0|max:999.99',
            
            // Systems
            'cooling' => 'nullable|integer|in:0,1',
            'mounting' => 'nullable|boolean',
            'automation' => 'nullable|boolean',
            
            // Power
            'max_output' => 'nullable|numeric|min:0',
            'mean_output' => 'nullable|numeric|min:0',
            'max_wattage' => 'nullable|numeric|min:0',
            
            // Technical deatials
            'head' => 'nullable|string|max:50',
            'emission_source' => 'nullable|integer',
            'beam_type' => 'required|integer|in:0,1,2',
            'beam_profile' => 'nullable|string|max:50',
            'wavelength' => 'nullable|numeric|min:0',
            
            // Min/Max values
            'min_spot_size' => 'nullable|numeric|min:0',
            'max_spot_size' => 'nullable|numeric|min:0',
            'min_pf' => 'nullable|numeric|min:0',
            'max_pf' => 'nullable|numeric|min:0',
            'min_pw' => 'nullable|numeric|min:0',
            'max_pw' => 'nullable|numeric|min:0',
            'min_scan_width' => 'nullable|numeric|min:0',
            'max_scan_width' => 'nullable|numeric|min:0',
            'min_focal_length' => 'nullable|numeric|min:0',
            'max_focal_length' => 'nullable|numeric|min:0',
        ]);

        // Add Institution ID (temporarily hardcoded)
        // TODO: Later we get this from form
        $validatedData['institution_id'] = 1; // Temporarily hardcoded
        
        // Add User ID (temporarily hardcoded)
        // TODO: Later we get this from Auth::user()
        $validatedData['last_edit_by'] = 1; // Temporarily hardcoded

        // Catching errors during the database operation
        try {
            // Create a new device record in the database
            $device = Device::create($validatedData);
            
            // If the device is successfully created, we redirect to the index route with a success message
            return redirect()
                ->route('inputform.index')
                ->with('success', 'Lasergerät "' . $device->name . '" wurde erfolgreich hinzugefügt!');
                
        } catch (\Exception $e) {

            // Error handling: If an error occurs during the database operation, we catch it and return an error message
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Fehler beim Speichern des Geräts: ' . $e->getMessage());
        }
    }
}
