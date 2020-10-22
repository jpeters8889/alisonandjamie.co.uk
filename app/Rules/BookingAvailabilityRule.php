<?php

declare(strict_types=1);

namespace App\Rules;

use App\Http\Requests\BookingRequest;
use Illuminate\Contracts\Validation\Rule;

abstract class BookingAvailabilityRule implements Rule
{
    private BookingRequest $request;

    public function __construct(BookingRequest $request)
    {
        $this->request = $request;
    }

    abstract protected function invitationVariable(): string;

    public function passes($attribute, $value): bool
    {
        $check = $this->request->invitation()->{$this->invitationVariable()};

        // If the check is available and the passed value isn't a bool
        if ($value === null && $check) {
            return false;
        }

        // If the check isn't available and the value is true
        if ($value === true && ! $check) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Error';
    }
}
