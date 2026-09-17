<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://fahrurihanafi.site/certificates" />
    @php 
        $siteSettingsData = $siteSetting ?? \App\Models\AboutSetting::first(); 
        $logoText = $siteSettingsData->footer_name ?? 'Hanafi';
    @endphp
    <title>Certificates | {{ $logoText }}</title>

    <!-- Open Graph / WhatsApp & LinkedIn -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://fahrurihanafi.site/certificates" />
    <meta property="og:title" content="Certificates & Credentials | Fahruri Hanafi" />
    <meta property="og:description" content="Portfolio of Fahruri Hanafi - Bridging design and code to solve real business problems." />
    <meta property="og:image" content="https://fahrurihanafi.site/og-image.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Certificates & Credentials | Fahruri Hanafi" />
    <meta name="twitter:description" content="Portfolio of Fahruri Hanafi - Bridging design and code to solve real business problems." />
    <meta name="twitter:image" content="https://fahrurihanafi.site/og-image.jpg" />

    @if($siteSettingsData && $siteSettingsData->favicon)
    <link rel="icon" type="image/png" href="{{ $siteSettingsData->favicon }}">
    @else
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    @endif
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        html, body { overflow-x: hidden; }
        @keyframes slide-up {
            0% { opacity: 0; transform: translateY(35px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white"
      x-data="{ zoomOpen: false, zoomImage: '', zoomTitle: '', isPdf: false }">

    <!-- Ambient Glowing Backdrop -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[20%] w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-[120px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8 flex flex-col min-h-screen">
        
        <x-navigation />

        <main class="flex-grow pt-16 pb-32 animate-slide-up">
            <!-- Header Section -->
            <div class="mb-12 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">My <span class="text-blue-600">Certificates</span></h1>
                <p class="text-gray-400 text-sm md:text-lg">A showcase of my professional qualifications, course completions, and technical credentials.</p>
            </div>

            <!-- Certificates Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                @forelse($certificates as $index => $cert)
                @php
                    $isPdf = Str::startsWith($cert->image, 'data:application/pdf') || Str::endsWith(strtolower($cert->image), '.pdf');
                    $imgUrl = Str::startsWith($cert->image, 'data:') ? route('media.certificate', [$cert->id, 'v' => $cert->updated_at?->timestamp ?? 1]) : (Str::startsWith($cert->image, 'http') ? $cert->image : asset('img/' . $cert->image));
                    $num = sprintf("%02d", $index + 1);
                @endphp
                <div class="cursor-pointer group flex flex-col justify-between bg-[#111111]/40 border border-gray-800/60 rounded-2xl p-4 transition-all duration-500 hover:border-blue-500/40 hover:shadow-2xl hover:shadow-blue-500/5 h-full"
                     @click="zoomImage = '{{ $imgUrl }}'; zoomTitle = '{{ addslashes($cert->name) }}'; isPdf = {{ $isPdf ? 'true' : 'false' }}; zoomOpen = true">
                    
                    <div>
                        <!-- Clickable Image / PDF Area -->
                        <div class="block aspect-[16/10] bg-[#1a1a1a] border border-gray-800/80 rounded-xl overflow-hidden relative mb-4 transition-all duration-500 group-hover:border-blue-500/30">
                            @if($isPdf)
                            <!-- Elegant PDF Card Graphic -->
                            <div class="w-full h-full bg-gradient-to-br from-[#1c1515] via-[#141010] to-[#0e0e10] flex flex-col items-center justify-center p-4 relative overflow-hidden group-hover:scale-105 transition-all duration-500">
                                <div class="absolute -top-10 -right-10 w-28 h-28 bg-red-600/10 rounded-full blur-xl pointer-events-none"></div>
                                <div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center justify-center mb-2 shadow-lg shadow-red-500/5">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-red-400/90 bg-red-500/10 px-2.5 py-0.5 rounded-full border border-red-500/20">Dokumen PDF</span>
                                <span class="text-[9px] text-gray-500 mt-1 font-medium">Klik untuk membaca</span>
                            </div>
                            @else
                            <img src="{{ $imgUrl }}" alt="{{ $cert->name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-75">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-transparent to-transparent opacity-85 group-hover:opacity-70 transition-opacity duration-500"></div>
                            @endif
                            
                            <!-- Zoom Icon Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="p-3 {{ $isPdf ? 'bg-red-600 shadow-red-500/30' : 'bg-blue-600 shadow-blue-500/30' }} rounded-full text-white shadow-lg scale-90 group-hover:scale-100 transition-transform">
                                    @if($isPdf)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Details & Info -->
                        <div class="space-y-2">
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="text-white font-bold text-sm md:text-base leading-tight group-hover:text-blue-500 transition-colors">{{ $cert->name }}</h4>
                                <span class="text-blue-500 text-[10px] font-bold uppercase tracking-wider flex-shrink-0 mt-0.5">{{ $num }}</span>
                            </div>
                            <div class="text-xs text-gray-400 font-semibold">{{ $cert->issuer }}</div>
                            <div class="text-[10px] text-gray-500 tracking-wide uppercase font-bold">Terbit: {{ $cert->issued_at }}</div>
                            @if($cert->credential_id)
                            <div class="text-[9px] text-gray-600 bg-white/[0.02] border border-white/5 py-1 px-2 rounded-md inline-block">ID: {{ $cert->credential_id }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    @if($cert->credential_url)
                    <div class="flex items-center gap-4 pt-3 mt-4 border-t border-white/5 text-xs font-semibold">
                        <a href="{{ $cert->credential_url }}" target="_blank" @click.stop class="text-white hover:text-blue-500 flex items-center gap-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            Verifikasi Kredensial
                        </a>
                    </div>
                    @endif

                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    <p class="text-gray-500 text-lg">Belum ada sertifikat kompetensi yang terunggah.</p>
                </div>
                @endforelse
            </div>
        </main>

        <x-footer />
    </div>

    <!-- Certificate Zoom Modal (Alpine.js) -->
    <div x-show="zoomOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
         @click="zoomOpen = false"
         @keydown.escape.window="zoomOpen = false">
        
        <div class="relative max-w-4xl w-full bg-[#111113] border border-gray-800 rounded-3xl p-4 overflow-hidden shadow-2xl flex flex-col items-center"
             @click.stop>
            
            <!-- Close Button -->
            <button @click="zoomOpen = false" 
                    class="absolute top-4 right-4 p-2 rounded-full bg-white/5 border border-white/5 hover:border-white/20 text-gray-400 hover:text-white transition-all z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            <!-- Title -->
            <div class="w-full text-center pb-4 border-b border-gray-800 mb-4 px-8">
                <h3 class="text-white font-bold text-base md:text-lg leading-tight" x-text="zoomTitle"></h3>
            </div>

            <!-- Content Area: PDF or Image -->
            <div class="w-full flex items-center justify-center overflow-hidden rounded-2xl bg-black min-h-[300px]">
                <!-- If PDF -->
                <template x-if="isPdf">
                    <iframe :src="zoomImage" class="w-full h-[65vh] rounded-2xl border border-white/10 bg-white" title="PDF Document"></iframe>
                </template>
                <!-- If Image -->
                <template x-if="!isPdf">
                    <img :src="zoomImage" :alt="zoomTitle" class="max-w-full max-h-[70vh] object-contain select-none">
                </template>
            </div>

            <!-- PDF Action Buttons -->
            <div x-show="isPdf" class="flex flex-wrap items-center justify-center gap-3 mt-4">
                <a :href="zoomImage" target="_blank" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-xl text-xs font-semibold flex items-center gap-2 transition-all shadow-lg shadow-red-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    Buka Dokumen PDF di Tab Baru
                </a>
                <a :href="zoomImage" download="sertifikat.pdf" class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 text-white rounded-xl text-xs font-semibold flex items-center gap-2 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    Download PDF
                </a>
            </div>

            <!-- Footnote -->
            <p class="text-[10px] text-gray-500 mt-3">Tekan ESC atau klik di luar untuk menutup</p>

        </div>
    </div>

</body>
</html>
