<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Events\RsvpCompleted;
use App\Models\Booking;
use App\Models\BookingGuest;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CreateBookingTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public Invitation $invitation;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->setUpFaker();

        $this->invitation = Factory::factoryForModel(Invitation::class)->create();

        Event::fake();
    }

    /** @test */
    public function it_errors_if_the_invitation_doesnt_exist()
    {
        $this->makeRequest(['invitation_id' => 'foo'])->assertStatus(404);
    }

    /** @test */
    public function it_errors_if_we_dont_send_a_ceremony_when_ceremony_is_available()
    {
        $this->makeRequest(['ceremony' => null])->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_try_to_book_onto_the_ceremony_when_it_isnt_available()
    {
        $this->invitation->update(['ceremony' => false]);

        $this->makeRequest()->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_dont_send_a_afternoon_when_afternoon_is_available()
    {
        $this->makeRequest(['afternoon' => null])->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_try_to_book_onto_the_afternoon_when_it_isnt_available()
    {
        $this->invitation->update(['afternoon' => false]);

        $this->makeRequest()->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_dont_send_a_evening_when_evening_is_available()
    {
        $this->makeRequest(['evening' => null])->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_try_to_book_onto_the_evening_when_it_isnt_available()
    {
        $this->invitation->update(['evening' => false]);

        $this->makeRequest()->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_dont_send_guests()
    {
        $this->makeRequest(['guests' => null])->assertStatus(422);
        $this->makeRequest(['guests' => []])->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_dont_send_a_guest_name()
    {
        $this->makeRequest(['guests' => ['age' => '18+']])
            ->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_dont_send_a_guest_age()
    {
        $this->makeRequest(['guests' => ['name' => 'Foo']])
            ->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_send_an_invalid_age()
    {
        $this->makeRequest(['guests' => ['name' => 'Foo', 'age' => 'bar']])
            ->assertStatus(422);
    }

    /** @test */
    public function it_errors_if_we_send_too_many_guests()
    {
        $this->invitation->update(['limit' => 1]);

        $this->makeRequest([
            'guests' => [
                ['name' => 'Jamie', 'age' => '18+'],
                ['name' => 'Alison', 'age' => '13-18'],
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function it_returns_ok()
    {
        $this->makeRequest()->assertStatus(200);
    }

    /** @test */
    public function it_creates_the_row_in_the_booking_table()
    {
        $this->assertEmpty(Booking::all());
        $this->assertNull($this->invitation->booking);

        $this->makeRequest();

        $this->assertNotNull($this->invitation->fresh()->booking);
    }

    /** @test */
    public function it_saves_the_ceremony_value()
    {
        $this->makeRequest(['ceremony' => false]);

        $this->assertFalse($this->invitation->fresh()->booking->ceremony);
    }

    /** @test */
    public function it_saves_the_afternoon_value()
    {
        $this->makeRequest(['afternoon' => false]);

        $this->assertFalse($this->invitation->fresh()->booking->afternoon);
    }

    /** @test */
    public function it_saves_the_evening_value()
    {
        $this->makeRequest(['evening' => false]);

        $this->assertFalse($this->invitation->fresh()->booking->evening);
    }

    /** @test */
    public function it_saves_the_guest_record()
    {
        $this->assertEmpty(BookingGuest::all());

        $this->makeRequest();

        $this->assertNotEmpty($this->invitation->booking->fresh()->guests);
    }

    /** @test */
    public function it_stores_the_guests_data()
    {
        $this->makeRequest([
            'guests' => [
                ['name' => 'Jamie', 'ageRange' => '18+'],
                ['name' => 'Alison', 'ageRange' => '13-18'],
            ],
        ]);

        $this->assertCount(2, $this->invitation->fresh()->booking->guests);
        $this->assertDatabaseHas('booking_guests', ['name' => 'Jamie', 'age_range' => '18+']);
        $this->assertDatabaseHas('booking_guests', ['name' => 'Alison', 'age_range' => '13-18']);
    }

    /** @test */
    public function it_errors_if_submit_an_i_cant_make_it_rsvp_with_additional_options_checked()
    {
        $this->makeRequest(['cant_make_it' => true, 'afternoon' => false, 'evening' => false])
            ->assertStatus(422);

        $this->makeRequest(['cant_make_it' => true, 'ceremony' => false, 'evening' => false])
            ->assertStatus(422);

        $this->makeRequest(['cant_make_it' => true, 'afternoon' => false, 'ceremony' => false])
            ->assertStatus(422);
    }

    /** @test */
    public function it_errors_when_an_i_cant_make_it_request_with_multiple_guests_is_submitted()
    {
        $this->makeRequest([
            'cant_make_it' => true,
            'ceremony' => false,
            'afternoon' => false,
            'evening' => false,
            'guests' => [
                ['name' => 'Jamie', 'ageRange' => '18+'],
                ['name' => 'Alison', 'ageRange' => '13-18'],
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function it_stores_the_cant_make_it_value_in_the_database()
    {
        $this->makeRequest();

        $this->assertFalse($this->invitation->fresh()->booking->cant_make_it);

        $this->makeRequest([
            'cant_make_it' => true,
            'ceremony' => false,
            'afternoon' => false,
            'evening' => false,
        ]);

        $this->assertTrue($this->invitation->fresh()->booking->cant_make_it);
    }

    /** @test */
    public function it_stores_the_song_suggestions_in_the_table()
    {
        $this->makeRequest(['song_suggestions' => 'Foobar']);

        $this->assertEquals('Foobar', $this->invitation->fresh()->booking->song_suggestions);
    }

    /** @test */
    public function it_dispatches_an_event_when_the_booking_is_completed()
    {
        $this->makeRequest();

        Event::assertDispatched(RsvpCompleted::class);
    }

    protected function makeRequest($params = [])
    {
        return $this->post('/api/bookings', array_merge([
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
    }
}
