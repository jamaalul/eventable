<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicRegistrationController;

Route::get('/{slug}', [PublicRegistrationController::class, 'show'])->name('oublic.event');
Route::get('/{slug}/register', [PublicRegistrationController::class, 'register'])->name('public.event.register');
