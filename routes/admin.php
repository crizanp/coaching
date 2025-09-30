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