<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\GuideDownloadController;

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
    
    // Guides management
    Route::resource('guides', GuideController::class);
    Route::patch('guides/{guide}/toggle-status', [GuideController::class, 'toggleStatus'])->name('guides.toggle-status');
    
    // Guide Downloads management
    Route::resource('guide-downloads', GuideDownloadController::class)->only(['index', 'show', 'destroy']);
    Route::post('guide-downloads/{guideDownload}/approve', [GuideDownloadController::class, 'approve'])->name('guide-downloads.approve');
    Route::post('guide-downloads/{guideDownload}/reject', [GuideDownloadController::class, 'reject'])->name('guide-downloads.reject');
    Route::post('guide-downloads/{guideDownload}/send', [GuideDownloadController::class, 'sendGuide'])->name('guide-downloads.send');
    Route::post('guide-downloads/bulk-action', [GuideDownloadController::class, 'bulkAction'])->name('guide-downloads.bulk-action');
    
    // Settings
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    // Password Change
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [AdminController::class, 'updatePassword'])->name('update-password');
});