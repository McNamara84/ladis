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
use App\Models\Device;
use App\Models\Project;
use App\Models\Material;

/**
 * AdvancedSearchController
 *
 * Handles advanced search operations for a limited set of arguments.
 */
class AdvancedSearchController extends Controller
{
    /**
     * List of accepted query parameters
     * @var array
     */
    private $acceptedQueryParameters = [
        'device_name',
        'project_name',
        'material_id',
    ];

    /**
     * Default number of results to display per page
     * @var int
     */
    private $defaultChunkSize = 10;

    /**
     * Display the advanced search form and handle search requests
     *
     * Shows the main advanced search interface where users can input
     * various search criteria. When query parameters are present,
     * performs the search and returns results.
     *
     * @param Request $request The HTTP request containing query parameters
     * @return View The advanced search view with page title and optional results
     */
    public function index(Request $request): View
    {
        // Initialize data for the view
        $pageTitle = 'Suche';
        $results = [];
        $hasSearched = false;

        // Check if any search parameters are present and perform the search
        if ($request->hasAny($this->acceptedQueryParameters)) {
            $hasSearched = true;
            $results = $this->performSearch($request);
        }

        // Return the advanced search view with data
        return view('advanced_search', compact('pageTitle', 'results', 'hasSearched'));
    }

    /**
     * Collect the query parameters and perform the search based on the criteria
     *
     * If only one criterion is present, perform a simple search.
     * If multiple criteria are present, perform a combined search.
     *
     * @todo Add parameter validation
     *
     * @param Request $request The HTTP request containing query parameters
     * @return array Array of combined search results with relevance scores
     */
    private function performSearch(Request $request): array
    {
        // Collect the query parameters
        $queryParameters = [];

        foreach ($this->acceptedQueryParameters as $parameter) {
            if (!$request->has($parameter)) {
                continue;
            }

            // @todo The check for the parameter type is a quick and dirty hack.
            $queryParameters[$parameter] = str_ends_with($parameter, '_id')
                ? $request->integer($parameter)
                : $request->input($parameter);
        }

        // If only one criterion, do simple search
        if (count($queryParameters) === 1) {
            return $this->performSimpleSearch($queryParameters);
        }

        // For multiple criteria, perform combined search
        return $this->performCombinedSearch($queryParameters);
    }

    /**
     * Perform simple search for single criterion
     *
     * The function is very verbose and could be simplified.
     * It's intentionally kept this way to make the code easier to understand
     * and to make it easier to adjust individual queries.
     *
     * @todo Add pagination
     *
     * @param array $queryParameters Search criteria array
     * @return array Array of search results
     */
    private function performSimpleSearch(array $queryParameters): array
    {
        $results = [];

        if (isset($queryParameters['device_name'])) {
            $results['devices'] = Device::where('name', 'LIKE', "%{$queryParameters['device_name']}%")
                ->limit($this->defaultChunkSize)
                ->get();
        }

        if (isset($queryParameters['project_name'])) {
            $results['projects'] = Project::where('name', 'LIKE', "%{$queryParameters['project_name']}%")
                ->limit($this->defaultChunkSize)
                ->get();
        }

        // @todo Handle the case where the material is a parent or child
        if (isset($queryParameters['material_id'])) {
            $results['materials'] = Material::where('id', $queryParameters['material_id'])
                ->get();
        }


        return $results;
    }

    /**
     * Perform combined search across multiple entities
     *
     * Since direct relationships are limited, we search for contextual matches
     * by looking for shared connections through venues, institutions, etc.
     *
     * @param array $queryParameters Search criteria array
     * @return array Array of combined search results
     */
    private function performCombinedSearch(array $queryParameters): array
    {
        $results = [
            'combined_results' => [],
            'individual_results' => []
        ];

        return $results;
    }
}
