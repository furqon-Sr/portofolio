<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store (Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Simpan data ke database
        Contact::create($validatedData);

        return back()->with('success', 'Pesan Anda telah terkirim!');
    }

    public function index(){
        $messages = Contact::latest()->get();
        return view('admin.messages', compact('messages'));
    }
}
