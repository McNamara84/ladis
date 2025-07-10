<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Image;
use App\Models\Project;
use App\Models\Condition;

class ImageUploadController extends Controller
{
    /**
     * Displays the input form for uploading an image.
     */
    public function index()
    {
        $pageTitle = 'Bild Upload - LADIS - FH Potsdam';
        $projects = Project::orderBy('name')->get();
        $conditions = Condition::orderBy('damage_pattern_id')->get();

        return view('inputform_image', compact('pageTitle','projects','conditions'));
    }
    /**
     * Store images.
     */
    public function store(Request $request): RedirectResponse
    {
        // Storing validated data from the incoming data from request
        // Validation rules are defined here
        $validatedData = $request->validate([

            'image' => 'required|image|max:2048',
            'project_id' => 'required|integer|exists:projects,id',
            'condition_id' => 'nullable|integer|exists:conditions,id',
            'description' => 'nullable|string|max:255',
            'alt_text' => 'required|string|max:255',
            'year_created' => 'required|integer',
            'creator' => 'required|string|max:50',
        ]);
        
        // Currently hard-coded to null.
        // TODO: Add check to validate condition_id across all relevant foreign keys later.
        $validatedData['condition_id'] = null;

        // Catching errors during the database operation
        try {
            // Storing the image in the filesystem
            $projectId = $request->project_id;
            $path = $request->file('image')->store("uploads/$projectId", 'public');
            $validatedData['uri'] = 'storage/' . $path;
            Image::create($validatedData);

            // If the image is successfully uploaded, we redirect to the index route with a success message
            return redirect()
                ->route('inputform_image.index')
                ->with('success', 'Das Bild wurde erfolgreich hochgeladen!');

        } catch (\Exception $e) {

            // Error handling: If an error occurs during the database operation, we catch it and return an error message.
            // For production, consider removing the detailed system message to avoid exposing technical details
            // and potential sensitive information such as table names in SQL errors.
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Fehler beim Speichern des Bildes: ' . $e->getMessage());

        }
    }
}
