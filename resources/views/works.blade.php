<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanafi | Selected Works</title>
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

        <main class="flex-grow pt-16 pb-32 animate-slide-up">
            <div class="mb-12 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Selected <span class="text-blue-600">Works</span></h1>
                <p class="text-gray-400 text-sm md:text-lg">A collection of my recent projects in web development and design.</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-10 justify-center md:justify-start">
                <button onclick="filterWorks('all')" id="btn-all" class="filter-btn px-6 py-2 text-xs md:text-sm font-bold bg-blue-600 text-white rounded-full transition-all">All Projects</button>
                <button onclick="filterWorks('web')" id="btn-web" class="filter-btn px-6 py-2 text-xs md:text-sm font-bold bg-[#1a1a1a] text-gray-400 border border-gray-800 rounded-full hover:text-white transition-all">Website Project</button>
                <button onclick="filterWorks('design')" id="btn-design" class="filter-btn px-6 py-2 text-xs md:text-sm font-bold bg-[#1a1a1a] text-gray-400 border border-gray-800 rounded-full hover:text-white transition-all">Desain Project</button>
            </div>

            <!-- Works Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
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
                btn.classList.remove('bg-blue-600', 'text-white', 'border-transparent');
                btn.classList.add('bg-[#1a1a1a]', 'text-gray-400', 'border-gray-800');
            });
            const activeBtn = document.getElementById('btn-' + category);
            activeBtn.classList.remove('bg-[#1a1a1a]', 'text-gray-400', 'border-gray-800');
            activeBtn.classList.add('bg-blue-600', 'text-white', 'border-transparent');

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
</body>
</html>
