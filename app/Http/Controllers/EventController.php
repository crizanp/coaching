<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventApplication;

class EventController extends Controller
{
    public function index($locale)
    {
        // Get practical information events (active)
        $practicalEvents = Event::active()
            ->practical()
            ->activeStatus()
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get upcoming workshop events
        $upcomingWorkshops = Event::active()
            ->workshop()
            ->upcoming()
            ->where('event_date', '>', now())
            ->orderBy('event_date')
            ->get();

        // Get active/ongoing workshop events
        $activeWorkshops = Event::active()
            ->workshop()
            ->activeStatus()
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('events.index', compact('practicalEvents', 'upcomingWorkshops', 'activeWorkshops'));
    }

    public function show($locale, Event $event)
    {
        if (!$event->is_active) {
            abort(404);
        }
        
        return view('events.show', compact('event'));
    }

    public function apply($locale, Event $event)
    {
        if (!$event->can_register) {
            return redirect()->route('events.show', ['locale' => $locale, 'event' => $event])
                ->with('error', __('messages.events.registration_closed'));
        }

        return view('events.apply', compact('event'));
    }

    public function storeApplication($locale, Request $request, Event $event)
    {
        if (!$event->can_register) {
            return redirect()->route('events.show', ['locale' => $locale, 'event' => $event])
                ->with('error', __('messages.events.registration_closed'));
        }

        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'applicant_phone' => 'nullable|string|max:50',
            'applicant_age' => 'nullable|string|max:10',
            'motivation' => 'nullable|string|max:1000',
            'special_requirements' => 'nullable|string|max:500',
        ]);

        // Check if user already applied
        $existingApplication = EventApplication::where('event_id', $event->id)
            ->where('email', $validated['applicant_email'])
            ->first();

        if ($existingApplication) {
            return redirect()->back()
                ->with('error', __('messages.events.already_applied'));
        }

        $messageSegments = [];

        if (!empty($validated['applicant_age'])) {
            $messageSegments[] = 'Age: ' . $validated['applicant_age'];
        }

        if (!empty($validated['motivation'])) {
            $messageSegments[] = "Motivation:\n" . $validated['motivation'];
        }

        if (!empty($validated['special_requirements'])) {
            $messageSegments[] = "Special Requirements:\n" . $validated['special_requirements'];
        }

        $application = EventApplication::create([
            'event_id' => $event->id,
            'name' => $validated['applicant_name'],
            'email' => $validated['applicant_email'],
            'phone' => $validated['applicant_phone'] ?: null,
            'message' => $messageSegments ? implode("\n\n", $messageSegments) : null,
            'ip_address' => $request->ip(),
            'status' => 'pending',
        ]);

        // Update participant count if auto-approved
        if ($event->max_participants && $application->status === 'confirmed') {
            $event->increment('current_participants');
        }

        // Here you would typically send confirmation emails
        
        return redirect()->route('events.show', ['locale' => $locale, 'event' => $event])
            ->with('success', __('messages.events.application_success'));
    }
}
