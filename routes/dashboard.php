<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.overview');
    })->name('dashboard.overview');

    Route::get('/event', function () {
        return view('dashboard.event');
    })->name('dashboard.event');

    Route::get('/attendees', function () {
        return view('dashboard.overview');
    })->name('dashboard.attendees');
});
