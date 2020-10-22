<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invitation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'limit' => random_int(1, 5),
            'ceremony' => true,
            'afternoon' => true,
            'evening' => true,
        ];
    }

    public function eveningOnly()
    {
        return $this->state(function () {
            return [
                'ceremony' => false,
                'afternoon' => false,
            ];
        });
    }

    public function ceremonyOnly()
    {
        return $this->state(function () {
            return [
                'evening' => false,
                'afternoon' => false,
            ];
        });
    }

    public function ceremonyAndEveningOnly()
    {
        return $this->state(function () {
            return [
                'afternoon' => false,
            ];
        });
    }

    public function afternoonAndEveningOnly()
    {
        return $this->state(function () {
            return [
                'ceremony' => false,
            ];
        });
    }
}
