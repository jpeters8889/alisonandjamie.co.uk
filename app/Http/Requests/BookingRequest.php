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
            'cantMakeIt' => ['bool'],
            'ceremony' => [new BookingCeremonyAvailableRule($this)],
            'afternoon' => [new BookingAfternoonAvailableRule($this)],
            'evening' => [new BookingEveningAvailableRule($this)],
            'guests' => ['required', 'array', new BookingGuestLimitRule($this)],
            'guests.*.name' => ['required'],
            'guests.*.ageRange' => ['required', Rule::in(['0-4', '5-12', '13-18', '18+'])],
        ];
    }
}
