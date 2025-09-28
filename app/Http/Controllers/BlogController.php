<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
            
            // When searching, don't separate featured from regular blogs
            $blogs = $query->recent()->paginate(12);
            $featuredBlogs = collect(); // Empty collection for search results
        } else {
            // Get all blogs ordered by: featured first (by views/likes), then by recent
            $blogs = $query->orderByDesc('views_count')
                          ->orderByDesc('likes_count') 
                          ->orderByDesc('published_at')
                          ->paginate(12);
            $featuredBlogs = collect(); // No separate featured section
        }

        return view('blog.index', compact('blogs', 'featuredBlogs'));
    }

    /**
     * Display the specified blog post
     */
    public function show($locale, Blog $blog)
    {
        // $locale is provided by the route prefix; we keep it if needed for further logic
        // Route model binding will resolve the Blog by slug (route uses {blog:slug})
        // Ensure the blog is published
        if (! $blog->is_published || $blog->published_at > now()) {
            abort(404);
        }

        $request = request();

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
    public function react(Request $request, $locale, Blog $blog)
    {
        try {
            $request->validate([
                'type' => 'required|in:like,dislike',
            ]);

            $ipAddress = $request->ip();
            $type = $request->get('type');
            $message = '';

            // Check if user already reacted
            $existingReaction = $blog->getReactionByIp($ipAddress);

            if ($existingReaction) {
                if ($existingReaction->type === $type) {
                    // Remove reaction if clicking the same type
                    $result = $blog->removeReaction($ipAddress);
                    $message = $result ? 'Reaction removed' : 'Failed to remove reaction';
                } else {
                    // Change reaction type
                    $removeResult = $blog->removeReaction($ipAddress);
                    if ($removeResult) {
                        $addResult = $blog->addReaction($type, $ipAddress);
                        $message = $addResult ? 'Reaction updated' : 'Failed to update reaction';
                    } else {
                        $message = 'Failed to change reaction';
                    }
                }
            } else {
                // Add new reaction
                $result = $blog->addReaction($type, $ipAddress);
                $message = $result ? 'Reaction added' : 'Failed to add reaction';
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

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Blog reaction error: ' . $e->getMessage(), [
                'blog_id' => $blog->id,
                'ip_address' => $request->ip(),
                'type' => $request->get('type'),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing your reaction. Please try again.',
                ], 500);
            }

            return redirect()->back()->with('error', 'An error occurred while processing your reaction.');
        }
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
