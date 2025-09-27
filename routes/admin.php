<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AppointmentController;

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Services management
    Route::resource('services', ServiceController::class);
    
    // Appointments management
    Route::resource('appointments', AppointmentController::class);
    Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
    
    // Settings
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    // Password Change
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [AdminController::class, 'updatePassword'])->name('update-password');
});