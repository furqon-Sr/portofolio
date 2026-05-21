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
            <div class="grid grid-cols-3 gap-3 md:gap-8">
                <!-- Web Projects -->
                <div class="work-item web" data-category="web">
                    <x-project-card 
                        number="01"
                        title="ES Kristal Utama Indah" 
                        category="Web Dev"
                        description="Company profile & catalog website dengan desain profesional dan performa optimal."
                        link="https://eskristalutamaindah.com"
                        image="image.png"
                    />
                </div>
                <div class="work-item web" data-category="web">
                    <x-project-card 
                        number="02"
                        title="Media PPNK" 
                        category="Web Dev"
                        description="Portal informasi dan platform media interaktif untuk PPNK."
                        link="https://mediappnk.org"
                        image="p.png"
                    />
                </div>

                <!-- Design Projects -->
                <div class="work-item design" data-category="design">
                    <x-project-card 
                        number="04"
                        title="PDH Design System" 
                        category="Design"
                        description="Desain identitas visual menyeluruh dengan fokus pada keselarasan optik."
                        link="https://drive.google.com/file/d/1RCrTw1cJWoUGn10cs7VhrqkgtgQW4Ued/view?usp=sharing"
                        image="pdh.png"
                        
                    />
                </div>
                <div class="work-item design" data-category="design">
                    <x-project-card 
                        number="05"
                        title="FAPRE UNTAR" 
                        category="Design"
                        description="Desain identitas visual untuk FAPRE UNTAR."
                        link="https://drive.google.com/file/d/1HKvCAHvM_LCVYvl5k4UkvYsxr944SyhO/view?usp=sharing"
                        image="fapre.png"
                    />
                </div>
                <div class="work-item design" data-category="design">
                    <x-project-card 
                        number="06"
                        title="170 th Anniversary cilacap Logo" 
                        category="Design"
                        description="Desain logo untuk peringatan 170 tahun Cilacap."
                        link="https://drive.google.com/file/d/1Kr7S5x2MlZWbB7na6PyV_oU6CKOEH55Y/view?usp=sharing"
                        image="cilacap.png"
                    />
                </div>
                <div class="work-item design" data-category="design">
                    <x-project-card 
                        number="07"
                        title="karsa Coffee 360 Logo" 
                        category="Design"
                        description="Desain logo untuk karsa kopi."
                        link="https://drive.google.com/file/d/1mVpGZqbPnMS9p9rrINu2QOVam5y8y5Vc/view?usp=sharing"
                        image="logo._1.png"
                    />
                </div>
                <div class="work-item design" data-category="design">
                    <x-project-card 
                        number="08"
                        title="Pantai Baru Pandansimo Logo" 
                        category="Design"
                        description="Desain logo untuk Pantai Baru Pandansimo."
                        link="https://drive.google.com/file/d/1NI46cJsx0VGpNJeL2QuDTT93ofKTpd2g/view?usp=sharing"
                        image="pantai.png"
                    />
                </div>
                <div class="work-item design" data-category="design">
                    <x-project-card 
                        number="09"
                        title="Es Kristal Utama Indah Logo" 
                        category="Design"
                        description="Desain logo untuk Es Kristal Utama Indah."
                        link="https://drive.google.com/file/d/1OFPnrEakJhrV0yvWMQ7mWsZDJkJUoULf/view?usp=sharing"
                        image="ui.png"
                    />
                </div>
                <div class="work-item design" data-category="design">
                    <x-project-card 
                        number="  10"
                        title="Price List Coffee Shop" 
                        category="Design"
                        description="Desain price list untuk Coffee Shop."
                        link="https://drive.google.com/file/d/13QaS42JbzoGoLD6lqFxtC5PTxPKEeN_O/view?usp=sharing"
                        image="pricelist.png"
                    />
                </div>
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
