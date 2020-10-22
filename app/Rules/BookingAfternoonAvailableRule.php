<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BookingAfternoonAvailableRule extends BookingAvailabilityRule implements Rule
{
    protected function invitationVariable(): string
    {
        return 'afternoon';
    }
}
