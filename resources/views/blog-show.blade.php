<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php 
        $siteSettingsData = \App\Models\AboutSetting::first(); 
        $logoText = $siteSettingsData->footer_name ?? 'Hanafi';
    @endphp
    <title>{{ $article->title }} | {{ $logoText }} Blog</title>
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
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slide-up 1s ease-out forwards; }
        
        /* Article Typography Styles */
        .prose p { margin-bottom: 1.5em; line-height: 1.8; color: #a1a1aa; } /* text-gray-400 */
        .prose h1, .prose h2, .prose h3 { color: #f4f4f5; font-weight: 700; margin-top: 2em; margin-bottom: 1em; }
        .prose a { color: #3b82f6; text-decoration: underline; text-underline-offset: 4px; }
        .prose ul, .prose ol { margin-bottom: 1.5em; padding-left: 1.5em; color: #a1a1aa; }
        .prose ul { list-style-type: disc; }
        .prose ol { list-style-type: decimal; }
        .prose li { margin-bottom: 0.5em; }
        .prose blockquote { border-left: 4px solid #3b82f6; padding-left: 1em; margin-left: 0; font-style: italic; color: #d4d4d8; }
        .prose strong { color: #e4e4e7; font-weight: 600; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white">
    <!-- Ambient Background Container -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[20%] w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-[120px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8 flex flex-col min-h-screen">
        
        <x-navigation />

        <main class="flex-grow pt-24 pb-32 animate-slide-up">
            
            <article class="max-w-3xl mx-auto">
                <!-- Back Link -->
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-white mb-10 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to Blog
                </a>

                <!-- Header -->
                <header class="mb-12">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-xs uppercase tracking-widest font-bold text-blue-500 bg-blue-500/10 px-3 py-1 rounded-full border border-blue-500/20">
                            {{ $article->created_at->format('M d, Y') }}
                        </span>
                        <span class="text-sm text-gray-500 font-medium">&bull; {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-[1.1] mb-6">
                        {{ $article->title }}
                    </h1>
                    @if($article->excerpt)
                    <p class="text-xl text-gray-400 font-medium leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                    @endif
                </header>

                <!-- Cover Image -->
                @if($article->cover_image)
                <div class="w-full aspect-video rounded-3xl overflow-hidden bg-white/5 border border-white/10 mb-16 shadow-2xl relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent z-10 pointer-events-none"></div>
                    <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-lg prose-invert max-w-none text-gray-300">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <!-- References Section -->
                @if(!empty($article->references) && is_array($article->references) && count($article->references) > 0)
                <div class="mt-20 pt-10 border-t border-white/10">
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Referensi & Jurnal
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($article->references as $ref)
                            <a href="{{ $ref['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="group flex items-start gap-4 p-4 rounded-2xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.05] hover:border-white/10 transition-all duration-300 hover:-translate-y-1">
                                <div class="mt-1 p-2 bg-blue-500/10 text-blue-400 rounded-lg group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                </div>
                                <div class="overflow-hidden">
                                    <h4 class="text-sm font-semibold text-gray-200 group-hover:text-blue-400 transition-colors leading-relaxed">{{ $ref['title'] ?? 'Referensi' }}</h4>
                                    <p class="text-xs text-gray-500 mt-1 truncate">{{ $ref['url'] ?? '' }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

        </main>
        
        <x-footer />
    </div>
</body>
</html>
