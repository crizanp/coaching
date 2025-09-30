<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\GuideController;
use Illuminate\Support\Facades\Auth;

// Redirect root to French
Route::get('/', function () {
    return redirect('/fr');
});

// Language routes
Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->middleware('set.locale')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', function() { return view('about'); })->name('about');
    Route::get('/practices', function() { return view('practices'); })->name('practices');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event:slug}/apply', [EventController::class, 'apply'])->name('events.apply');
    Route::post('/events/{event:slug}/apply', [EventController::class, 'storeApplication'])->name('events.store-application');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    // Guide routes
    Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
    Route::get('/api/guides', [GuideController::class, 'getGuides'])->name('guides.list');
    Route::post('/api/guide/download', [GuideController::class, 'download'])->name('guide.download');
    
    // Legal pages
    Route::get('/privacy-policy', function() { return view('privacy-policy'); })->name('privacy-policy');
    Route::get('/terms-conditions', function() { return view('terms-conditions'); })->name('terms-conditions');
    
    // Blog routes
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('/blog/{blog}/react', [BlogController::class, 'react'])->name('blog.react');
    Route::get('/{page:slug}', [PageController::class, 'show'])->where('page', '[^/]+')->name('pages.show');
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

// Auth routes (login only - no registration or password reset)
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

// Redirect /home to admin dashboard after login
Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
});

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/blog-sitemap.xml', [BlogController::class, 'sitemap'])->name('blog.sitemap');
