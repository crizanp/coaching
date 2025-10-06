<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index()
    {
        $messages = ContactMessage::with('service')->latest()->paginate(20);
        return view('admin.contact-messages', compact('messages'));
    }
}
