<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.overview');
    })->name('dashboard.overview');

    Route::get('/event', function () {
        $events = Auth::user()->event()->latest()->get();
        return view('dashboard.event', compact('events'));
    })->name('dashboard.event');

    Route::get('/event/{slug}', function ($slug) {
        $event = Auth::user()->event()->where('slug', $slug)->firstOrFail();
        $fields = $event->registrationFields()->get();
        return view('dashboard.event-details', compact('event', 'fields'));
    })->name('dashboard.event.details');

    Route::get('/attendees', function () {
        return view('dashboard.overview');
    })->name('dashboard.attendees');
});

Route::middleware('auth')->prefix('event')->group(function () {
    Route::post('/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/update/{event:slug}', [EventController::class, 'update'])->name('event.update');
    Route::post('/{event:slug}/fields', [\App\Http\Controllers\EventRegistrationFieldController::class, 'store'])->name('event.fields.store');
    Route::post('/{event:slug}/fields/{field}/update', [\App\Http\Controllers\EventRegistrationFieldController::class, 'update'])->name('event.fields.update');
    Route::delete('/{event:slug}/fields/{field}', [\App\Http\Controllers\EventRegistrationFieldController::class, 'destroy'])->name('event.fields.destroy');
});