<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use JPeters\PageViewBuilder\Page;

class HomeController extends Controller
{
    public function get(Page $page)
    {
        return $page->render('index');
    }
}
