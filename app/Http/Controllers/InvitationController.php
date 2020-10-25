<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\InvitationLookupRequest;

class InvitationController extends Controller
{
    public function get(InvitationLookupRequest $request)
    {
        $invitation = $request->invitation();

        abort_if(!$invitation, 404);

        return $invitation;
    }
}
