<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('sort_order')->get();
        return view('contact.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service_id' => 'nullable|exists:services,id',
            'message' => 'required|string|max:1000',
        ]);

        // Here you would typically send an email
        // For now, we'll just redirect with success message
        
        return redirect()->back()->with('success', __('messages.contact.success'));
    }
}
