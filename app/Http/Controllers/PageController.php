<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        if (!$page->is_active) {
            abort(404);
        }
        
        return view('pages.show', compact('page'));
    }
}
