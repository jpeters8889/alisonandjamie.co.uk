<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Invitation;

class InvitationController extends Controller
{
    public function get(Invitation $invitation)
    {
        return $invitation;
    }
}
