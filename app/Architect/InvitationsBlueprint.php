<?php

namespace App\Architect;

use App\Architect\Plans\InvitationBookingDetails\Plan as Booking;
use App\Architect\Plans\InvitationNames\Plan as PresetNames;
use App\Models\Invitation;
use JPeters\Architect\Blueprints\Blueprint;
use JPeters\Architect\Plans\Boolean;
use JPeters\Architect\Plans\Textfield;

class InvitationsBlueprint extends Blueprint
{
    public function model(): string
    {
        return Invitation::class;
    }

    public function plans(): array
    {
        return [
            Textfield::generate('id')->hideOnForms(),
            Textfield::generate('name', 'Primary Name'),
            PresetNames::generate('preset_names', 'Additional Preset Names'),
            Textfield::generate('limit', 'Guest Limit')->setDefault('2'),
            Boolean::generate('ceremony'),
            Boolean::generate('afternoon'),
            Boolean::generate('evening'),
            Booking::generate('', 'RSVP'),
        ];
    }

    public function ordering(): array
    {
        return [
            [
                'ceremony',
                'desc',
            ],
            [
                'afternoon',
                'desc',
            ],
            [
                'evening',
                'desc',
            ],
            [
                'name',
                'asc',
            ]
        ];
    }
}
