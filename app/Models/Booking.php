<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property Invitation $invitation
 * @property Collection<BookingGuest> $guests
 * @property bool $cant_make_it
 * @property bool $ceremony
 * @property bool $afternoon
 * @property bool $evening
 * @property string|null $song_suggestions
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Booking extends Model
{
    protected $casts = [
        'limit' => 'int',
        'cant_make_it' => 'bool',
        'ceremony' => 'bool',
        'afternoon' => 'bool',
        'evening' => 'bool',
    ];

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    protected $with = ['guests'];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(BookingGuest::class);
    }
}
