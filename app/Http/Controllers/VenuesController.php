<?php

namespace App\Http\Controllers;

use JPeters\PageViewBuilder\Page;

class VenuesController extends Controller
{
    public function get(Page $page)
    {
        return $page->setPageTitle('Venues and Schedule')
            ->render('venues');
    }
}
