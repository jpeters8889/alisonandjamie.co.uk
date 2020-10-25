<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use JPeters\PageViewBuilder\Page;

class RsvpThanksController extends Controller
{
    public function get(Page $page)
    {
        return $page->setPageTitle('Thanks!')
            ->render('rsvp-thanks');
    }
}
