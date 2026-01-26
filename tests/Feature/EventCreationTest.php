<?php

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('event creation creates mandatory registration fields', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('event.create'), [
        'title' => 'Test Event',
        'description' => 'Description',
        'slug' => 'test-event-fields',
        'registration_start' => now()->format('Y-m-d'),
        'registration_end' => now()->addDays(1)->format('Y-m-d'),
        'base_color' => '#000000',
        'accent_color' => '#ffffff',
        'status' => 'draft',
    ]);

    $response->assertRedirect(route('dashboard.event'));

    $event = Event::where('slug', 'test-event-fields')->first();
    expect($event)->not->toBeNull();

    $fields = $event->registrationFields;
    // We expect at least these 2.
    // If there were default fields added by model boot (unlikely), checking specific ones is safer.
    
    $fullName = $fields->where('label', 'Full Name')->first();
    expect($fullName)->not->toBeNull();
    expect($fullName->type)->toBe('text');
    expect($fullName->is_required)->toBe(true);

    $email = $fields->where('label', 'Email')->first();
    expect($email)->not->toBeNull();
    expect($email->type)->toBe('text');
    expect($email->is_required)->toBe(true);
});
