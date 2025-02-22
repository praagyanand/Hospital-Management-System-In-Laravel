<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('doctors', DoctorController::class);
});

// Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');