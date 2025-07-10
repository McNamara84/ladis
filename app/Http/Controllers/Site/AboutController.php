<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

/**
 * AboutController
 *
 * This controller is used to display the about page.
 *
 * @package App\Http\Controllers\Site
 * @author LADIS Team FB5 FHP
 * @since 0.1.0
 */
class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('site.about');
    }
}
