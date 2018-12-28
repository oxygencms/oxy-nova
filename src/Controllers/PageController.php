<?php

namespace Oxygencms\OxyNova\Controllers;

use Oxygencms\OxyNova\Models\Page;

class PageController extends Controller
{
    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page)
    {
        $page->load('sections');

        $data = compact('page');

//        switch ($page->template) {
//            case 'venues':
//                $data['venues'] = Venue::all();
//                break;
//        }

        return view("oxygen::pages.$page->template", $data);
    }
}
