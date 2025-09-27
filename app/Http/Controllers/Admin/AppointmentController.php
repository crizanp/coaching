<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with('service')
            ->orderBy('appointment_datetime', 'desc')
            ->paginate(20);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('is_active', true)->get();
        return view('admin.appointments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email',
            'service_id' => 'required|exists:services,id',
            'appointment_datetime' => 'required|date|after:now',
            'message' => 'nullable|string',
            'preferred_language' => 'required|in:fr,en',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        Appointment::create($validated);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('service');
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $services = Service::where('is_active', true)->get();
        return view('admin.appointments.edit', compact('appointment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email',
            'service_id' => 'required|exists:services,id',
            'appointment_datetime' => 'required|date',
            'message' => 'nullable|string',
            'preferred_language' => 'required|in:fr,en',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Update the appointment status.
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $appointment->update(['status' => $validated['status']]);

        return redirect()->back()
            ->with('success', 'Appointment status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully!');
    }
}
