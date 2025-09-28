<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    /**
     * Display a listing of published blog posts
     */
    public function index(Request $request)
    {
        $query = Blog::published();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->recent()->paginate(9);
        $featuredBlogs = Cache::remember('featured_blogs', 3600, function () {
            return Blog::published()
                      ->orderBy('views_count', 'desc')
                      ->orderBy('likes_count', 'desc')
                      ->limit(3)
                      ->get();
        });

        return view('blog.index', compact('blogs', 'featuredBlogs'));
    }

    /**
     * Display the specified blog post
     */
    public function show(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->published()->firstOrFail();
        
        // Increment view count (limit one per session to prevent abuse)
        $viewKey = "blog_viewed_{$blog->id}_" . session()->getId();
        if (!Cache::has($viewKey)) {
            $blog->incrementViews();
            Cache::put($viewKey, true, 3600); // 1 hour
        }

        // Get user's reaction if any
        $userReaction = $blog->getReactionByIp($request->ip());
        
        // Get related posts
        $relatedBlogs = Blog::published()
                           ->where('id', '!=', $blog->id)
                           ->inRandomOrder()
                           ->limit(3)
                           ->get();

        return view('blog.show', compact('blog', 'userReaction', 'relatedBlogs'));
    }

    /**
     * Handle blog post reactions (like/dislike)
     */
    public function react(Request $request, Blog $blog)
    {
        $request->validate([
            'type' => 'required|in:like,dislike',
        ]);

        $ipAddress = $request->ip();
        $type = $request->get('type');

        // Check if user already reacted
        $existingReaction = $blog->getReactionByIp($ipAddress);

        if ($existingReaction) {
            if ($existingReaction->type === $type) {
                // Remove reaction if clicking the same type
                $blog->removeReaction($ipAddress);
                $message = 'Reaction removed';
            } else {
                // Change reaction type
                $blog->removeReaction($ipAddress);
                $blog->addReaction($type, $ipAddress);
                $message = 'Reaction updated';
            }
        } else {
            // Add new reaction
            $blog->addReaction($type, $ipAddress);
            $message = 'Reaction added';
        }

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            $blog->refresh();
            return response()->json([
                'success' => true,
                'message' => $message,
                'likes_count' => $blog->likes_count,
                'dislikes_count' => $blog->dislikes_count,
                'user_reaction' => $blog->getReactionByIp($ipAddress)?->type,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get blog posts for sitemap
     */
    public function sitemap()
    {
        $blogs = Blog::published()
                    ->select('slug', 'updated_at')
                    ->get();

        return response()->view('blog.sitemap', compact('blogs'))
                        ->header('Content-Type', 'text/xml');
    }
}
