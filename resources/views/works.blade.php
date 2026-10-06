<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://fahrurihanafi.site/works" />
    @php 
        $siteSettingsData = $siteSetting ?? \App\Models\AboutSetting::first(); 
        $logoText = $siteSettingsData->footer_name ?? 'Hanafi';
    @endphp
    <title>{{ $logoText }} | Selected Works</title>

    <!-- Open Graph / WhatsApp & LinkedIn -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://fahrurihanafi.site/works" />
    <meta property="og:title" content="Selected Works | Fahruri Hanafi" />
    <meta property="og:description" content="Portfolio of Fahruri Hanafi - Bridging design and code to solve real business problems." />
    <meta property="og:image" content="https://fahrurihanafi.site/og-image.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Selected Works | Fahruri Hanafi" />
    <meta name="twitter:description" content="Portfolio of Fahruri Hanafi - Bridging design and code to solve real business problems." />
    <meta name="twitter:image" content="https://fahrurihanafi.site/og-image.jpg" />

    @if($siteSettingsData && $siteSettingsData->favicon)
    <link rel="icon" type="image/png" href="{{ $siteSettingsData->favicon }}">
    @else
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white">
    <!-- Ambient Background Container -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[20%] w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-[120px]"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-between">
        <!-- Full-Width Navigation (Mentok Kanan Kiri) -->
        <div class="w-full px-6 md:px-10 lg:px-12 pt-2">
            <x-navigation :site-setting="$siteSettingsData" />
        </div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8 w-full flex-grow">
            <main class="pt-24 pb-32 animate-slide-up">
            <div class="mb-12 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-2">Selected <span class="text-blue-500">Works</span></h1>
                <p class="text-zinc-400 text-sm md:text-base max-w-xl mt-2">
                    A curated collection of web development projects, design systems, and digital experiences engineered for performance and precision.
                </p>
            </div>

            @php
                $totalCount = $projects->count();
                $webCount = $projects->where('category', 'Web Dev')->count();
                $designCount = $projects->where('category', 'Design')->count();
            @endphp

            <!-- 2. Filter Kategori: Segmented Control / Pill Buttons with Badge Counters -->
            <div class="mb-12 flex justify-center md:justify-start">
                <div class="inline-flex p-1.5 rounded-2xl bg-zinc-900/90 border border-zinc-800/80 backdrop-blur-md gap-1.5 shadow-inner">
                    <button onclick="filterWorks('all')" id="btn-all" 
                            class="filter-btn px-4 py-2 text-xs md:text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2 bg-zinc-800 text-white border border-zinc-700 shadow-sm">
                        <span>All</span>
                        <span class="px-2 py-0.5 text-[11px] rounded-full bg-zinc-700/60 text-zinc-300 font-semibold">{{ $totalCount }}</span>
                    </button>
                    <button onclick="filterWorks('web')" id="btn-web" 
                            class="filter-btn px-4 py-2 text-xs md:text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2 text-zinc-400 hover:text-white border border-transparent">
                        <span>Web Dev</span>
                        <span class="px-2 py-0.5 text-[11px] rounded-full bg-zinc-800/80 text-zinc-400 font-semibold">{{ $webCount }}</span>
                    </button>
                    <button onclick="filterWorks('design')" id="btn-design" 
                            class="filter-btn px-4 py-2 text-xs md:text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2 text-zinc-400 hover:text-white border border-transparent">
                        <span>Design</span>
                        <span class="px-2 py-0.5 text-[11px] rounded-full bg-zinc-800/80 text-zinc-400 font-semibold">{{ $designCount }}</span>
                    </button>
                </div>
            </div>

            <!-- Works List (Grid 1/2/3 cols, equal height h-full) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $index => $project)
                @php
                    $catClass = $project->category === 'Web Dev' ? 'web' : 'design';
                @endphp
                <div class="work-item {{ $catClass }} flex flex-col h-full" data-category="{{ $catClass }}">
                    <x-project-card 
                        :id="$project->id"
                        :views="$project->views"
                        :title="$project->title" 
                        :category="$project->category"
                        :description="$project->description"
                        :link="$project->live_link"
                        :github_link="$project->github_link"
                        :image="$project->cover_image_url"
                        :design_url="$project->design_pdf_url"
                        :has_pdf_cover="$project->has_pdf_cover"
                        :year="$project->year"
                        :tech-stack="$project->tech_stack"
                    />
                </div>
                @endforeach
            </div>
        </main>
        </div>

        <!-- Full-Width Footer (Mentok Kanan Kiri) -->
        <div class="w-full px-6 md:px-10 lg:px-12">
            <x-footer :site-setting="$siteSettingsData" />
        </div>
    </div> 

    <script>
        function filterWorks(category) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.className = 'filter-btn px-4 py-2 text-xs md:text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2 text-zinc-400 hover:text-white border border-transparent';
                const counter = btn.querySelector('span:last-child');
                if (counter) {
                    counter.className = 'px-2 py-0.5 text-[11px] rounded-full bg-zinc-800/80 text-zinc-400 font-semibold';
                }
            });
            const activeBtn = document.getElementById('btn-' + category);
            if (activeBtn) {
                activeBtn.className = 'filter-btn px-4 py-2 text-xs md:text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2 bg-zinc-800 text-white border border-zinc-700 shadow-sm';
                const counter = activeBtn.querySelector('span:last-child');
                if (counter) {
                    counter.className = 'px-2 py-0.5 text-[11px] rounded-full bg-zinc-700/60 text-zinc-300 font-semibold';
                }
            }

            const items = document.querySelectorAll('.work-item');
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = '';
                    item.style.opacity = '0';
                    setTimeout(() => { item.style.transition = 'opacity 0.3s ease'; item.style.opacity = '1'; }, 30);
                } else {
                    item.style.display = 'none';
                }
            });

            if (typeof window.renderAllPdfThumbnails === 'function') {
                setTimeout(window.renderAllPdfThumbnails, 50);
            }
        }

        // Initialize PDF Thumbnails on Project Cards
        function initPdf() {
            if (!window.pdfjsLib) return;
            try {
                const workerBlob = new Blob(
                    ['importScripts("https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js");'],
                    { type: "application/javascript" }
                );
                pdfjsLib.GlobalWorkerOptions.workerSrc = URL.createObjectURL(workerBlob);
            } catch(e) {
                pdfjsLib.GlobalWorkerOptions.workerSrc = '';
            }

            window.renderAllPdfThumbnails = function() {
                const canvases = document.querySelectorAll('canvas[data-pdf-thumb]:not([data-rendered="true"])');
                canvases.forEach(async (canvas) => {
                    const url = canvas.dataset.pdfThumb;
                    if (!url) return;
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
                        canvas.classList.remove('opacity-0');
                        const fallback = canvas.parentElement?.querySelector('.pdf-card-fallback');
                        if (fallback) fallback.style.display = 'none';
                    } catch (e) {
                        console.error('Gagal render thumbnail PDF:', e);
                    }
                });
            };

            window.renderAllPdfThumbnails();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initPdf);
        } else {
            initPdf();
        }
    </script>

    <!-- Project Preview Modal -->
    <x-project-preview-modal />

</body>
</html>
