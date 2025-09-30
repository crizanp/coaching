<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\GuideDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuideController extends Controller
{
    public function index()
    {
        return view('guide.index');
    }

    public function download(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'guide_slug' => 'required|string|exists:guides,slug',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $ip = $request->ip();
        $guideSlug = $request->guide_slug;

        // Check if IP has already requested this specific guide recently
        if (GuideDownload::hasRecentRequest($ip, $guideSlug, 24)) {
            return response()->json([
                'success' => false,
                'message' => __('You have already requested this guide recently. Please check your email or try again later.')
            ], 429);
        }

        // Get the guide details
        $guide = Guide::where('slug', $guideSlug)->where('is_active', true)->first();
        
        if (!$guide) {
            return response()->json([
                'success' => false,
                'message' => __('Guide not found or not available.')
            ], 404);
        }

        // Create the download request
        $download = GuideDownload::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'ip_address' => $ip,
            'guide_slug' => $guideSlug,
            'guide_title' => $guide->title,
            'guide_description' => $guide->description,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => __('Thank you! Your request has been submitted. You will receive the guide by email within 24 hours after review.')
        ]);
    }

    public function getGuides()
    {
        // Ensure locale is set (get from URL or default to 'en')
        $locale = request()->segment(1);
        if (in_array($locale, ['en', 'fr'])) {
            app()->setLocale($locale);
        } else {
            app()->setLocale('en');
        }
        
        // Get active guides from database
        $guides = Guide::active()->ordered()->get()->map(function ($guide) {
            return [
                'id' => $guide->slug,
                'title' => $guide->title,
                'description' => $guide->description,
                'icon' => $guide->icon,
                'benefits' => $guide->benefits
            ];
        });

        return response()->json($guides);
    }
}
