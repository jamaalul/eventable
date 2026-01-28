<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Support\Str;

class PublicRegistrationController extends Controller
{
    public function show($slug) {
        $event = Event::with('registrationFields')->where('slug', $slug)->firstOrFail();

        return view('public.landing', compact('event'));
    }

    public function showRegister($slug) {
        $event = Event::with('registrationFields')->where('slug', $slug)->firstOrFail();

        return view('public.registration', compact('event'));
    }

    public function store(Request $request, $slug) {
        $event = Event::with('registrationFields')->where('slug', $slug)->firstOrFail();

        $rules = [];
        foreach ($event->registrationFields as $field) {
            $fieldName = "field_{$field->id}";
            $fieldRules = [];

            if ($field->is_required || $field->is_mandatory) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            if ($field->type === 'email') {
                $fieldRules[] = 'email';
            }

            if ($field->type === 'checkbox') {
                $fieldRules[] = 'array';
            }

            $rules[$fieldName] = $fieldRules;
        }

        $validated = $request->validate($rules);

        // Extract mandatory fields for Attendee record
        $fullNameField = $event->registrationFields->where('label', 'Full Name')->first();
        $emailField = $event->registrationFields->where('label', 'Email')->first();

        $fullName = $validated["field_{$fullNameField->id}"] ?? '';
        $email = $validated["field_{$emailField->id}"] ?? '';

        $attendeeCode = strtoupper(Str::random(8));

        $attendee = Attendee::create([
            'event_id' => $event->id,
            'full_name' => $fullName,
            'email' => $email,
            'attendee_code' => $attendeeCode,
            'qr_code' => $attendeeCode, // For now using the code as QR content
        ]);

        foreach ($event->registrationFields as $field) {
            $value = $validated["field_{$field->id}"] ?? null;

            if (is_array($value)) {
                $value = json_encode($value);
            }

            $attendee->attendeeResponse()->create([
                'registration_field_id' => $field->id,
                'value' => (string)$value,
            ]);
        }

        return redirect()->route('public.event.success', $event->slug);
    }

    public function showSuccess($slug) {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('public.success', compact('event'));
    }
}
