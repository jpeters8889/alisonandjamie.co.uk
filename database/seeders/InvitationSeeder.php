<?php

namespace Database\Seeders;

use App\Models\Invitation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationSeeder extends Seeder
{
    public function run()
    {
        $factory = Factory::factoryForModel(Invitation::class);

        $factory->create([
            'id' => 111,
            'name' => 'Jamie Peters',
            'limit' => 2,
        ]);

        $factory->eveningOnly()->create([
           'id' => 222,
           'name' => 'Alison Wheatley',
        ]);

        $factory->ceremonyOnly()->create([
            'id' => 333,
            'name' => 'Daniel Peters',
        ]);
    }
}
