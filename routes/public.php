<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicRegistrationController;

Route::get('/{slug}', [PublicRegistrationController::class, 'show'])->name('oublic.event');
Route::get('/{slug}/register', [PublicRegistrationController::class, 'showRegister'])->name('public.event.register');
Route::post('/{slug}/register', [PublicRegistrationController::class, 'store'])->name('public.event.register.store');
Route::get('/{slug}/success', [PublicRegistrationController::class, 'showSuccess'])->name('public.event.success');
