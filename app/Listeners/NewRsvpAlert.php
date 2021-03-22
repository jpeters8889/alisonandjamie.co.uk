<?php

namespace App\Listeners;

use App\Events\RsvpCompleted;
use App\Notifications\NewRsvpNotification;
use Illuminate\Notifications\AnonymousNotifiable;

class NewRsvpAlert
{
    public function handle(RsvpCompleted $event)
    {
        (new AnonymousNotifiable())
            ->route('mail', 'rsvp@alisonandjamie.co.uk')
            ->notify(new NewRsvpNotification($event->booking()));
    }
}
