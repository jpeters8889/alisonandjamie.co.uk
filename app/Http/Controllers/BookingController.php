<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Support\Collection;

class BookingController extends Controller
{
    public function create(BookingRequest $request)
    {
        /** @var Booking $booking */
        $booking = $request->invitation()->booking()->updateOrCreate([], [
            'ceremony' => $request->input('ceremony'),
            'afternoon' => $request->input('afternoon'),
            'evening' => $request->input('evening'),
        ]);

        (new Collection($request->input('guests')))
            ->map(static function ($guest) use ($booking) {
                $booking->guests()->create([
                    'name' => $guest['name'],
                    'age_range' => $guest['age'],
                ]);
            });
    }
}
