<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('sort_order')->get();
        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        if (!$service->is_active) {
            abort(404);
        }
        
        $testimonials = $service->testimonials()->active()->latest()->take(3)->get();
        
        return view('services.show', compact('service', 'testimonials'));
    }
}
