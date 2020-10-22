<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use JPeters\PageViewBuilder\Page;

class QAndAController extends Controller
{
    public function get(Page $page)
    {
        return $page->setPageTitle('Questions and Answers')
            ->render('qanda');
    }
}
