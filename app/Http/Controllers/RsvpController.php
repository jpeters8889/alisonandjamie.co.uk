<?php

namespace App\Http\Controllers;

use JPeters\PageViewBuilder\Page;

class RsvpController extends Controller
{
    public function get(Page $page)
    {
        return $page->setPageTitle('RSVP')->render('rsvp');
    }
}
