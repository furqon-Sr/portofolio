<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

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
        $contact = Contact::create($validatedData);

        // Kirim email ke fhan111205@gmail.com
        try {
            Mail::raw("Anda mendapatkan pesan baru dari form kontak portfolio:\n\nNama: {$contact->name}\nEmail: {$contact->email}\nPesan:\n{$contact->message}", function ($message) use ($contact) {
                $message->to('fhan111205@gmail.com')
                        ->replyTo($contact->email)
                        ->subject('Pesan Baru dari Kontak Portfolio: ' . $contact->name);
            });
        } catch (\Exception $e) {
            // Log/report error tapi tetap biarkan user melihat respon sukses
            report($e);
        }

        return back()->with('success', 'Pesan Anda telah terkirim!');
    }

    public function index(){
        $messages = Contact::latest()->get();
        return view('admin.messages', compact('messages'));
    }
}
