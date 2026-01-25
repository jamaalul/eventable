<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'slug',
        'registration_start',
        'registration_end',
        'status',
        'base_color',
        'accent_color',
        'logo_url',
        'cover_url'
    ];

    protected function casts(): array
    {
        return [
            'registration_start' => 'date',
            'registration_end' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
