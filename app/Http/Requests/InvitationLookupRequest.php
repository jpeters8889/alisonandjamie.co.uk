<?php

namespace App\Http\Requests;

use App\Models\Invitation;

class InvitationLookupRequest extends ApiFormRequest
{
    public function invitation(): ?Invitation
    {
        return Invitation::query()->find($this->input('invitation'));
    }

    public function rules(): array
    {
        return [
            'invitation' => ['required'],
        ];
    }
}
