<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Invitation;
use App\Rules\BookingAfternoonAvailableRule;
use App\Rules\BookingCeremonyAvailableRule;
use App\Rules\BookingEveningAvailableRule;
use App\Rules\BookingGuestLimitRule;
use Illuminate\Validation\Rule;

class BookingRequest extends ApiFormRequest
{
    private ?Invitation $invitation = null;

    public function invitation(): ?Invitation
    {
        if (! $this->invitation) {
            $this->invitation = Invitation::query()->findOrFail($this->input('invitation_id'));
        }

        return $this->invitation;
    }

    public function rules()
    {
        return [
            'invitation_id' => ['required', 'exists:invitations,id'],
            'ceremony' => ['bool', new BookingCeremonyAvailableRule($this)],
            'afternoon' => ['bool', new BookingAfternoonAvailableRule($this)],
            'evening' => ['bool', new BookingEveningAvailableRule($this)],
            'guests' => ['required', 'array', new BookingGuestLimitRule($this)],
            'guests.*.name' => ['required'],
            'guests.*.age' => ['required', Rule::in(['0-4', '5-12', '13-18', '18+'])],
        ];
    }
}
