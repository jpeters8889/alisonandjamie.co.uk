<?php

namespace App\Events;

use App\Models\Booking;

class RsvpCompleted
{
    protected Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function booking(): Booking
    {
        return $this->booking;
    }
}
