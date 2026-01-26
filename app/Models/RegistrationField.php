<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationField extends Model
{
    protected $fillable = [
        'event_id',
        'label',
        'type',
        'options',
        'is_required',
        'is_mandatory'
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'is_mandatory' => 'boolean'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function attendeeResponse() {
        return $this->hasMany(AttendeeResponse::class);
    }
}
