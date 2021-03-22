<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Booking;
use App\Models\BookingGuest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRsvpNotification extends Notification
{
    use Queueable;

    protected Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail()
    {
        $message = (new MailMessage())
            ->greeting('New RSVP')
            ->line('A Wedding RSVP has been created or updated for '.$this->booking->invitation->name);

        if ($this->booking->cant_make_it) {
            return $message->line("Unfortunately they can't make it 😢");
        }

        $message->line('There RSVP Details are:');

        if ($this->booking->invitation->ceremony) {
            $message->line('Ceremony: '.($this->booking->ceremony ? 'Yes' : 'No'));
        }

        if ($this->booking->invitation->afternoon) {
            $message->line('Afternoon: '.($this->booking->afternoon ? 'Yes' : 'No'));
        }

        if ($this->booking->invitation->evening) {
            $message->line('Evening: '.($this->booking->evening ? 'Yes' : 'No'));
        }

        $message->line('Guest Information');

        $this->booking->guests()->each(function (BookingGuest $guest) use ($message) {
            $message->line("{$guest->name} - {$guest->age_range}");
        });

        return $message;
    }
}
