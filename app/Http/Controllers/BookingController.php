<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;

class BookingController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('sort_order')->get();
        return view('booking.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'nullable|string|max:50',
            'appointment_datetime' => 'required|date|after:now',
            'message' => 'nullable|string|max:1000',
            'is_first_session' => 'boolean',
        ]);

        $appointment = Appointment::create([
            'service_id' => $request->service_id,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'client_phone' => $request->client_phone,
            'appointment_datetime' => $request->appointment_datetime,
            'message' => $request->message,
            'is_first_session' => $request->boolean('is_first_session', true),
            'preferred_language' => app()->getLocale(),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', __('messages.booking.success'));
    }
}
