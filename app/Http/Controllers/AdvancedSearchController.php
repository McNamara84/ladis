<?php

/**
 * Advanced Search Controller
 *
 * This controller handles the advanced search functionality for the laser
 * cleaning database application. It manages the display and processing
 * of advanced search forms and results.
 *
 * @package App\Http\Controllers
 * @author Laser Database Team
 * @since 0.1.0
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * AdvancedSearchController
 *
 * Handles advanced search operations for a limited set of arguments.
 */
class AdvancedSearchController extends Controller
{
    /**
     * Display the advanced search form
     *
     * Shows the main advanced search interface where users can input
     * various search criteria to find specific records in the database.
     *
     * @return View The advanced search view with page title
     */
    public function index(): View
    {
        // Set the page title for the advanced search interface
        $pageTitle = 'Suche';

        // Return the advanced search view with the page title
        return view('advanced_search', compact('pageTitle'));
    }
}
