<?php

namespace Oxygencms\OxyNova\Controllers;


use Illuminate\View\View;
use Oxygencms\OxyNova\Contracts\Page;

class PageController extends Controller
{
    /**
     * @param Page $page
     * @return View
     */
    public function show(Page $page): View
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
