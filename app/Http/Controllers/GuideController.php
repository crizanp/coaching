<?php

namespace App\Http\Controllers;

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
            'guide_title' => 'required|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $ip = $request->ip();
        $guideTitle = $request->guide_title;

        // Check if IP has already requested this guide recently
        if (GuideDownload::hasRecentRequest($ip, $guideTitle, 24)) {
            return response()->json([
                'success' => false,
                'message' => __('You have already requested this guide recently. Please check your email or try again later.')
            ], 429);
        }

        // Create the download request
        $download = GuideDownload::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'ip_address' => $ip,
            'guide_title' => $guideTitle,
            'guide_description' => $this->getGuideDescription($guideTitle),
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => __('Thank you! Your request has been submitted. You will receive the guide by email within 24 hours after review.')
        ]);
    }

    private function getGuideDescription($title)
    {
        // Define available guides and their descriptions
        $guides = [
            'sophrology-stress-relief' => 'A comprehensive guide with 5 effective breathing exercises to manage daily stress and anxiety.',
            'beginner-sophrology' => 'Your complete introduction to sophrology: principles, basic techniques, and daily practice.',
            'nlp-confidence-boost' => 'Practical NLP techniques to build unshakeable self-confidence and overcome limiting beliefs.',
            'hypnosis-sleep-better' => 'Gentle self-hypnosis techniques for better sleep and relaxation.',
            'emotional-balance' => 'Tools and exercises to understand, manage, and balance your emotions effectively.'
        ];

        return $guides[$title] ?? 'Exclusive guide with practical exercises and insights for your personal development.';
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
        
        // Return available guides for the frontend
        $guides = [
            [
                'id' => 'sophrology-stress-relief',
                'title' => __('messages.guides.sophrology_stress.title'),
                'description' => __('messages.guides.sophrology_stress.description'),
                'icon' => 'fa-lungs',
                'benefits' => [
                    __('messages.guides.sophrology_stress.benefit1'),
                    __('messages.guides.sophrology_stress.benefit2'),
                    __('messages.guides.sophrology_stress.benefit3'),
                    __('messages.guides.sophrology_stress.benefit4')
                ]
            ],
            [
                'id' => 'beginner-sophrology',
                'title' => __('messages.guides.beginner_sophrology.title'),
                'description' => __('messages.guides.beginner_sophrology.description'),
                'icon' => 'fa-seedling',
                'benefits' => [
                    __('messages.guides.beginner_sophrology.benefit1'),
                    __('messages.guides.beginner_sophrology.benefit2'),
                    __('messages.guides.beginner_sophrology.benefit3'),
                    __('messages.guides.beginner_sophrology.benefit4')
                ]
            ],
            [
                'id' => 'nlp-confidence-boost',
                'title' => __('messages.guides.nlp_confidence.title'),
                'description' => __('messages.guides.nlp_confidence.description'),
                'icon' => 'fa-brain',
                'benefits' => [
                    __('messages.guides.nlp_confidence.benefit1'),
                    __('messages.guides.nlp_confidence.benefit2'),
                    __('messages.guides.nlp_confidence.benefit3'),
                    __('messages.guides.nlp_confidence.benefit4')
                ]
            ]
        ];

        return response()->json($guides);
    }
}
