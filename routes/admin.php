<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogGiftRequestController;

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Services management
    Route::resource('services', ServiceController::class);
    
    // Events management  
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::patch('events/{event}/toggle-status', [\App\Http\Controllers\Admin\EventController::class, 'toggleStatus'])->name('events.toggle-status');
    Route::post('events/{event}/duplicate', [\App\Http\Controllers\Admin\EventController::class, 'duplicate'])->name('events.duplicate');
    
    // Event Applications management
    Route::resource('event-applications', \App\Http\Controllers\Admin\EventApplicationController::class)->only(['index', 'show', 'destroy']);
    Route::patch('event-applications/{eventApplication}/update-status', [\App\Http\Controllers\Admin\EventApplicationController::class, 'updateStatus'])->name('event-applications.update-status');
    Route::patch('event-applications/{eventApplication}/update-notes', [\App\Http\Controllers\Admin\EventApplicationController::class, 'updateNotes'])->name('event-applications.update-notes');
    Route::post('event-applications/{eventApplication}/send-confirmation', [\App\Http\Controllers\Admin\EventApplicationController::class, 'sendConfirmation'])->name('event-applications.send-confirmation');
    Route::post('event-applications/bulk-action', [\App\Http\Controllers\Admin\EventApplicationController::class, 'bulkAction'])->name('event-applications.bulk-action');
    
    // Appointments management
    Route::resource('appointments', AppointmentController::class);
    Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
    
    // Blog management
    Route::resource('blogs', BlogController::class);
    Route::patch('blogs/{blog}/toggle-publish', [BlogController::class, 'togglePublish'])->name('blogs.toggle-publish');
    
    // Blog Gift Requests management
    Route::resource('blog-gift-requests', BlogGiftRequestController::class)->only(['index', 'show', 'update', 'destroy']);
    
    // Contact Messages
    Route::get('contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');

    // Settings
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    // Password Change
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [AdminController::class, 'updatePassword'])->name('update-password');
});