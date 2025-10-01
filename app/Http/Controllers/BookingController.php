<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;

class BookingController extends Controller
{
    public function index($locale)
    {
        $services = Service::active()->orderBy('sort_order')->get();
        return view('booking.index', compact('services'));
    }

    public function store($locale, Request $request)
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

        $clientIp = $request->ip();
        
        // Check if there's already a pending or confirmed appointment from this IP for the same service
        if (Appointment::hasDuplicateFromIp($request->service_id, $clientIp)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => __('messages.booking.duplicate_ip_error')]);
        }

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
            'ip_address' => $clientIp,
        ]);

        return redirect()->back()->with('success', __('messages.booking.success'));
    }

    public function locationBooking($locale, $location)
    {
        $services = Service::active()->orderBy('sort_order')->get();
        
        // Define location data
        $locationData = $this->getLocationData($location);
        
        if (!$locationData) {
            abort(404);
        }
        
        return view('booking.location', compact('services', 'location', 'locationData'));
    }

    public function storeLocationBooking($locale, $location, Request $request)
    {
        $locationData = $this->getLocationData($location);
        
        if (!$locationData) {
            abort(404);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'nullable|string|max:50',
            'appointment_datetime' => 'required|date|after:now',
            'message' => 'nullable|string|max:1000',
            'is_first_session' => 'boolean',
        ]);

        $clientIp = $request->ip();
        
        // Check if there's already a pending or confirmed appointment from this IP for the same service
        if (Appointment::hasDuplicateFromIp($request->service_id, $clientIp)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => __('messages.booking.duplicate_ip_error')]);
        }

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
            'ip_address' => $clientIp,
            'location' => $location,
        ]);

        return redirect()->back()->with('success', __('messages.booking.success'));
    }

    private function getLocationData($location)
    {
        $locations = [
            'fort-de-france' => [
                'name' => 'Fort-de-France',
                'display_name' => 'Fort-de-France',
                'calendly_url' => 'https://calendly.com/your-calendly-username/fort-de-france-consultation',
                'address' => 'Centre-ville de Fort-de-France, Martinique',
                'description' => 'Consultations à Fort-de-France'
            ],
            'riviere-salee' => [
                'name' => 'Rivière Salée',
                'display_name' => 'Rivière Salée',
                'calendly_url' => 'https://calendly.com/your-calendly-username/riviere-salee-consultation',
                'address' => 'Cabinet à Rivière Salée, Martinique',
                'description' => 'Consultations à Rivière Salée'
            ]
        ];

        return $locations[$location] ?? null;
    }
}
