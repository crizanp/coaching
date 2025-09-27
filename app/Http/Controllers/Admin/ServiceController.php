<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'content_fr' => 'nullable|string',
            'content_en' => 'nullable|string',
            'benefits_fr' => 'nullable|array',
            'benefits_en' => 'nullable|array',
            'session_format_fr' => 'nullable|array',
            'session_format_en' => 'nullable|array',
            'price_individual' => 'nullable|numeric|min:0',
            'price_group' => 'nullable|numeric|min:0',
            'duration' => 'nullable|integer|min:1',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Generate slug from French name
        $slug = Str::slug($validated['name_fr']);
        
        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        Service::create([
            'name' => [
                'fr' => $validated['name_fr'],
                'en' => $validated['name_en']
            ],
            'description' => [
                'fr' => $validated['description_fr'],
                'en' => $validated['description_en']
            ],
            'content' => [
                'fr' => $validated['content_fr'] ?? '',
                'en' => $validated['content_en'] ?? ''
            ],
            'benefits' => [
                'fr' => $validated['benefits_fr'] ?? [],
                'en' => $validated['benefits_en'] ?? []
            ],
            'session_format' => [
                'fr' => $validated['session_format_fr'] ?? [],
                'en' => $validated['session_format_en'] ?? []
            ],
            'slug' => $slug,
            'price_individual' => $validated['price_individual'],
            'price_group' => $validated['price_group'],
            'duration' => $validated['duration'],
            'icon' => $validated['icon'] ?? 'heart',
            'is_active' => $validated['is_active'] ?? false,
            'is_featured' => $validated['is_featured'] ?? false,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string', 
            'content_fr' => 'nullable|string',
            'content_en' => 'nullable|string',
            'benefits_fr' => 'nullable|array',
            'benefits_en' => 'nullable|array',
            'session_format_fr' => 'nullable|array',
            'session_format_en' => 'nullable|array',
            'price_individual' => 'nullable|numeric|min:0',
            'price_group' => 'nullable|numeric|min:0',
            'duration' => 'nullable|integer|min:1',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $service->update([
            'name' => [
                'fr' => $validated['name_fr'],
                'en' => $validated['name_en']
            ],
            'description' => [
                'fr' => $validated['description_fr'],
                'en' => $validated['description_en']
            ],
            'content' => [
                'fr' => $validated['content_fr'] ?? '',
                'en' => $validated['content_en'] ?? ''
            ],
            'benefits' => [
                'fr' => $validated['benefits_fr'] ?? [],
                'en' => $validated['benefits_en'] ?? []
            ],
            'session_format' => [
                'fr' => $validated['session_format_fr'] ?? [],
                'en' => $validated['session_format_en'] ?? []
            ],
            'price_individual' => $validated['price_individual'],
            'price_group' => $validated['price_group'],
            'duration' => $validated['duration'],
            'icon' => $validated['icon'] ?? 'heart',
            'is_active' => $validated['is_active'] ?? false,
            'is_featured' => $validated['is_featured'] ?? false,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully!');
    }
}
