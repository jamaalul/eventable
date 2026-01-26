<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function create(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:45'],
            'description' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:45', 'unique:events,slug'],
            'registration_start' => ['required', 'date'],
            'registration_end' => ['required', 'date'],
            'status' => ['nullable', 'string', 'in:Draft,Published,Ongoing,Completed'],
            'base_color' => ['required', 'string'],
            'accent_color' => ['required', 'string'],
            'logo_url' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            'cover_url' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120']
        ]);

        $logoPath = null;
        if ($request->hasFile('logo_url')) {
            $logoPath = $request->file('logo_url')->store('logos', 'public');
        }

        $coverPath = null;
        if ($request->hasFile('cover_url')) {
            $coverPath = $request->file('cover_url')->store('covers', 'public');
        }

        $event = Event::create([
            'user_id' => $request->user()->id,

            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => $validated['slug'],

            'registration_start' => $validated['registration_start'],
            'registration_end' => $validated['registration_end'],

            'status' => $validated['status'] ?? 'Draft',

            'base_color' => $validated['base_color'],
            'accent_color' => $validated['accent_color'],

            'logo_url' => $logoPath,
            'cover_url' => $coverPath,
        ]);

        // Create mandatory registration fields
        $event->registrationFields()->createMany([
            [
                'label' => 'Full Name',
                'type' => 'text',
                'is_required' => true,
                'options' => [],
                'is_mandatory' => true
            ],
            [
                'label' => 'Email',
                'type' => 'text',
                'is_required' => true,
                'options' => [],
                'is_mandatory' => true
            ],
        ]);

        return redirect()
            ->route('dashboard.event')
            ->with('success', 'Event created successfully.');
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:45'],
            'description' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:45', 'unique:events,slug,' . $event->id],
            'registration_start' => ['required', 'date'],
            'registration_end' => ['required', 'date'],
            'status' => ['nullable', 'string', 'in:Draft,Published,Ongoing,Completed'],
            'base_color' => ['required', 'string'],
            'accent_color' => ['required', 'string'],
            'logo_url' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            'cover_url' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120']
        ]);

        // Handle logo upload
        if ($request->hasFile('logo_url')) {
            // Delete old logo if exists
            if ($event->logo_url) {
                Storage::disk('public')->delete($event->logo_url);
            }
            // Store new logo
            $validated['logo_url'] = $request->file('logo_url')->store('logos', 'public');
        }

        // Handle cover upload
        if ($request->hasFile('cover_url')) {
            // Delete old cover if exists
            if ($event->cover_url) {
                Storage::disk('public')->delete($event->cover_url);
            }
            // Store new cover
            $validated['cover_url'] = $request->file('cover_url')->store('covers', 'public');
        }

        // Update the event
        $event->fill([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => $validated['slug'],
            'registration_start' => $validated['registration_start'],
            'registration_end' => $validated['registration_end'],
            'status' => $validated['status'] ?? 'Draft',
            'base_color' => $validated['base_color'],
            'accent_color' => $validated['accent_color'],
            'logo_url' => $validated['logo_url'] ?? $event->logo_url,
            'cover_url' => $validated['cover_url'] ?? $event->cover_url,
        ]);

        $event->save();

        return redirect()
            ->route('dashboard.event.details', $event->slug)
            ->with('success', 'Event updated successfully.');
    }
}
