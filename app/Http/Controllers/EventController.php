<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function create(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:45'],
            'description' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:45', 'unique:events,slug'],
            'registration_start' => ['required', 'date'],
            'registration_end' => ['required', 'date'],
            'status' => ['nullable', 'string', 'in:draft,published,ongoing,completed'],
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

            'status' => $validated['status'] ?? 'draft',

            'base_color' => $validated['base_color'],
            'accent_color' => $validated['accent_color'],

            'logo_url' => $logoPath,
            'cover_url' => $coverPath,
        ]);

        return redirect()
            ->route('dashboard.event')
            ->with('success', 'Event created successfully.');
    }
}
