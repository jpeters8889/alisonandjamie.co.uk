<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use JPeters\PageViewBuilder\Page;

class TravelController extends Controller
{
    public function get(Page $page)
    {
        return $page->setPageTitle('Travel and Accommodation')
            ->render('travel');
    }
}
