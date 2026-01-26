<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\RegistrationField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRegistrationFieldController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if ($request->has('options_json')) {
            $request->merge([
                'options' => json_decode($request->input('options_json'), true)
            ]);
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:text,number,textarea,select,radio,checkbox',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string',
            'is_required' => 'sometimes',
        ]);

        $event->registrationFields()->create([
            'label' => $validated['label'],
            'type' => $validated['type'],
            'options' => array_filter($validated['options'] ?? []),
            'is_required' => $request->boolean('is_required'),
            'is_mandatory' => false
        ]);

        return back()->with('success', 'Field created successfully.');
    }

    public function destroy(Event $event, RegistrationField $field)
    {
        // Ensure the field belongs to this event
        if ($field->event_id !== $event->id) {
            abort(403, 'This field does not belong to this event.');
        }

        // Don't allow deletion of mandatory fields
        if ($field->is_mandatory) {
            return back()->withErrors(['error' => 'Cannot delete mandatory fields.']);
        }

        $field->delete();

        return back()->with('success', 'Field deleted successfully.');
    }
    public function update(Request $request, Event $event, RegistrationField $field)
    {
        // Ensure the field belongs to this event
        if ($field->event_id !== $event->id) {
            abort(403, 'This field does not belong to this event.');
        }

        // Don't allow editing mandatory fields if needed, but usually we allow label changes etc.
        // For now, let's follow the same logic as destroy for mandatory check if you want to be strict.
        if ($field->is_mandatory) {
             return back()->withErrors(['error' => 'Cannot edit mandatory fields.']);
        }

        if ($request->has('options_json')) {
            $request->merge([
                'options' => json_decode($request->input('options_json'), true)
            ]);
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:text,number,textarea,select,radio,checkbox',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string',
            'is_required' => 'sometimes',
        ]);

        $field->update([
            'label' => $validated['label'],
            'type' => $validated['type'],
            'options' => array_filter($validated['options'] ?? []),
            'is_required' => $request->boolean('is_required'),
        ]);

        return back()->with('success', 'Field updated successfully.');
    }

}
