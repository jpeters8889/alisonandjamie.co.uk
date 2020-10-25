<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingGuest extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
