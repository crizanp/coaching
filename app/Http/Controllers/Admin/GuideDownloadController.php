<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuideDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuideDownloadController extends Controller
{
    public function index(Request $request)
    {
        $query = GuideDownload::query();
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // Search by name or email
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        $downloads = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $stats = [
            'total' => GuideDownload::count(),
            'pending' => GuideDownload::pending()->count(),
            'approved' => GuideDownload::approved()->count(),
            'sent' => GuideDownload::sent()->count(),
        ];
        
        return view('admin.guide-downloads.index', compact('downloads', 'stats'));
    }

    public function show(GuideDownload $guideDownload)
    {
        return view('admin.guide-downloads.show', compact('guideDownload'));
    }

    public function approve(GuideDownload $guideDownload)
    {
        $guideDownload->approve();
        
        return redirect()->back()->with('success', 'Guide download approved successfully.');
    }

    public function reject(Request $request, GuideDownload $guideDownload)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500'
        ]);
        
        $guideDownload->reject($request->reason);
        
        return redirect()->back()->with('success', 'Guide download rejected.');
    }

    public function sendGuide(GuideDownload $guideDownload)
    {
        // This will be implemented when we add the email functionality
        if ($guideDownload->status !== 'approved') {
            return redirect()->back()->with('error', 'Guide must be approved before sending.');
        }
        
        // For now, just mark as sent
        $guideDownload->markAsSent();
        
        return redirect()->back()->with('success', 'Guide sent successfully.');
    }

    public function destroy(GuideDownload $guideDownload)
    {
        $guideDownload->delete();
        
        return redirect()->back()->with('success', 'Guide download deleted.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'selected' => 'required|array|min:1',
            'selected.*' => 'exists:guide_downloads,id'
        ]);

        $downloads = GuideDownload::whereIn('id', $request->selected);

        switch ($request->action) {
            case 'approve':
                $downloads->update([
                    'status' => 'approved',
                    'approved_at' => now()
                ]);
                $message = 'Selected downloads approved.';
                break;
                
            case 'reject':
                $downloads->update(['status' => 'rejected']);
                $message = 'Selected downloads rejected.';
                break;
                
            case 'delete':
                $downloads->delete();
                $message = 'Selected downloads deleted.';
                break;
        }

        return redirect()->back()->with('success', $message);
    }
}
