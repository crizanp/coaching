<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title.fr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'description.fr' => 'required|string',
            'description.en' => 'nullable|string',
            'content.fr' => 'required|string',
            'content.en' => 'nullable|string',
            'type' => 'required|in:workshop,practical,online,hybrid',
            'status' => 'required|in:draft,upcoming,active,completed,cancelled',
            'featured_image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'max_participants' => 'nullable|integer|min:1',
            'event_date' => 'nullable|date|after:now',
            'registration_deadline' => 'nullable|date|before:event_date',
            'location.fr' => 'nullable|string',
            'location.en' => 'nullable|string',
            'requirements.fr' => 'nullable|array',
            'requirements.en' => 'nullable|array',
            'benefits.fr' => 'nullable|array',
            'benefits.en' => 'nullable|array',
            'program.fr' => 'nullable|array',
            'program.en' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'allow_registration' => 'boolean',
            'sort_order' => 'nullable|integer',
            'seo_title.fr' => 'nullable|string|max:255',
            'seo_title.en' => 'nullable|string|max:255',
            'seo_description.fr' => 'nullable|string|max:500',
            'seo_description.en' => 'nullable|string|max:500',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/events'), $filename);
            $validated['featured_image'] = 'events/' . $filename;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']['fr']);

        $event = Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('applications');
        
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title.fr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'description.fr' => 'required|string',
            'description.en' => 'nullable|string',
            'content.fr' => 'required|string',
            'content.en' => 'nullable|string',
            'type' => 'required|in:workshop,practical,online,hybrid',
            'status' => 'required|in:draft,upcoming,active,completed,cancelled',
            'featured_image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'max_participants' => 'nullable|integer|min:1',
            'event_date' => 'nullable|date',
            'registration_deadline' => 'nullable|date|before:event_date',
            'location.fr' => 'nullable|string',
            'location.en' => 'nullable|string',
            'requirements.fr' => 'nullable|array',
            'requirements.en' => 'nullable|array',
            'benefits.fr' => 'nullable|array',
            'benefits.en' => 'nullable|array',
            'program.fr' => 'nullable|array',
            'program.en' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'allow_registration' => 'boolean',
            'sort_order' => 'nullable|integer',
            'seo_title.fr' => 'nullable|string|max:255',
            'seo_title.en' => 'nullable|string|max:255',
            'seo_description.fr' => 'nullable|string|max:500',
            'seo_description.en' => 'nullable|string|max:500',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($event->featured_image && file_exists(public_path('storage/' . $event->featured_image))) {
                unlink(public_path('storage/' . $event->featured_image));
            }

            $image = $request->file('featured_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/events'), $filename);
            $validated['featured_image'] = 'events/' . $filename;
        }

        // Update slug if title changed
        if ($event->getTranslation('title', 'fr') !== $validated['title']['fr']) {
            $validated['slug'] = Str::slug($validated['title']['fr']);
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Delete featured image if exists
        if ($event->featured_image && file_exists(public_path('storage/' . $event->featured_image))) {
            unlink(public_path('storage/' . $event->featured_image));
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    /**
     * Toggle event status (active/inactive)
     */
    public function toggleStatus(Event $event)
    {
        $event->update(['is_active' => !$event->is_active]);

        $status = $event->is_active ? 'activated' : 'deactivated';
        
        return redirect()
            ->back()
            ->with('success', "Event {$status} successfully.");
    }

    /**
     * Duplicate an event
     */
    public function duplicate(Event $event)
    {
        $newEvent = $event->replicate();
        
        // Update title with (Copy) suffix for both languages
        $titleFr = $event->getLocalizedTranslation('title', 'fr') . ' (Copy)';
        $titleEn = $event->getLocalizedTranslation('title', 'en') . ' (Copy)';
        
        $newEvent->setTranslation('title', 'fr', $titleFr);
        $newEvent->setTranslation('title', 'en', $titleEn);
        
        // Generate new slug based on French title
        $newEvent->slug = Str::slug($titleFr);
        $newEvent->status = 'upcoming';
        $newEvent->current_participants = 0;
        $newEvent->save();

        return redirect()
            ->route('admin.events.edit', $newEvent)
            ->with('success', 'Event duplicated successfully. You can now edit the copy.');
    }
}
