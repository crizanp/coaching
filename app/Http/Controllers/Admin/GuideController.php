<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::ordered()->paginate(15);
        $stats = [
            'total' => Guide::count(),
            'active' => Guide::where('is_active', true)->count(),
            'inactive' => Guide::where('is_active', false)->count(),
            'total_downloads' => \App\Models\GuideDownload::count()
        ];
        return view('admin.guides.index', compact('guides', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:guides',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'benefits' => 'required|array|min:1',
            'benefits.*' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $validated['slug'] . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('guides', $filename, 'public');
            $validated['file_path'] = $path;
        }

        Guide::create($validated);

        return redirect()->route('admin.guides.index')
            ->with('success', 'Guide created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guide $guide)
    {
        $guide->load('downloads');
        return view('admin.guides.show', compact('guide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guide $guide)
    {
        return view('admin.guides.edit', compact('guide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guide $guide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:guides,title,' . $guide->id,
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'benefits' => 'required|array|min:1',
            'benefits.*' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? $guide->sort_order;

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($guide->file_path && Storage::disk('public')->exists($guide->file_path)) {
                Storage::disk('public')->delete($guide->file_path);
            }

            $file = $request->file('file');
            $filename = $validated['slug'] . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('guides', $filename, 'public');
            $validated['file_path'] = $path;
        }

        $guide->update($validated);

        return redirect()->route('admin.guides.index')
            ->with('success', 'Guide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guide $guide)
    {
        // Check if guide has downloads
        if ($guide->downloads()->count() > 0) {
            return redirect()->route('admin.guides.index')
                ->with('error', 'Cannot delete guide that has download requests.');
        }

        // Delete associated file
        if ($guide->file_path && Storage::disk('public')->exists($guide->file_path)) {
            Storage::disk('public')->delete($guide->file_path);
        }

        $guide->delete();

        return redirect()->route('admin.guides.index')
            ->with('success', 'Guide deleted successfully.');
    }

    /**
     * Toggle guide status
     */
    public function toggleStatus(Guide $guide)
    {
        $guide->update(['is_active' => !$guide->is_active]);
        
        $status = $guide->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Guide {$status} successfully.");
    }
}
