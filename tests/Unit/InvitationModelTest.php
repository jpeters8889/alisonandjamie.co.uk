<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_three_digit_id_when_creating_a_row()
    {
        /** @var Invitation $invitation */
        $invitation = Factory::factoryForModel(Invitation::class)->make();

        $this->assertNull($invitation->id);

        $invitation->save();

        $this->assertNotNull($invitation->refresh());
        $this->assertTrue($invitation->id >= 100 && $invitation->id <= 999);
    }
}
