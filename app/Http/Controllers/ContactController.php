<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store (Request $request)
    {
        // 1. TEKNIK HONEYPOT (Kolom input palsu yang disembunyikan CSS)
        // Bot perayap otomatis umumnya mengisi semua kolom input form.
        if ($request->filled('website_url')) {
            Log::warning('Contact form bot caught by honeypot', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'name' => $request->input('name'),
                'honeypot_value' => $request->input('website_url'),
            ]);
            // Batalkan proses penyimpanan secara otomatis, beri respon sukses palsu agar bot terkecoh
            return back()->with('success', 'Pesan Anda telah terkirim!');
        }

        // Time-based honeypot: jika dikirim dalam < 1.5 detik sejak form dirender, kemungkinan besar bot script
        $formTimestamp = (int) $request->input('form_timestamp');
        if ($formTimestamp > 0 && (time() - $formTimestamp) < 2) {
            Log::warning('Contact form bot caught by sub-second submission', [
                'ip' => $request->ip(),
                'duration' => time() - $formTimestamp,
            ]);
            return back()->with('success', 'Pesan Anda telah terkirim!');
        }

        // 2. PROTEKSI BOT MODERN (Cloudflare Turnstile)
        if (config('services.turnstile.enabled') && config('services.turnstile.secret_key')) {
            $turnstileToken = $request->input('cf-turnstile-response');
            
            if (empty($turnstileToken)) {
                return back()
                    ->withErrors(['turnstile' => 'Verifikasi keamanan bot gagal. Mohon lengkapi verifikasi dan coba lagi.'])
                    ->withInput();
            }

            try {
                $verifyResponse = Http::asForm()
                    ->timeout(6)
                    ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                        'secret' => config('services.turnstile.secret_key'),
                        'response' => $turnstileToken,
                        'remoteip' => $request->ip(),
                    ]);

                $result = $verifyResponse->json();
                if (!($result['success'] ?? false)) {
                    Log::warning('Turnstile verification rejected', [
                        'ip' => $request->ip(),
                        'errors' => $result['error-codes'] ?? [],
                    ]);
                    return back()
                        ->withErrors(['turnstile' => 'Verifikasi bot gagal. Silakan coba kirim kembali.'])
                        ->withInput();
                }
            } catch (\Exception $e) {
                // Log jika ada kendala koneksi ke server Cloudflare
                Log::error('Cloudflare Turnstile API error: ' . $e->getMessage());
            }
        }

        // 3. VALIDASI DASAR INPUT
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:5|max:5000',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan terlalu pendek (minimal 5 karakter).',
        ]);

        // 4. VALIDASI KONTEN DAN TAUTAN (Spam Keywords & Suspicious URLs)
        $lowerContent = strtolower($validatedData['name'] . ' ' . $validatedData['message']);

        // a. Periksa kata kunci penipuan / spam SEO indeks pencarian / skema crypto
        $scamKeywords = [
            // SEO & Search Indexing Scams
            'search engine ranking', 'rank on google', 'google ranking', 'first page of google',
            'ranking of your website', 'boost your rank', 'seo ranking', 'seo service', 'seo audit',
            'backlink', 'guest post outreach', 'domain rating', 'da/dr score', 'increase website traffic',
            'commercial proposal', 'business proposal for your website', 'syndication',
            // Crypto / Financial Scams
            'crypto investment', 'bitcoin profit', 'forex trading', 'binary option', 'trading signal',
            'wallet connect', 'trust wallet', 'metamask validation', 'claim airdrop', 'free usdt',
            // Phishing & Spambots
            'telegram channel', 't.me/', 'wa.me/', 'undelivered package', 'viagra', 'cialis',
            'casino online', 'slot gacor', 'judi online', 'daftar slot'
        ];

        foreach ($scamKeywords as $keyword) {
            if (str_contains($lowerContent, $keyword)) {
                Log::info('Blocked spam keyword in contact form', [
                    'ip' => $request->ip(),
                    'keyword' => $keyword,
                ]);
                return back()
                    ->withErrors(['message' => 'Pesan ditolak karena terdeteksi mengandung kata kunci promosi atau penipuan indeks pencarian.'])
                    ->withInput();
            }
        }

        // b. Periksa akumulasi URL berlebih (bot spam sering menaruh banyak tautan)
        preg_match_all('#https?://[^\s]+#i', $validatedData['message'], $urlMatches);
        $urlCount = count($urlMatches[0] ?? []);
        if ($urlCount > 2) {
            return back()
                ->withErrors(['message' => 'Pesan Anda mengandung terlalu banyak tautan (maksimal 2 tautan).'])
                ->withInput();
        }

        // c. Periksa TLD atau domain mencurigakan
        $suspiciousTlds = ['.ru', '.cn', '.xyz', '.top', '.click', '.rest', '.fit', '.gq', '.tk', '.work', '.biz'];
        foreach ($suspiciousTlds as $tld) {
            if (preg_match('#https?://[^\s]*' . preg_quote($tld, '#') . '(\b|/|\?)#i', $validatedData['message'])) {
                return back()
                    ->withErrors(['message' => 'Pesan mengandung tautan dengan ekstensi domain yang mencurigakan.'])
                    ->withInput();
            }
        }

        // 5. SIMPAN KE DATABASE (Pesan bersih dari pengunjung manusia)
        $contact = Contact::create($validatedData);

        // Kirim email ke fhan111205@gmail.com
        try {
            $emailData = [
                'contactName' => $contact->name,
                'contactEmail' => $contact->email,
                'contactMessage' => $contact->message,
                'contactTime' => $contact->created_at ? $contact->created_at->timezone('Asia/Jakarta')->format('d F Y, H:i') . ' WIB' : now()->timezone('Asia/Jakarta')->format('d F Y, H:i') . ' WIB',
            ];

            Mail::send('emails.contact', $emailData, function ($message) use ($contact) {
                $message->to('fhan111205@gmail.com')
                        ->replyTo($contact->email)
                        ->subject('Pesan Baru dari Kontak Portfolio: ' . $contact->name);
            });
        } catch (\Exception $e) {
            report($e);
        }

        return back()->with('success', 'Pesan Anda telah berhasil dikirim! Saya akan segera merespons.');
    }

    public function index(){
        $messages = Contact::latest()->get();
        return view('admin.messages', compact('messages'));
    }
}
