<?php

namespace App\Http\Controllers;

use JPeters\PageViewBuilder\Page;

class ThanksToController extends Controller
{
    public function get(Page $page)
    {
        return $page->setPageTitle('With Thanks To')
            ->render('thanks');
    }
}
