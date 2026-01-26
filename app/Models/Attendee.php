<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = [
        'event_id',
        'full_name',
        'email',
        'qr_code',
        'attendee_code',
        'checked_in_at'
    ];

    protected function casts(): array
    {
        return [
            'checked_in_at' => 'datetime'
        ];
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function attendeeResponse() {
        return $this->hasMany(AttendeeResponse::class);
    }
}
