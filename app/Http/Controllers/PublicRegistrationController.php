<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class PublicRegistrationController extends Controller
{
    public function show($slug) {
        $event = Event::with('registrationFields')->where('slug', $slug)->firstOrFail();

        return view('public.landing', compact('event'));
    }

    public function register($slug) {
        $event = Event::with('registrationFields')->where('slug', $slug)->firstOrFail();

        return view('public.registration', compact('event'));
    }
}
