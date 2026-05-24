<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanafi | Product Designer & Fullstack Dev</title>
    @php $siteFavicon = \App\Models\AboutSetting::first(); @endphp
    @if($siteFavicon && $siteFavicon->favicon)
    <link rel="icon" type="image/png" href="{{ $siteFavicon->favicon }}">
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
        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .animate-slide-up { animation: slide-up 1s ease-out forwards; }
        .animate-fade-in { animation: fade-in 1.5s ease-out forwards; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white">
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-gray-300/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-300/10 blur-[120px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8">   
        <x-navigation />
        <x-hero />
        <section id="about" class="mt-40 grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <div class="lg:col-span-6 space-y-8">
                <div class="space-y-4">
                    <h2 class="text-5xl font-bold text-white tracking-tight">About <span class="text-blue-600">Me</span></h2>
                    <p class="text-gray-400 leading-relaxed text-lg">
                        {{ $aboutText }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @php
                        $svgMap = [
                            'box_1' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
                            'box_2' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>',
                            'box_3' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
                            'box_4' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>',
                        ];
                    @endphp
                    @foreach($aboutBoxes as $box)
                        <div class="p-5 bg-[#1a1a1a] border border-gray-800 rounded-xl hover:border-blue-500/50 transition-colors group">
                            <div class="mb-3 group-hover:scale-110 transition-transform text-blue-500">
                                @if(Str::startsWith($box->icon, '<svg'))
                                    {!! $box->icon !!}
                                @elseif(Str::startsWith($box->icon, 'http') || Str::startsWith($box->icon, 'data:'))
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

            <div class="lg:col-span-6">
                <div class="flex lg:justify-end mb-8">
                    <h3 class="text-2xl font-bold font-heading bg-gradient-to-r from-[#1F7CE6] to-[#E1E1E1] text-transparent bg-clip-text">Expertise</h3>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    @foreach($expertises as $tech)
                        <a href="{{ $tech->url }}" target="_blank" class="{{ $tech->bg_class }} {{ $tech->hover_class }} aspect-square rounded-xl flex items-center justify-center border border-gray-800 group transition-all duration-300 overflow-hidden relative">
                            <img src="{{ Str::startsWith($tech->logo, 'http') || Str::startsWith($tech->logo, 'data:') ? $tech->logo : asset('img/logos/' . $tech->logo) }}" 
                                 alt="{{ $tech->name }}" 
                                 class="w-full h-full {{ in_array($tech->name, ['JS', 'Java', 'MySQL']) ? 'object-contain p-2' : 'object-cover' }}">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-20 {{ $tech->bg_class }} transition-opacity"></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section x-data="{ category: 'all' }" class="mt-40 mb-32 bg-[#1a1a1a] border border-gray-800 rounded-3xl p-8 lg:p-16 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/10 to-transparent pointer-events-none"></div>
            
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 relative z-10">
                <div class="space-y-4">
                    <h2 class="text-2xl md:text-3xl font-bold text-white tracking-tight">Explore My <span class="text-blue-600">Selected Works</span></h2>
                    
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <button @click="category = 'all'" :class="category === 'all' ? 'bg-blue-600 text-white border-transparent' : 'bg-[#121212] text-gray-400 border-gray-800'" class="px-5 py-2 text-xs font-bold border rounded-full transition-all duration-300">All</button>
                        <button @click="category = 'web'" :class="category === 'web' ? 'bg-blue-600 text-white border-transparent' : 'bg-[#121212] text-gray-400 border-gray-800'" class="px-5 py-2 text-xs font-bold border rounded-full transition-all duration-300">Web Dev</button>
                        <button @click="category = 'design'" :class="category === 'design' ? 'bg-blue-600 text-white border-transparent' : 'bg-[#121212] text-gray-400 border-gray-800'" class="px-5 py-2 text-xs font-bold border rounded-full transition-all duration-300">Design</button>
                    </div>
                </div>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 relative z-10">
                @foreach($projects as $index => $project)
                @php
                    $catClass = $project->category === 'Web Dev' ? 'web' : 'design';
                    $num = sprintf("%02d", $index + 1);
                @endphp
                <div x-show="category === 'all' || category === '{{ $catClass }}'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <x-project-card 
                        number="{{ $num }}"
                        title="{{ $project->title }}" 
                        category="{{ $project->category }}"
                        description="{{ $project->description }}"
                        link="{{ $project->live_link }}"
                        github_link="{{ $project->github_link }}"
                        image="{{ $project->cover_image }}"
                    />
                </div>
                @endforeach
            </div>

            <!-- Footer Action -->
            <div class="mt-16 text-center relative z-10">
                <a href="/works" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-1">
                    View All Projects
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </section>

      
        <x-footer />

    </div> 

    <!-- Project Preview Modal -->
    <x-project-preview-modal />

</body>
</html>