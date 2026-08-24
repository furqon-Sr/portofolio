<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php 
        $siteSettingsData = \App\Models\AboutSetting::first(); 
        $logoText = $siteSettingsData->logo_value ?? 'Hanafi';
    @endphp
    <title>{{ $logoText }} | Blog & Notes</title>
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
            <div class="mb-16 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Blog & <span class="text-blue-600">Notes</span></h1>
                <p class="text-gray-400 text-sm md:text-lg">Sharing my thoughts on design, code, and scalable architecture.</p>
            </div>

            <!-- Blog List Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                <a href="{{ route('blog.show', $article->slug) }}" class="group flex flex-col bg-white/[0.02] border border-white/5 rounded-2xl overflow-hidden hover:bg-white/[0.05] hover:border-white/10 transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Cover Image -->
                    <div class="w-full aspect-video bg-black/50 overflow-hidden relative border-b border-white/5">
                        @if($article->cover_image)
                            <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
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
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-500">Belum ada artikel yang dipublikasikan saat ini.</p>
                </div>
                @endforelse
            </div>
        </main>
        
        <x-footer />
    </div>
</body>
</html>
