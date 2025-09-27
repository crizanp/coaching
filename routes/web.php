<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;

// Redirect root to French
Route::get('/', function () {
    return redirect('/fr');
});

// Language routes
Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->middleware('set.locale')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
});

// Language switching route helper
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'en'])) {
        $currentUrl = url()->previous();
        $currentLocale = app()->getLocale();
        
        // Replace current locale with new locale in URL
        $newUrl = str_replace("/{$currentLocale}", "/{$locale}", $currentUrl);
        
        // If URL doesn't contain locale, add it
        if (!str_contains($newUrl, "/{$locale}")) {
            $newUrl = url("/{$locale}");
        }
        
        return redirect($newUrl);
    }
    return redirect()->back();
})->name('lang.switch');

// Include admin routes
require __DIR__.'/admin.php';

// Auth routes
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
