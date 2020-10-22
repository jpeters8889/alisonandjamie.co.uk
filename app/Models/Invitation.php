<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int     $id
 * @property string  $name
 * @property int     $limit
 * @property bool    $ceremony
 * @property bool    $afternoon
 * @property bool    $evening
 * @property Booking $booking
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class Invitation extends Model
{
    protected $casts = [
        'limit' => 'int',
        'ceremony' => 'bool',
        'afternoon' => 'bool',
        'evening' => 'bool',
    ];

    protected $guarded = [];

    public $incrementing = false;

    protected static function booted()
    {
        static::creating(static function (self $invitation) {
            $invitation->id = random_int(100, 999);

            return $invitation;
        });
    }

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
