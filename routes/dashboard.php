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

    Route::get('/attendees', function () {
        return view('dashboard.overview');
    })->name('dashboard.attendees');
});

Route::middleware('auth')->prefix('event')->group(function () {
    Route::post('/create', [EventController::class, 'create'])->name('event.create');
});