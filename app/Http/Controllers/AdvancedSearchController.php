<?php

/**
 * Advanced Search Controller
 *
 * This controller handles the advanced search functionality for the laser
 * cleaning database application. It manages the display and processing
 * of advanced search forms and results.
 *
 * @package App\Http\Controllers
 * @author FHP LADIS Team
 * @since 0.1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\FederalState;
use App\Models\Device;
use App\Models\Institution;
use App\Models\Person;
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
        'federal_state_id',
        'device_id',
        'institution_id',
        'material_id',
        'person_name',
        'project_name',
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
     * @todo Create a Request class for the search parameter validation
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
            $parameter = array_keys($queryParameters)[0];
            $value = $queryParameters[$parameter];
            // @todo Consider redirecting to a dedicated view for the returned instance.
            return $this->performSimpleSearch($parameter, $value);
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
     * @todo Create a Service class for the actual search logic
     *
     * @param string $parameter Search parameter name
     * @param mixed $value Search parameter value
     * @return array Array of search results with consistent Collection structure
     */
    private function performSimpleSearch(string $parameter, mixed $value): array
    {
        // Create a consistent structure for the results
        $results = [
            'type' => 'simple',
            'fuzzy' => false,
            'parameter' => $parameter,
            'value' => $value,
            'model' => '',
            'records' => collect([]),
        ];

        if ($parameter === 'federal_state_id') {
            $results['model'] = FederalState::class;
            $federalState = FederalState::find($value);
            if ($federalState) {
                $results['records'] = collect([$federalState]);
            }
        }

        if ($parameter === 'project_name') {
            $results['model'] = Project::class;
            $results['fuzzy'] = true;
            $results['records'] = Project::where('name', 'LIKE', "%{$value}%")
                ->limit($this->defaultChunkSize)
                ->get();
        }

        if ($parameter === 'person_name') {
            $results['model'] = Person::class;
            $results['fuzzy'] = true;
            $results['records'] = Person::where('name', 'LIKE', "%{$value}%")
                ->limit($this->defaultChunkSize)
                ->get();
        }

        if ($parameter === 'institution_id') {
            $results['model'] = Institution::class;
            $institution = Institution::find($value);
            if ($institution) {
                $results['records'] = collect([$institution]);
            }
        }

        if ($parameter === 'device_id') {
            $results['model'] = Device::class;
            $device = Device::find($value);
            if ($device) {
                $results['records'] = collect([$device]);
            }
        }

        if ($parameter === 'material_id') {
            $results['model'] = Material::class;
            $material = Material::find($value);
            if ($material) {
                $results['records'] = $material->children->prepend($material);
            }
        }

        return $results;
    }

    /**
     * Perform combined search across multiple entities
     *
     * Since direct relationships are limited, we search for contextual matches
     * by looking for shared connections through venues, institutions, etc.
     *
     * @todo This is a placeholder for the actual combined search logic.
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
