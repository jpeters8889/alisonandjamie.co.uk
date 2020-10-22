<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class StaticPageTest extends TestCase
{
    /**
     * @test
     * @dataProvider pages
     */
    public function it_loads_the_static_pages($page): void
    {
        $this->get($page)->assertStatus(200);
    }

    public function pages()
    {
        return [
            ['/'],
            ['/venues-and-schedule'],
            ['/travel-and-accommodation'],
            ['/q-and-a'],
        ];
    }
}
