<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cant_make_it' => false,
            'ceremony' => true,
            'afternoon' => true,
            'evening' => true,
            'song_suggestions' => $this->faker->sentence,
        ];
    }

    public function cantMakeIt()
    {
        return $this->state(function () {
            return [
                'cant_make_it' => true,
                'ceremony' => false,
                'afternoon' => false,
                'evening' => false,
            ];
        });
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
