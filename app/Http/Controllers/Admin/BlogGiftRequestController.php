<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogGiftRequest;
use Illuminate\Http\Request;

class BlogGiftRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogGiftRequest::query()->latest();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => BlogGiftRequest::count(),
            'pending' => BlogGiftRequest::where('status', BlogGiftRequest::STATUS_PENDING)->count(),
            'processed' => BlogGiftRequest::where('status', BlogGiftRequest::STATUS_PROCESSED)->count(),
        ];

        return view('admin.blog-gift-requests.index', compact('requests', 'stats'));
    }

    public function show(BlogGiftRequest $blogGiftRequest)
    {
        return view('admin.blog-gift-requests.show', compact('blogGiftRequest'));
    }

    public function update(Request $request, BlogGiftRequest $blogGiftRequest)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', [BlogGiftRequest::STATUS_PENDING, BlogGiftRequest::STATUS_PROCESSED])],
            'admin_notes' => ['nullable', 'string'],
        ]);

        if ($validated['status'] === BlogGiftRequest::STATUS_PROCESSED) {
            $blogGiftRequest->markAsProcessed($validated['admin_notes'] ?? null);
        } else {
            $blogGiftRequest->update([
                'status' => BlogGiftRequest::STATUS_PENDING,
                'admin_notes' => $validated['admin_notes'] ?? null,
                'processed_at' => null,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Request updated successfully.');
    }

    public function destroy(BlogGiftRequest $blogGiftRequest)
    {
        $blogGiftRequest->delete();

        return redirect()
            ->route('admin.blog-gift-requests.index')
            ->with('success', 'Request deleted successfully.');
    }
}
