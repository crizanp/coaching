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
            'applicant_phone' => 'nullable|string|max:20',
            'applicant_age' => 'nullable|string|max:10',
            'motivation' => 'nullable|string|max:1000',
            'special_requirements' => 'nullable|string|max:500',
        ]);

        // Check if user already applied
        $existingApplication = EventApplication::where('event_id', $event->id)
            ->where('applicant_email', $validated['applicant_email'])
            ->first();

        if ($existingApplication) {
            return redirect()->back()
                ->with('error', __('messages.events.already_applied'));
        }

        $application = EventApplication::create([
            'event_id' => $event->id,
            'applicant_name' => $validated['applicant_name'],
            'applicant_email' => $validated['applicant_email'],
            'applicant_phone' => $validated['applicant_phone'],
            'applicant_age' => $validated['applicant_age'],
            'motivation' => $validated['motivation'],
            'special_requirements' => $validated['special_requirements'],
        ]);

        // Update participant count if auto-approved
        if ($event->max_participants) {
            $event->increment('current_participants');
        }

        // Here you would typically send confirmation emails
        
        return redirect()->route('events.show', ['locale' => $locale, 'event' => $event])
            ->with('success', __('messages.events.application_success'));
    }
}
