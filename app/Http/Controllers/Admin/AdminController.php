<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\Event;
use App\Models\EventApplication;
use App\Models\Blog;
use App\Models\Guide;
use App\Models\GuideDownload;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'services' => Service::count(),
            'appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'testimonials' => Testimonial::count(),
            'events' => Event::active()->count(),
            'blogs' => Blog::count(),
            'guides' => Guide::count(),
            'guide_downloads' => GuideDownload::count(),
            'total_participants' => EventApplication::where('status', 'confirmed')->count(),
        ];

        $recent_appointments = Appointment::with('service')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recent_event_applications = EventApplication::with('event')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Chart data for the last 7 days
        $chart_data = $this->getChartData();

        return view('admin.dashboard', compact('stats', 'recent_appointments', 'recent_event_applications', 'chart_data'));
    }

    /**
     * Get chart data for dashboard
     */
    private function getChartData()
    {
        $days = [];
        $appointments = [];
        $events = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days[] = $date->format('M d');
            
            $appointments[] = Appointment::whereDate('created_at', $date)->count();
            $events[] = EventApplication::whereDate('created_at', $date)->count();
        }

        return [
            'labels' => $days,
            'appointments' => $appointments,
            'events' => $events,
        ];
    }

    /**
     * Show the settings form.
     */
    public function settings()
    {
        $settings = [
            'site_name' => Setting::get('site_name'),
            'site_tagline' => Setting::get('site_tagline'),
            'contact_email' => Setting::get('contact_email'),
            'contact_phone' => Setting::get('contact_phone'),
            'address' => Setting::get('address'),
            'social_facebook' => Setting::get('social_facebook'),
            'social_instagram' => Setting::get('social_instagram'),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name_fr' => 'required|string|max:255',
            'site_name_en' => 'required|string|max:255',
            'site_tagline_fr' => 'required|string|max:255',
            'site_tagline_en' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'address_fr' => 'nullable|string',
            'address_en' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
        ]);

        // Update settings
        Setting::set('site_name', [
            'fr' => $validated['site_name_fr'],
            'en' => $validated['site_name_en']
        ]);

        Setting::set('site_tagline', [
            'fr' => $validated['site_tagline_fr'],
            'en' => $validated['site_tagline_en']
        ]);

        Setting::set('contact_email', $validated['contact_email']);
        Setting::set('contact_phone', $validated['contact_phone']);

        Setting::set('address', [
            'fr' => $validated['address_fr'],
            'en' => $validated['address_en']
        ]);

        Setting::set('social_facebook', $validated['social_facebook']);
        Setting::set('social_instagram', $validated['social_instagram']);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }

    /**
     * Show the change password form.
     */
    public function changePassword()
    {
        return view('admin.change-password');
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if current password is correct
        if (!Hash::check($validated['current_password'], auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        auth()->user()->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Password updated successfully!');
    }
}
