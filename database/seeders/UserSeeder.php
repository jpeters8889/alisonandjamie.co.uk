<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $factory = Factory::factoryForModel(User::class);

        $factory->create([
            'name' => 'Jamie Peters',
            'email' => 'jamie@jamie-peters.co.uk',
        ]);
    }
}
