<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanafi | Selected Works</title>
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
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Selected <span class="text-blue-600">Works</span></h1>
                <p class="text-gray-400 text-sm md:text-lg">A collection of my recent projects in web development and design.</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-6 border-b border-white/5 pb-2 md:pb-0 md:border-none mb-12 justify-center md:justify-start">
                <button onclick="filterWorks('all')" id="btn-all" class="filter-btn pb-2 text-sm font-medium tracking-tight border-b-2 border-blue-600 text-white transition-all">All</button>
                <button onclick="filterWorks('web')" id="btn-web" class="filter-btn pb-2 text-sm font-medium tracking-tight border-b-2 border-transparent text-gray-500 hover:text-white transition-all">Web Dev</button>
                <button onclick="filterWorks('design')" id="btn-design" class="filter-btn pb-2 text-sm font-medium tracking-tight border-b-2 border-transparent text-gray-500 hover:text-white transition-all">Design</button>
            </div>

            <!-- Works List -->
            <div class="flex flex-col border-t border-white/10">
                @foreach($projects as $index => $project)
                @php
                    $catClass = $project->category === 'Web Dev' ? 'web' : 'design';
                    $num = sprintf("%02d", $index + 1);
                @endphp
                <div class="work-item {{ $catClass }}" data-category="{{ $catClass }}">
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
        </main>

        <x-footer />
    </div> 

    <script>
        function filterWorks(category) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('border-blue-600', 'text-white');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            const activeBtn = document.getElementById('btn-' + category);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-blue-600', 'text-white');

            const items = document.querySelectorAll('.work-item');
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                    // Optional fade in
                    item.style.opacity = '0';
                    setTimeout(() => { item.style.transition = 'opacity 0.4s'; item.style.opacity = '1'; }, 50);
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>

    <!-- Project Preview Modal -->
    <x-project-preview-modal />

</body>
</html>
