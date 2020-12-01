<?php

namespace App\Architect;

use App\Models\User;
use JPeters\Architect\Blueprints\Blueprint;
use JPeters\Architect\Plans\Password;
use JPeters\Architect\Plans\Textfield;

class UserBlueprint extends Blueprint
{
    public function model(): string
    {
        return User::class;
    }

    public function plans(): array
    {
        return [
            Textfield::generate('name'),
            Textfield::generate('email'),
            Password::generate('password')->hideOnIndex(),
        ];
    }
}
