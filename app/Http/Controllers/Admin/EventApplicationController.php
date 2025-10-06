<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventApplication;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $applicationsQuery = EventApplication::with(['event']);
        $metricsBaseQuery = EventApplication::query();

        // Filter by event
        if ($request->filled('event')) {
            $applicationsQuery->where('event_id', $request->event);
            $metricsBaseQuery->where('event_id', $request->event);
        }

        // Search by participant name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $searchCallback = function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            };

            $applicationsQuery->where($searchCallback);
            $metricsBaseQuery->where($searchCallback);
        }

        // Date filter (from)
        if ($request->filled('date_from')) {
            $dateFrom = \Carbon\Carbon::parse($request->date_from)->startOfDay();
            $applicationsQuery->where('created_at', '>=', $dateFrom);
            $metricsBaseQuery->where('created_at', '>=', $dateFrom);
        }

        // Date filter (to)
        if ($request->filled('date_to')) {
            $dateTo = \Carbon\Carbon::parse($request->date_to)->endOfDay();
            $applicationsQuery->where('created_at', '<=', $dateTo);
            $metricsBaseQuery->where('created_at', '<=', $dateTo);
        }

        // Filter by status for listing only
        if ($request->filled('status')) {
            $applicationsQuery->where('status', $request->status);
        }

        $applications = $applicationsQuery
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

    $confirmedCount = (clone $metricsBaseQuery)->where('status', 'confirmed')->count();
    $pendingCount = (clone $metricsBaseQuery)->where('status', 'pending')->count();
    $cancelledCount = (clone $metricsBaseQuery)->where('status', 'cancelled')->count();
    $waitlistCount = (clone $metricsBaseQuery)->where('status', 'waitlist')->count();

        $events = Event::active()->orderBy('title->fr')->get();

        return view('admin.event-applications.index', compact(
            'applications',
            'events',
            'confirmedCount',
            'pendingCount',
            'cancelledCount',
            'waitlistCount'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(EventApplication $eventApplication)
    {
        $eventApplication->load('event');

        return view('admin.event-applications.show', [
            'application' => $eventApplication,
            'eventApplication' => $eventApplication,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventApplication $eventApplication)
    {
        $eventApplication->delete();

        return redirect()
            ->route('admin.event-applications.index')
            ->with('success', 'Event application deleted successfully.');
    }

    /**
     * Update application status
     */
    public function updateStatus(Request $request, EventApplication $eventApplication)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,waitlist',
        ]);

        $oldStatus = $eventApplication->status;
        $eventApplication->update($validated);

        // Update event participant count if status changed
        if ($oldStatus !== $validated['status']) {
            $event = $eventApplication->event;
            
            if ($oldStatus === 'confirmed' && $validated['status'] !== 'confirmed') {
                // Remove from count
                $event->decrement('current_participants');
            } elseif ($oldStatus !== 'confirmed' && $validated['status'] === 'confirmed') {
                // Add to count
                $event->increment('current_participants');
            }
        }

        // Send appropriate email based on new status
        if ($oldStatus !== $validated['status']) {
            $this->sendConfirmationEmail($eventApplication, $validated['status']);
        }

        return redirect()
            ->back()
            ->with('success', 'Application status updated successfully.');
    }

    /**
     * Bulk action on applications
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:confirm,cancel,waitlist,delete',
            'applications' => 'required|array',
            'applications.*' => 'exists:event_applications,id',
        ]);

        $applications = EventApplication::whereIn('id', $validated['applications'])->get();

        foreach ($applications as $application) {
            switch ($validated['action']) {
                case 'confirm':
                    if ($application->status !== 'confirmed') {
                        $application->update(['status' => 'confirmed']);
                        $application->event->increment('current_participants');
                        $this->sendConfirmationEmail($application, 'confirmed');
                    }
                    break;
                    
                case 'cancel':
                    if ($application->status === 'confirmed') {
                        optional($application->event)->decrement('current_participants');
                    }
                    $application->update(['status' => 'cancelled']);
                    $this->sendConfirmationEmail($application, 'cancelled');
                    break;

                case 'waitlist':
                    if ($application->status === 'confirmed') {
                        optional($application->event)->decrement('current_participants');
                    }
                    $application->update(['status' => 'waitlist']);
                    $this->sendConfirmationEmail($application, 'waitlist');
                    break;
                    
                case 'delete':
                    if ($application->status === 'confirmed') {
                        optional($application->event)->decrement('current_participants');
                    }
                    $application->delete();
                    break;
            }
        }

        $count = count($applications);
        $actionText = match($validated['action']) {
            'confirm' => 'confirmed',
            'cancel' => 'cancelled',
            'waitlist' => 'moved to waitlist',
            'delete' => 'deleted',
        };

        return redirect()
            ->back()
            ->with('success', "{$count} applications {$actionText} successfully.");
    }

    /**
     * Send confirmation email to participant
     */
    private function sendConfirmationEmail(EventApplication $application, $type = 'confirmed')
    {
        try {
            Mail::to($application->email, $application->name)
                ->send(new \App\Mail\EventConfirmation($application, $type));
        } catch (\Exception $e) {
            \Log::error('Failed to send event confirmation email: ' . $e->getMessage());
        }
    }
    
    /**
     * Send confirmation email manually
     */
    public function sendConfirmation(EventApplication $application)
    {
        $this->sendConfirmationEmail($application, $application->status);
        
        return redirect()
            ->back()
            ->with('success', 'Confirmation email sent successfully.');
    }
    
    /**
     * Update application notes
     */
    public function updateNotes(Request $request, EventApplication $application)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $application->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Notes updated successfully.');
    }
}
