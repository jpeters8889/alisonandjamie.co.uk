<?php

declare(strict_types=1);

namespace App\Rules;

use App\Http\Requests\BookingRequest;
use Illuminate\Contracts\Validation\Rule;

class BookingGuestLimitRule implements Rule
{
    private BookingRequest $request;

    public function __construct(BookingRequest $request)
    {
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {
        return count($value) <= $this->request->invitation()->limit;
    }

    public function message()
    {
        return 'error';
    }
}
