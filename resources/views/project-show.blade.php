<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $project->title ?? 'Project Details' }} - Fahruri Hanafi</title>
    @php $siteFavicon = \App\Models\AboutSetting::first(); @endphp
    @if($siteFavicon && $siteFavicon->favicon)
    <link rel="icon" type="image/png" href="{{ $siteFavicon->favicon }}">
    @else
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .animate-slide-up { animation: slide-up 1s ease-out forwards; }
        @keyframes slide-up {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white">
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[20%] w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-[120px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8 flex flex-col min-h-screen">
        <x-navigation />

        <main class="flex-grow pt-24 pb-16 animate-slide-up">
            <div class="mb-16 max-w-3xl">
                <a href="/works" class="inline-flex items-center text-blue-500 hover:text-white transition-colors mb-8 text-sm font-semibold tracking-wider uppercase">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to Works
                </a>
                <h1 class="text-4xl md:text-6xl font-bold text-white tracking-tight mb-6">{{ $project->title }}</h1>
                <div class="flex items-center gap-4 mb-8">
                    <span class="px-4 py-1.5 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-400 text-xs font-bold uppercase tracking-widest">{{ $project->category === 'web' ? 'Web Development' : 'Design Project' }}</span>
                    <span class="text-gray-500 text-sm">2026</span>
                </div>
                <p class="text-gray-400 text-lg md:text-xl leading-relaxed">
                    {{ $project->description }}
                </p>
            </div>

            @if($project->category === 'web')
                <x-project.web-details :project="$project" />
            @elseif($project->category === 'design')
                <x-project.design-gallery :project="$project" />
            @endif
        </main>

        <x-footer />
    </div>
</body>
</html>
