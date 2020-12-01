<?php

namespace App\Architect\Plans\InvitationBookingDetails;

use App\Models\Invitation;

class ApiHandler
{
    public function booking($id)
    {
        return Invitation::query()
            ->where('id',$id)
            ->first() ?? [];
    }
}
