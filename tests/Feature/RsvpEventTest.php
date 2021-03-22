<?php

namespace Tests\Feature;

use App\Events\RsvpCompleted;
use App\Models\Booking;
use App\Models\Invitation;
use App\Notifications\NewRsvpNotification;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class RsvpEventTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Invitation $invitation;

    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        $this->invitation = Factory::factoryForModel(Invitation::class)->create();
    }

    protected function dispatchEvent($params = [])
    {
        $this->post('/api/bookings', array_merge([
            'invitation_id' => $this->invitation->id,
            'cant_make_it' => false,
            'ceremony' => true,
            'afternoon' => true,
            'evening' => true,
            'guests' => [
                ['name' => $this->faker->name, 'ageRange' => '18+'],
            ],
            'song_suggestions' => $this->faker->sentence,
        ], $params));

        resolve(Dispatcher::class)->dispatch(new RsvpCompleted(Booking::query()->first()));
    }

    /** @test */
    public function it_triggers_the_notification()
    {
        $this->dispatchEvent();

        Notification::assertSentTo(new AnonymousNotifiable(), NewRsvpNotification::class);
    }

    /** @test */
    public function it_has_the_invitees_name()
    {
        $this->dispatchEvent();

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                return Str::contains($notification->toMail()->introLines[0], $this->invitation->name);
            }
        );
    }

    /** @test */
    public function it_shows_when_the_rsvp_cant_make_it()
    {
        $this->dispatchEvent(['cant_make_it' => true, 'ceremony' => false, 'afternoon' => false, 'evening' => false]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return Str::contains($introLines[1], "Unfortunately they can't make it") && count($introLines) === 2;
            }
        );
    }

    /** @test */
    public function it_doesnt_show_the_ceremony_if_they_are_not_invuted()
    {
        $this->invitation->update(['ceremony' => false]);

        $this->dispatchEvent(['ceremony' => false]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return !Str::contains($introLines[2], 'Ceremony');
            }
        );
    }

    /** @test */
    public function it_doesnt_show_the_afternoon_if_they_are_not_invuted()
    {
        $this->invitation->update(['afternoon' => false]);

        $this->dispatchEvent(['afternoon' => false]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return !Str::contains($introLines[3], 'Afternoon');
            }
        );
    }

    /** @test */
    public function it_doesnt_show_the_evening_if_they_are_not_invuted()
    {
        $this->invitation->update(['evening' => false]);

        $this->dispatchEvent(['evening' => false]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return !Str::contains($introLines[4], 'Evening');
            }
        );
    }

    /** @test */
    public function it_shows_their_rsvp_for_the_ceremony()
    {
        $this->dispatchEvent(['ceremony' => false]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return Str::contains($introLines[2], 'Ceremony: No');
            }
        );

        $this->dispatchEvent(['ceremony' => true]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return Str::contains($introLines[2], 'Ceremony: Yes');
            }
        );
    }

    /** @test */
    public function it_shows_their_rsvp_for_the_afternoon()
    {
        $this->dispatchEvent(['afternoon' => false]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return Str::contains($introLines[3], 'Afternoon: No');
            }
        );

        $this->dispatchEvent(['afternoon' => true]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return Str::contains($introLines[3], 'Afternoon: Yes');
            }
        );
    }

    /** @test */
    public function it_shows_their_rsvp_for_the_evening()
    {
        $this->dispatchEvent(['evening' => false]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return Str::contains($introLines[4], 'Evening: No');
            }
        );

        $this->dispatchEvent(['evening' => true]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                return Str::contains($introLines[4], 'Evening: Yes');
            }
        );
    }

    /** @test */
    public function it_shows_the_guest_information()
    {
        $this->dispatchEvent([
            'guests' => [
                ['name' => 'Jamie Peters', 'ageRange' => '18+'],
                ['name' => 'Alison Wheatley', 'ageRange' => '13-18'],
            ],
        ]);

        Notification::assertSentTo(
            new AnonymousNotifiable(),
            NewRsvpNotification::class,
            function(NewRsvpNotification $notification) {
                $introLines = $notification->toMail()->introLines;

                $assertions = [
                    $introLines[5] === 'Guest Information',
                    count($introLines) === 8,
                    $introLines[6] === 'Jamie Peters - 18+',
                    $introLines[7] === 'Alison Wheatley - 13-18'
                ];

                return !in_array(false, $assertions);
            }
        );
    }
}
