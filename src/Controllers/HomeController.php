<?php

namespace Oxygencms\OxyNova\Controllers;

use Oxygencms\OxyNova\Models\Page;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $page = Page::bySlug('/')->with('sections.media')->first();

        return view("oxygen::pages.$page->template", compact('page'));
    }
}
