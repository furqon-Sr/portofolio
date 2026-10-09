<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://fahrurihanafi.site/" />
    @php 
        $siteSettingsData = $siteSetting ?? \App\Models\AboutSetting::first(); 
        $logoText = $siteSettingsData->footer_name ?? 'Hanafi';
        $heroTitle = $siteSettingsData->hero_title ?? 'Bridging the gap between optical balance and scalable architecture.';
        $heroSubtitle = $siteSettingsData->hero_subtitle ?? 'Product Designer & Fullstack Dev';
        $aboutText = $siteSettingsData->about_text ?? '';
        $defaultHeroImg = file_exists(public_path('img/porto.webp')) ? asset('img/porto.webp') : asset('img/porto.png');
        $rawHeroPhoto = $siteSettingsData->profile_photo ?? $defaultHeroImg;
        if (str_ends_with($rawHeroPhoto, 'porto.png') && file_exists(public_path('img/porto.webp'))) {
            $rawHeroPhoto = str_replace('porto.png', 'porto.webp', $rawHeroPhoto);
        }
        $heroImgSrc = Str::startsWith($rawHeroPhoto, 'data:') 
            ? route('media.profile', ['v' => $siteSettingsData->updated_at?->timestamp ?? 1]) 
            : $rawHeroPhoto;
    @endphp
    <title>{{ $logoText }} | {{ $heroSubtitle }}</title>

    <!-- Open Graph / WhatsApp & LinkedIn -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://fahrurihanafi.site/" />
    <meta property="og:title" content="{{ $logoText }} | {{ $heroSubtitle }}" />
    <meta property="og:description" content="{{ $heroTitle }}" />
    <meta property="og:image" content="https://fahrurihanafi.site/og-image.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $logoText }} | {{ $heroSubtitle }}" />
    <meta name="twitter:description" content="{{ $heroTitle }}" />
    <meta name="twitter:image" content="https://fahrurihanafi.site/og-image.jpg" />

    @if($siteSettingsData && $siteSettingsData->favicon)
    <link rel="icon" type="image/png" href="{{ $siteSettingsData->favicon }}">
    @else
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- High Priority Preconnect & Preload (CWV Optimization) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="image" href="{{ $heroImgSrc }}" fetchpriority="high">

    @vite('resources/css/app.css')
    <!-- Non-render-blocking font load -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    </noscript>
    <style>
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        html, body { overflow-x: hidden; }
        @keyframes slide-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .animate-slide-up { animation: slide-up 1s ease-out forwards; }
        .animate-fade-in { animation: fade-in 1.5s ease-out forwards; }
        .content-visibility-auto {
            content-visibility: auto;
            contain-intrinsic-size: 1px 700px;
        }
    </style>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white">
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-gray-300/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-300/10 blur-[120px]"></div>
    </div>

    <!-- Full-Width Navigation (Mentok Kanan Kiri) -->
    <div class="w-full px-6 md:px-10 lg:px-12 pt-2">
        <x-navigation :site-setting="$siteSettingsData" />
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8">   
        <x-hero :site-setting="$siteSettingsData" />
        <section id="about" class="mt-40 grid grid-cols-1 lg:grid-cols-12 gap-16 items-start content-visibility-auto">
            <div class="lg:col-span-6 space-y-8" id="about-content">
                <div class="space-y-4">
                    <h2 id="about-heading" class="text-5xl font-bold text-white tracking-tight">About <span class="text-blue-600">Me</span></h2>
                    <p id="about-text" class="text-gray-400 leading-relaxed text-lg">
                        {{ $aboutText }}
                    </p>
                </div>

                <div id="about-boxes" class="grid grid-cols-2 gap-4">
                    @php
                        $svgMap = [
                            'box_1' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
                            'box_2' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>',
                            'box_3' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
                            'box_4' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>',
                        ];
                    @endphp
                    @foreach($aboutBoxes as $box)
                        <div class="about-box p-5 bg-[#1a1a1a] border border-gray-800 rounded-xl hover:border-blue-500/50 transition-colors group">
                            <div class="w-6 h-6 mb-3 group-hover:scale-110 transition-transform text-blue-500 flex items-center justify-center [&>svg]:w-6 [&>svg]:h-6 [&>svg]:max-w-[24px] [&>svg]:max-h-[24px] [&>svg]:shrink-0">
                                @if(str_contains($box->icon ?? '', '<svg'))
                                    {!! $box->icon !!}
                                @elseif(Str::startsWith($box->icon ?? '', 'http') || Str::startsWith($box->icon ?? '', 'data:'))
                                    <img src="{{ $box->icon }}" class="w-6 h-6 object-contain">
                                @else
                                    {!! $svgMap[$box->key] ?? '' !!}
                                @endif
                            </div>
                            <h3 class="text-white font-semibold text-sm mb-1">{{ $box->title }}</h3>
                            <p class="text-xs text-gray-500 leading-tight">{{ $box->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-6" id="expertise-section">
                <div class="flex lg:justify-end mb-8">
                    <h3 id="expertise-heading" class="text-2xl font-bold font-heading bg-gradient-to-r from-[#1F7CE6] to-[#E1E1E1] text-transparent bg-clip-text">Expertise</h3>
                </div>
                <div id="expertise-grid" class="grid grid-cols-4 gap-4">
                    @foreach($expertises as $tech)
                        @php
                            $techLogo = Str::startsWith($tech->logo, 'http') || Str::startsWith($tech->logo, 'data:') 
                                ? $tech->logo 
                                : (file_exists(public_path('img/logos/' . preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $tech->logo))) 
                                    ? asset('img/logos/' . preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $tech->logo)) 
                                    : asset('img/logos/' . $tech->logo));
                        @endphp
                        <a href="{{ $tech->url }}" target="_blank" class="expertise-card card-tilt-spotlight {{ $tech->bg_class }} {{ $tech->hover_class }} aspect-square rounded-xl flex items-center justify-center border border-gray-800 group transition-all duration-300 overflow-hidden relative">
                            <img src="{{ $techLogo }}" 
                                 alt="{{ $tech->name }}" 
                                 width="64"
                                 height="64"
                                 loading="lazy"
                                 decoding="async"
                                 class="w-full h-full {{ in_array($tech->name, ['JS', 'Java', 'MySQL']) ? 'object-contain p-2' : 'object-cover' }}">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-20 {{ $tech->bg_class }} transition-opacity"></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Trusted By / Clients Section -->
        @if($clients && $clients->count() > 0)
        <section class="mt-20 mb-32 relative z-10 content-visibility-auto" x-data="{ shown: false }" x-intersect.once="shown = true">
            <div class="text-center mb-10 transition-all duration-1000 transform" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                <p class="text-sm font-bold text-gray-500 uppercase tracking-[0.2em] ...">Trusted By & Collaborated With</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center justify-items-center max-w-5xl mx-auto px-4">
                @foreach($clients as $index => $client)
                    @php
                        $clientLogo = $client->logo;
                        if (str_starts_with($clientLogo, 'https://pub-') && str_contains($clientLogo, '.r2.dev/')) {
                            $path = substr($clientLogo, strpos($clientLogo, '.r2.dev/') + 8);
                            $clientLogo = url('/r2/' . $path);
                        }
                    @endphp
                    @if($client->url)
                        <a href="{{ $client->url }}" target="_blank" 
                           class="client-logo-wrap block w-full h-12 md:h-16 relative transition-all duration-300 hover:scale-110 transform"
                           :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'"
                           style="transition-delay: {{ $index * 100 }}ms, 0ms, 0ms, 0ms;">
                            <img src="{{ Str::startsWith($clientLogo, 'http') || Str::startsWith($clientLogo, 'data:') || Str::startsWith($clientLogo, '<svg') ? (Str::startsWith($clientLogo, '<svg') ? 'data:image/svg+xml;base64,'.base64_encode($clientLogo) : $clientLogo) : asset('img/logos/' . $clientLogo) }}" 
                                 alt="{{ $client->name }}" 
                                 width="120"
                                 height="48"
                                 loading="lazy"
                                 decoding="async"
                                 class="client-logo-item w-full h-full object-contain" title="{{ $client->name }}">
                        </a>
                    @else
                        <div class="client-logo-wrap w-full h-12 md:h-16 relative transition-all duration-300 hover:scale-110 transform"
                             :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'"
                             style="transition-delay: {{ $index * 100 }}ms, 0ms, 0ms, 0ms;">
                            <img src="{{ Str::startsWith($clientLogo, 'http') || Str::startsWith($clientLogo, 'data:') || Str::startsWith($clientLogo, '<svg') ? (Str::startsWith($clientLogo, '<svg') ? 'data:image/svg+xml;base64,'.base64_encode($clientLogo) : $clientLogo) : asset('img/logos/' . $clientLogo) }}" 
                                 alt="{{ $client->name }}" 
                                 width="120"
                                 height="48"
                                 loading="lazy"
                                 decoding="async"
                                 class="client-logo-item w-full h-full object-contain" title="{{ $client->name }}">
                        </div>
                    @endif
                @endforeach
            </div>
            
            <!-- Subtle gradient divider -->
            <div class="h-px w-full max-w-3xl mx-auto mt-20 bg-gradient-to-r from-transparent via-white/10 to-transparent transition-all duration-1000 delay-500" :class="shown ? 'opacity-100' : 'opacity-0'"></div>
        </section>
        @endif

        <!-- Certificates: latest four, no cards -->
        @if($certificates->count() > 0)
        <section id="certificates" class="mt-32 mb-16 content-visibility-auto">
            <div class="flex items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white tracking-tight">Certificates</h2>
                    <p class="text-sm text-gray-500 mt-2">Insights &amp; achievements</p>
                </div>
                <a href="{{ route('certificates.show') }}" class="shrink-0 text-sm text-gray-400 hover:text-white transition-colors">View all &rarr;</a>
            </div>

            <div class="grid grid-cols-2 gap-x-6 gap-y-14">
                @foreach($certificates->take(4) as $cert)
                    @php
                        $isCertPdf = Str::startsWith($cert->image, 'data:application/pdf') || Str::endsWith(strtolower($cert->image), '.pdf');
                        $certImg = Str::startsWith($cert->image, 'data:') ? route('media.certificate', [$cert->id, 'v' => $cert->updated_at?->timestamp ?? 1]) : (Str::startsWith($cert->image, 'http') ? $cert->image : asset('img/certificates/' . $cert->image));
                    @endphp
                    <a href="{{ route('certificates.show') }}" class="group block">
                        <div class="aspect-video w-full rounded-lg bg-white/[0.03] overflow-hidden relative flex items-center justify-center">
                            @if($isCertPdf)
                            <canvas data-pdf-thumb="{{ $certImg }}" class="w-full h-full object-contain opacity-80 group-hover:opacity-100 transition-opacity duration-300"></canvas>
                            <div class="pdf-welcome-fallback absolute inset-0 flex items-center justify-center text-gray-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                            </div>
                            @else
                            <img src="{{ $certImg }}"
                                 alt="{{ $cert->name }}"
                                 width="280"
                                 height="158"
                                 loading="lazy"
                                 decoding="async"
                                 class="max-w-full max-h-full object-contain opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                            @endif
                        </div>
                        <h3 class="text-sm text-gray-200 mt-4 truncate">{{ $cert->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1 truncate">{{ $cert->issuer }} &middot; {{ $cert->issued_at }}</p>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('portfolioSection', () => ({
                    category: 'all',
                    projectsList: @json($projects->map(fn($p) => ['id' => $p->id, 'category' => $p->category === 'Web Dev' ? 'web' : 'design'])),
                    shouldShow(id) {
                        const filtered = this.projectsList.filter(p => this.category === 'all' || p.category === this.category);
                        const index = filtered.findIndex(p => p.id === id);
                        return index >= 0 && index < 3;
                    }
                }));
            });
        </script>

        <section x-data="portfolioSection" class="mt-48 mb-32 relative content-visibility-auto">
            
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 relative z-10">
                <div class="space-y-4">
                    <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Selected <span class="text-blue-600 font-medium">Works</span></h2>
                    <p class="text-gray-400 text-sm md:text-base max-w-md leading-relaxed">A curated collection of digital experiences and design systems, built with precision and intent.</p>
                </div>
                
                <!-- Filter Buttons -->
                <div class="flex gap-6 border-b border-white/5 pb-2 md:pb-0 md:border-none">
                    <button @click="category = 'all'" :class="category === 'all' ? 'text-blue-500 border-blue-500' : 'text-gray-500 border-transparent hover:text-white'" class="pb-2 text-sm font-medium tracking-tight border-b-2 transition-all duration-300">All</button>
                    <button @click="category = 'web'" :class="category === 'web' ? 'text-blue-500 border-blue-500' : 'text-gray-500 border-transparent hover:text-white'" class="pb-2 text-sm font-medium tracking-tight border-b-2 transition-all duration-300">Web Dev</button>
                    <button @click="category = 'design'" :class="category === 'design' ? 'text-blue-500 border-blue-500' : 'text-gray-500 border-transparent hover:text-white'" class="pb-2 text-sm font-medium tracking-tight border-b-2 transition-all duration-300">Design</button>
                </div>
            </div>

            <!-- Projects List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
                @foreach($projects as $index => $project)
                @php
                    $catClass = $project->category === 'Web Dev' ? 'web' : 'design';
                @endphp
                <div x-show="shouldShow({{ $project->id }})" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 transform translate-y-4" 
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="flex flex-col h-full">
                    <x-project-card 
                        :id="$project->id"
                        :title="$project->title" 
                        :category="$project->category"
                        :description="$project->description"
                        :link="$project->live_link"
                        :github_link="$project->github_link"
                        :image="$project->cover_image_url"
                        :design_url="$project->design_pdf_url"
                        :has_pdf_cover="$project->has_pdf_cover"
                    />
                </div>
                @endforeach
            </div>

            <!-- Footer Action -->
            <div class="mt-16 text-center relative z-10">
                <a href="/works" class="group inline-flex items-center gap-2 px-6 py-3 border border-white/10 hover:border-blue-500 text-white font-medium text-sm rounded-full hover:bg-white/5 transition-all duration-300 hover:-translate-y-0.5">
                    View All Projects
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </section>

        <!-- Insights & Blog Section -->
        @if($latestArticles && $latestArticles->count() > 0)
        <section class="mt-20 mb-32 relative z-10 content-visibility-auto" x-data="{ shown: false }" x-intersect.once="shown = true">
            <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6 transition-all duration-1000 transform" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                <div>
                    <h2 class="text-xs font-bold text-gray-500 uppercase tracking-[0.2em] mb-2">Latest Insights</h2>
                    <h3 class="text-3xl font-bold text-white tracking-tight">Thoughts & <span class="text-blue-600">Notes</span></h3>
                </div>
                <a href="{{ route('blog.index') }}" class="group inline-flex items-center gap-2 text-sm font-semibold text-gray-400 hover:text-white transition-colors">
                    View all articles
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $index => $article)
                <a href="{{ route('blog.show', $article->slug) }}" 
                    class="group flex flex-col bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:bg-white/[0.05] hover:border-white/10 transition-all duration-700 transform hover:-translate-y-2"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'"
                    style="transition-delay: {{ $index * 150 }}ms, 0ms, 0ms, 0ms;">
                    
                    <!-- Cover Image -->
                    <div class="w-full aspect-video bg-black/50 overflow-hidden relative border-b border-white/5">
                        @if($article->cover_image)
                            <img src="{{ $article->cover_image }}" 
                                 alt="{{ $article->title }}" 
                                 width="384"
                                 height="216"
                                 loading="lazy"
                                 decoding="async"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-600">
                                <svg class="w-10 h-10 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] uppercase tracking-widest font-bold text-blue-500">{{ $article->created_at->format('M d, Y') }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-white mb-2 leading-tight group-hover:text-blue-400 transition-colors">{{ $article->title }}</h2>
                        <p class="text-sm text-gray-400 line-clamp-3 mb-6">{{ $article->excerpt ?? Str::limit($article->content, 120) }}</p>
                        
                        <div class="mt-auto flex items-center gap-2 text-sm font-semibold text-white group-hover:text-blue-400 transition-colors">
                            Read Article 
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

    </div> 

    <!-- Full-Width Footer (Mentok Kanan Kiri) -->
    <div class="w-full px-6 md:px-10 lg:px-12 content-visibility-auto">
        <x-footer :site-setting="$siteSettingsData" />
    </div> 

    <!-- Project Preview Modal -->
    <x-project-preview-modal />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Check for reduced motion preference or missing anime.js
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (prefersReducedMotion || typeof anime === 'undefined') {
                return;
            }

            // --- 1. ABOUT ME SCROLL ANIMATION ---
            const aboutSection = document.getElementById('about');
            const aboutHeading = document.getElementById('about-heading');
            const aboutText = document.getElementById('about-text');
            const aboutBoxes = document.querySelectorAll('.about-box');

            if (aboutSection) {
                // Initialize hidden state
                if (aboutHeading) {
                    aboutHeading.style.opacity = '0';
                    aboutHeading.style.transform = 'translateY(28px)';
                }
                if (aboutText) {
                    aboutText.style.opacity = '0';
                    aboutText.style.transform = 'translateY(24px)';
                }
                aboutBoxes.forEach(box => {
                    box.style.opacity = '0';
                    box.style.transform = 'translateY(24px) scale(0.96)';
                });

                const aboutObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            // Animate Heading & Paragraph Text with smooth fluid motion
                            const textTargets = [aboutHeading, aboutText].filter(Boolean);
                            if (textTargets.length) {
                                anime({
                                    targets: textTargets,
                                    opacity: [0, 1],
                                    translateY: [28, 0],
                                    duration: 900,
                                    delay: anime.stagger(140),
                                    easing: 'cubicBezier(0.16, 1, 0.3, 1)',
                                    complete: () => {
                                        if (aboutHeading) aboutHeading.style.transform = '';
                                        if (aboutText) aboutText.style.transform = '';
                                    }
                                });
                            }

                            // Animate About Info Cards
                            if (aboutBoxes.length) {
                                anime({
                                    targets: aboutBoxes,
                                    opacity: [0, 1],
                                    translateY: [24, 0],
                                    scale: [0.96, 1],
                                    duration: 800,
                                    delay: anime.stagger(90, { start: 200 }),
                                    easing: 'cubicBezier(0.34, 1.56, 0.64, 1)',
                                    complete: () => {
                                        aboutBoxes.forEach(box => { box.style.transform = ''; });
                                    }
                                });
                            }

                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });

                aboutObserver.observe(aboutSection);
            }

            // --- 2. EXPERTISE 1-BY-1 POP-IN ANIMATION ---
            const expertiseSection = document.getElementById('expertise-section');
            const expertiseHeading = document.getElementById('expertise-heading');
            const expertiseCards = document.querySelectorAll('.expertise-card');

            if (expertiseSection && expertiseCards.length) {
                // Initialize hidden state
                if (expertiseHeading) {
                    expertiseHeading.style.opacity = '0';
                    expertiseHeading.style.transform = 'translateY(20px)';
                }
                expertiseCards.forEach(card => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(36px) scale(0.4) rotate(-6deg)';
                });

                const expertiseObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            // Animate Heading
                            if (expertiseHeading) {
                                anime({
                                    targets: expertiseHeading,
                                    opacity: [0, 1],
                                    translateY: [20, 0],
                                    duration: 750,
                                    easing: 'cubicBezier(0.16, 1, 0.3, 1)',
                                    complete: () => {
                                        expertiseHeading.style.transform = '';
                                    }
                                });
                            }

                            // Animate icons 1 per 1 (staggered entrance with dynamic spring bounce)
                            anime({
                                targets: expertiseCards,
                                opacity: [0, 1],
                                translateY: [36, 0],
                                scale: [0.4, 1],
                                rotate: [-6, 0],
                                duration: 700,
                                delay: anime.stagger(60, { start: 100 }), // Pops up 1 by 1 sequentially
                                easing: 'cubicBezier(0.34, 1.56, 0.64, 1)',
                                complete: () => {
                                    // Remove inline transforms to maintain spotlight tilt hover responsiveness
                                    expertiseCards.forEach(card => {
                                        card.style.transform = '';
                                    });
                                }
                            });

                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });

                expertiseObserver.observe(expertiseSection);
            }

            // --- 3. HIGH-PERFORMANCE LAZY PDF THUMBNAILS (ZERO RENDER-BLOCKING) ---
            let pdfJsLoading = false;
            let pdfJsLoaded = false;
            const pendingPdfCallbacks = [];

            function loadPdfJsOnDemand(callback) {
                if (pdfJsLoaded && window.pdfjsLib) {
                    callback();
                    return;
                }
                pendingPdfCallbacks.push(callback);
                if (pdfJsLoading) return;
                pdfJsLoading = true;

                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
                script.async = true;
                script.onload = () => {
                    pdfJsLoaded = true;
                    try {
                        const workerBlob = new Blob(
                            ['importScripts("https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js");'],
                            { type: "application/javascript" }
                        );
                        pdfjsLib.GlobalWorkerOptions.workerSrc = URL.createObjectURL(workerBlob);
                    } catch(e) {
                        pdfjsLib.GlobalWorkerOptions.workerSrc = '';
                    }
                    while (pendingPdfCallbacks.length) {
                        const cb = pendingPdfCallbacks.shift();
                        try { cb(); } catch (err) { console.error(err); }
                    }
                };
                script.onerror = () => {
                    pdfJsLoading = false;
                };
                document.head.appendChild(script);
            }

            async function renderSinglePdfCanvas(canvas) {
                if (canvas.dataset.rendered === "true" || canvas.dataset.rendering === "true") return;
                canvas.dataset.rendering = "true";

                const url = canvas.dataset.pdfThumb;
                if (!url) return;

                loadPdfJsOnDemand(async () => {
                    try {
                        const pdf = await pdfjsLib.getDocument({
                            url: url,
                            cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                            cMapPacked: true
                        }).promise;
                        const page = await pdf.getPage(1);
                        const parentW = Math.max(canvas.parentElement?.clientWidth || 0, 360);
                        const unscaled = page.getViewport({ scale: 1.0 });
                        const dpr = Math.min(window.devicePixelRatio || 1.5, 2);
                        const scale = (parentW * dpr) / unscaled.width;
                        const viewport = page.getViewport({ scale: scale });

                        canvas.width = viewport.width;
                        canvas.height = viewport.height;
                        const ctx = canvas.getContext('2d');
                        await page.render({ canvasContext: ctx, viewport: viewport }).promise;

                        canvas.dataset.rendered = "true";
                        delete canvas.dataset.rendering;
                        canvas.classList.remove('opacity-0');
                        const fallback = canvas.parentElement?.querySelector('.pdf-welcome-fallback, .pdf-card-fallback');
                        if (fallback) fallback.style.display = 'none';
                    } catch (e) {
                        console.error('Gagal render thumbnail PDF:', e);
                        delete canvas.dataset.rendering;
                    }
                });
            }

            window.renderAllPdfThumbnails = function() {
                const canvases = document.querySelectorAll('canvas[data-pdf-thumb]:not([data-rendered="true"])');
                if (!canvases.length) return;

                if ('IntersectionObserver' in window) {
                    const pdfObserver = new IntersectionObserver((entries, obs) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                renderSinglePdfCanvas(entry.target);
                                obs.unobserve(entry.target);
                            }
                        });
                    }, { rootMargin: '350px 0px' });

                    canvases.forEach(canvas => pdfObserver.observe(canvas));
                } else {
                    canvases.forEach(canvas => renderSinglePdfCanvas(canvas));
                }
            };

            window.renderAllPdfThumbnails();
        });
    </script>
</body>
</html>