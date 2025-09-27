<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index($locale)
    {
        $services = Service::active()->featured()->orderBy('sort_order')->get();
        $testimonials = Testimonial::active()->featured()->with('service')->latest()->take(3)->get();
        
        $siteSettings = [
            'name' => Setting::get('site_name'),
            'tagline' => Setting::get('site_tagline'),
        ];

        return view('home', compact('services', 'testimonials', 'siteSettings'));
    }
}
