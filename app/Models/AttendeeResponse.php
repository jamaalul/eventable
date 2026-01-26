<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendeeResponse extends Model
{
    protected $fillable = [
        'attendee_id',
        'registration_field_id',
        'value'
    ];

    public function attendee() {
        return $this->belongsTo(Attendee::class);
    }

    public function registrationField() {
        return $this->belongsTo(RegistrationField::class);
    }
}
