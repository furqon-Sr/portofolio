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
            <div class="mb-16 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Selected <span class="text-blue-600">Works</span></h1>
            </div>

            <!-- Filter Buttons & PDF Download -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/5 pb-3 md:pb-2 mb-12">
                <div class="flex gap-6 justify-center md:justify-start">
                    <button onclick="filterWorks('all')" id="btn-all" class="filter-btn pb-2 text-sm font-medium tracking-tight border-b-2 border-blue-600 text-white transition-all">All</button>
                    <button onclick="filterWorks('web')" id="btn-web" class="filter-btn pb-2 text-sm font-medium tracking-tight border-b-2 border-transparent text-gray-500 hover:text-white transition-all">Web Dev</button>
                    <button onclick="filterWorks('design')" id="btn-design" class="filter-btn pb-2 text-sm font-medium tracking-tight border-b-2 border-transparent text-gray-500 hover:text-white transition-all">Design</button>
                </div>

                @if(!empty($siteSettingsData?->design_portfolio_pdf_path))
                <div class="flex items-center justify-center md:justify-end pb-2 sm:pb-0">
                    <a href="{{ route('portfolio.design.download') }}" target="_blank" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold bg-white/[0.04] hover:bg-blue-600 border border-white/10 hover:border-blue-500 text-gray-300 hover:text-white transition-all duration-300 shadow-lg group hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Unduh Portfolio Desain</span>
                        @if(!empty($siteSettingsData->design_portfolio_pdf_size_formatted))
                            <span class="text-[10px] text-gray-500 group-hover:text-blue-100 font-mono">({{ $siteSettingsData->design_portfolio_pdf_size_formatted }})</span>
                        @endif
                    </a>
                </div>
                @endif
            </div>

            <!-- Works List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $index => $project)
                @php
                    $catClass = $project->category === 'Web Dev' ? 'web' : 'design';
                @endphp
                <div class="work-item {{ $catClass }} flex flex-col h-full" data-category="{{ $catClass }}">
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
                btn.classList.remove('border-blue-600', 'text-white');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            const activeBtn = document.getElementById('btn-' + category);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-blue-600', 'text-white');

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
                        if (fallback) {
                            fallback.style.transition = 'opacity 0.4s ease-out';
                            fallback.style.opacity = '0';
                            setTimeout(() => { fallback.style.display = 'none'; }, 400);
                        }
                    } catch (e) {
                        console.error('Gagal render thumbnail PDF:', e);
                        const fallback = canvas.parentElement?.querySelector('.pdf-card-fallback');
                        if (fallback) {
                            fallback.innerHTML = `
                                <div class="relative flex flex-col items-center justify-center gap-2 z-10 text-zinc-500">
                                    <svg class="w-8 h-8 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-[10px] font-mono tracking-wider text-zinc-500 uppercase">Dokumen PDF</span>
                                </div>
                            `;
                        }
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
