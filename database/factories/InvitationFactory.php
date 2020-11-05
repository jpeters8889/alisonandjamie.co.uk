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
        $names = [];
        $limit = random_int(2, 5);

        for ($x = 0; $x < random_int(1, $limit - 1); $x++) {
            $names[] = $this->faker->name;
        }

        return [
            'name' => $this->faker->name,
            'limit' => $limit,
            'ceremony' => true,
            'afternoon' => true,
            'evening' => true,
            'preset_names' => $names
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
