<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Setting;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index($locale)
    {
        $services = Service::active()->orderBy('sort_order')->get();
        return view('contact.index', compact('services'));
    }

    public function store($locale, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service_id' => 'nullable|exists:services,id',
            'message' => 'required|string|max:1000',
        ]);

        // Store contact message in database
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'service_id' => $request->service_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', __('messages.contact.success'));
    }
}
