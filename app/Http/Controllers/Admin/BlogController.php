<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->get('status') === 'published') {
                $query->where('is_published', true);
            } elseif ($request->get('status') === 'draft') {
                $query->where('is_published', false);
            }
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|file|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Ensure slug is unique
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Blog::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                $validated['featured_image'] = $request->file('featured_image')->store('blog-images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['featured_image' => 'Failed to upload image. Please try again.']);
            }
        }

        // Convert meta keywords to array
        if (!empty($validated['meta_keywords'])) {
            $validated['meta_keywords'] = array_map('trim', explode(',', $validated['meta_keywords']));
        }

        // Set published_at if publishing
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blog = Blog::create($validated);

        return redirect()->route('admin.blogs.index')
                        ->with('success', 'Blog post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blogs')->ignore($blog->id)],
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|file|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Ensure slug is unique (excluding current blog)
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Blog::where('slug', $validated['slug'])->where('id', '!=', $blog->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                // Delete old image
                if ($blog->featured_image) {
                    Storage::disk('public')->delete($blog->featured_image);
                }
                $validated['featured_image'] = $request->file('featured_image')->store('blog-images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['featured_image' => 'Failed to upload image. Please try again.']);
            }
        }

        // Convert meta keywords to array
        if (!empty($validated['meta_keywords'])) {
            $validated['meta_keywords'] = array_map('trim', explode(',', $validated['meta_keywords']));
        }

        // Set published_at if publishing for the first time
        if ($validated['is_published'] && !$blog->is_published && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
                        ->with('success', 'Blog post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
                        ->with('success', 'Blog post deleted successfully!');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(Blog $blog)
    {
        $blog->update([
            'is_published' => !$blog->is_published,
            'published_at' => !$blog->is_published ? now() : $blog->published_at,
        ]);

        $status = $blog->is_published ? 'published' : 'unpublished';
        
        return redirect()->back()
                        ->with('success', "Blog post {$status} successfully!");
    }
}
