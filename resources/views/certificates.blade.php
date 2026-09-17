<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://fahrurihanafi.site/certificates" />
    @php 
        $siteSettingsData = $siteSetting ?? \App\Models\AboutSetting::first(); 
        $logoText = $siteSettingsData->footer_name ?? 'Hanafi';
    @endphp
    <title>Certificates | {{ $logoText }}</title>

    <!-- Open Graph / WhatsApp & LinkedIn -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://fahrurihanafi.site/certificates" />
    <meta property="og:title" content="Certificates & Credentials | Fahruri Hanafi" />
    <meta property="og:description" content="Portfolio of Fahruri Hanafi - Bridging design and code to solve real business problems." />
    <meta property="og:image" content="https://fahrurihanafi.site/og-image.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Certificates & Credentials | Fahruri Hanafi" />
    <meta name="twitter:description" content="Portfolio of Fahruri Hanafi - Bridging design and code to solve real business problems." />
    <meta name="twitter:image" content="https://fahrurihanafi.site/og-image.jpg" />

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
            0% { opacity: 0; transform: translateY(35px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        /* Custom Modern Scrollbar for LinkedIn-style PDF reader */
        .custom-scrollbar::-webkit-scrollbar {
            width: 7px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white"
      x-data="certificateViewer()">

    <!-- Ambient Glowing Backdrop -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[20%] w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-[120px]"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-between">
        <!-- Full-Width Navigation (Mentok Kanan Kiri) -->
        <div class="w-full px-6 md:px-10 lg:px-12 pt-2">
            <x-navigation />
        </div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8 w-full flex-grow">
            <main class="pt-16 pb-32 animate-slide-up">
            <!-- Header Section -->
            <div class="mb-12 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">My <span class="text-blue-600">Certificates</span></h1>
                <p class="text-gray-400 text-sm md:text-lg">A showcase of my professional qualifications, course completions, and technical credentials.</p>
            </div>

            <!-- Certificates Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                @forelse($certificates as $index => $cert)
                @php
                    $isPdf = Str::startsWith($cert->image, 'data:application/pdf') || Str::endsWith(strtolower($cert->image), '.pdf');
                    $imgUrl = Str::startsWith($cert->image, 'data:') ? route('media.certificate', [$cert->id, 'v' => $cert->updated_at?->timestamp ?? 1]) : (Str::startsWith($cert->image, 'http') ? $cert->image : asset('img/' . $cert->image));
                    $num = sprintf("%02d", $index + 1);
                @endphp
                <div class="cursor-pointer group flex flex-col justify-between bg-[#111111]/40 border border-gray-800/60 rounded-2xl p-4 transition-all duration-500 hover:border-blue-500/40 hover:shadow-2xl hover:shadow-blue-500/5 h-full"
                     @click="openModal('{{ $imgUrl }}', '{{ addslashes($cert->name) }}', {{ $isPdf ? 'true' : 'false' }})">
                    
                    <div>
                        <!-- Clickable Image / PDF Area -->
                        <div class="block aspect-[16/10] bg-[#1a1a1a] border border-gray-800/80 rounded-xl overflow-hidden relative mb-4 transition-all duration-500 group-hover:border-blue-500/30">
                            @if($isPdf)
                            <!-- Interactive PDF Document Card (LinkedIn Style Carousel) -->
                            <div class="pdf-card-wrapper w-full h-full relative overflow-hidden" 
                                 data-pdf-url="{{ $imgUrl }}" 
                                 data-title="{{ addslashes($cert->name) }}">
                                
                                <canvas class="pdf-card-canvas w-full h-full object-cover opacity-0 transition-opacity duration-300"></canvas>
                                
                                <!-- Loading / Fallback placeholder -->
                                <div class="pdf-card-fallback absolute inset-0 w-full h-full bg-gradient-to-br from-[#1c1515] via-[#141010] to-[#0e0e10] flex flex-col items-center justify-center p-4">
                                    <div class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center justify-center mb-1.5 shadow-lg shadow-red-500/5 animate-pulse">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                                    </div>
                                    <span class="text-[10px] text-gray-400 font-medium">Memuat pratinjau...</span>
                                </div>

                                <!-- Page indicator badge (only if multi-page e.g. "1 / 3", hidden for single page) -->
                                <div class="pdf-card-badge absolute top-2.5 right-2.5 bg-black/75 backdrop-blur border border-white/10 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md shadow-lg z-10 pointer-events-none hidden">
                                    <span class="pdf-card-page-label"></span>
                                </div>

                                <!-- LinkedIn Style Card Flip Arrows (if multi-page) -->
                                <button type="button" 
                                        @click.stop="cardPrevPage($event)" 
                                        class="pdf-card-prev absolute left-2 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-black/85 hover:bg-black text-white border border-white/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all z-20 hidden shadow-xl" 
                                        title="Halaman sebelumnya">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button type="button" 
                                        @click.stop="cardNextPage($event)" 
                                        class="pdf-card-next absolute right-2 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-black/85 hover:bg-black text-white border border-white/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all z-20 hidden shadow-xl" 
                                        title="Halaman selanjutnya">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                            @else
                            <img src="{{ $imgUrl }}" alt="{{ $cert->name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-75">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-transparent to-transparent opacity-85 group-hover:opacity-70 transition-opacity duration-500"></div>
                            @endif
                            
                            <!-- Zoom Icon Overlay (unified blue magnifying glass) -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                <div class="p-3 bg-blue-600 shadow-blue-500/30 rounded-full text-white shadow-lg scale-90 group-hover:scale-100 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Details & Info -->
                        <div class="space-y-2">
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="text-white font-bold text-sm md:text-base leading-tight group-hover:text-blue-500 transition-colors">{{ $cert->name }}</h4>
                                <span class="text-blue-500 text-[10px] font-bold uppercase tracking-wider flex-shrink-0 mt-0.5">{{ $num }}</span>
                            </div>
                            <div class="text-xs text-gray-400 font-semibold">{{ $cert->issuer }}</div>
                            <div class="text-[10px] text-gray-500 tracking-wide uppercase font-bold">Terbit: {{ $cert->issued_at }}</div>
                            @if($cert->credential_id)
                            <div class="text-[9px] text-gray-600 bg-white/[0.02] border border-white/5 py-1 px-2 rounded-md inline-block">ID: {{ $cert->credential_id }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    @if($cert->credential_url)
                    <div class="flex items-center gap-4 pt-3 mt-4 border-t border-white/5 text-xs font-semibold">
                        <a href="{{ $cert->credential_url }}" target="_blank" @click.stop class="text-white hover:text-blue-500 flex items-center gap-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            Verifikasi Kredensial
                        </a>
                    </div>
                    @endif

                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    <p class="text-gray-500 text-lg">Belum ada sertifikat kompetensi yang terunggah.</p>
                </div>
                @endforelse
            </div>
        </main>
        </div>

        <!-- Full-Width Footer (Mentok Kanan Kiri) -->
        <div class="w-full px-6 md:px-10 lg:px-12">
            <x-footer />
        </div>
    </div>

    <!-- Certificate Zoom Modal (LinkedIn Style Document Reader) -->
    <div x-show="zoomOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         class="fixed inset-0 z-[100] flex items-center justify-center p-3 md:p-6 bg-black/90 backdrop-blur-md"
         @click="closeModal()"
         @keydown.escape.window="closeModal()">
        
        <div class="relative max-w-4xl w-full max-h-[92vh] bg-[#111113] border border-gray-800 rounded-3xl p-4 md:p-6 overflow-hidden shadow-2xl flex flex-col items-center"
             @click.stop>
            
            <!-- Close Button -->
            <button @click="closeModal()" 
                    class="absolute top-4 right-4 p-2 rounded-full bg-white/5 border border-white/5 hover:border-white/20 text-gray-400 hover:text-white transition-all z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            <!-- Header: Title & LinkedIn Style Page Indicator -->
            <div class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-2 pb-4 border-b border-gray-800 mb-4 pr-12">
                <h3 class="text-white font-bold text-base md:text-lg leading-tight truncate" x-text="zoomTitle"></h3>
                
                <!-- LinkedIn Style Page Navigator (when PDF) -->
                <div x-show="isPdf && pdfTotalPages > 1" class="flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1 rounded-full text-xs self-start md:self-auto">
                    <span class="text-gray-400">Halaman <strong class="text-white" x-text="currentModalPage">1</strong> dari <strong class="text-white" x-text="pdfTotalPages">1</strong></span>
                    <div class="flex items-center gap-1 border-l border-white/10 pl-2">
                        <button type="button" @click="goToPage(currentModalPage - 1)" :disabled="currentModalPage <= 1" class="p-0.5 text-gray-400 hover:text-white disabled:opacity-30 disabled:hover:text-gray-400 transition-colors" title="Halaman Sebelumnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" @click="goToPage(currentModalPage + 1)" :disabled="currentModalPage >= pdfTotalPages" class="p-0.5 text-gray-400 hover:text-white disabled:opacity-30 disabled:hover:text-gray-400 transition-colors" title="Halaman Selanjutnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area: Scrollable PDF Reader or Image -->
            <div class="w-full flex-grow flex items-center justify-center overflow-hidden rounded-2xl bg-black min-h-[320px]">
                
                <!-- If PDF: LinkedIn Style Continuous Scrollable Viewer -->
                <div x-show="isPdf" class="w-full h-full flex flex-col">
                    <div id="pdf-scroll-container" 
                         class="w-full flex-grow overflow-y-auto max-h-[64vh] flex flex-col items-center gap-6 py-4 px-2 md:px-6 bg-[#0c0c0e] rounded-2xl border border-white/5 scroll-smooth custom-scrollbar">
                        
                        <!-- Loading State -->
                        <div x-show="pdfLoading" class="py-20 flex flex-col items-center justify-center text-gray-400">
                            <div class="w-10 h-10 border-2 border-red-500 border-t-transparent rounded-full animate-spin mb-3"></div>
                            <p class="text-sm font-medium">Memuat dokumen PDF...</p>
                            <p class="text-xs text-gray-500 mt-1">Halaman dapat di-scroll seperti di LinkedIn</p>
                        </div>

                        <!-- Injected PDF Page Canvases -->
                        <div id="pdf-pages-list" class="w-full flex flex-col items-center gap-6"></div>
                    </div>
                </div>

                <!-- If Standard Image -->
                <div x-show="!isPdf" class="w-full flex items-center justify-center p-2">
                    <img :src="zoomImage" :alt="zoomTitle" class="max-w-full max-h-[70vh] object-contain select-none rounded-xl">
                </div>

            </div>

            <!-- PDF Action Buttons & Scroll Hint -->
            <div x-show="isPdf" class="w-full flex flex-col sm:flex-row items-center justify-between gap-3 mt-4 pt-3 border-t border-gray-800/80">
                <p class="text-[11px] text-gray-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                    <span>Gulir / scroll ke bawah untuk membaca seluruh halaman dokumen</span>
                </p>
                <div class="flex items-center gap-2">
                    <a :href="zoomImage" target="_blank" class="px-3.5 py-1.5 bg-red-600 hover:bg-red-500 text-white rounded-xl text-xs font-semibold flex items-center gap-1.5 transition-all shadow-lg shadow-red-600/20">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        Buka Tab Baru
                    </a>
                    <a :href="zoomImage" download="sertifikat.pdf" class="px-3.5 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 text-white rounded-xl text-xs font-semibold flex items-center gap-1.5 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        Download PDF
                    </a>
                </div>
            </div>

            <!-- Footnote -->
            <p class="text-[10px] text-gray-500 mt-2">Tekan ESC atau klik di luar untuk menutup</p>

        </div>
    </div>

    <!-- PDF.js Integration & LinkedIn Document Viewer Script -->
    <script>
        function initPdfWorker() {
            if (!window.pdfjsLib) return;
            if (!pdfjsLib.GlobalWorkerOptions.workerSrc) {
                try {
                    const workerBlob = new Blob(
                        ['importScripts("https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js");'],
                        { type: "application/javascript" }
                    );
                    pdfjsLib.GlobalWorkerOptions.workerSrc = URL.createObjectURL(workerBlob);
                } catch(e) {
                    pdfjsLib.GlobalWorkerOptions.workerSrc = '';
                }
            }
        }

        function certificateViewer() {
            return {
                zoomOpen: false,
                zoomImage: '',
                zoomTitle: '',
                isPdf: false,
                pdfLoading: false,
                pdfTotalPages: 1,
                currentModalPage: 1,

                openModal(url, title, isPdfDoc) {
                    this.zoomImage = url;
                    this.zoomTitle = title;
                    this.isPdf = isPdfDoc;
                    this.zoomOpen = true;
                    this.currentModalPage = 1;
                    this.pdfTotalPages = 1;

                    if (isPdfDoc) {
                        this.loadPdfInModal(url, title);
                    }
                },

                closeModal() {
                    this.zoomOpen = false;
                    const container = document.getElementById('pdf-pages-list');
                    if (container) container.innerHTML = '';
                },

                async loadPdfInModal(url, title) {
                    this.pdfLoading = true;
                    const container = document.getElementById('pdf-pages-list');
                    if (container) container.innerHTML = '';

                    try {
                        initPdfWorker();
                        const loadingTask = pdfjsLib.getDocument(url);
                        const pdf = await loadingTask.promise;
                        this.pdfTotalPages = pdf.numPages;
                        this.pdfLoading = false;

                        const scrollContainer = document.getElementById('pdf-scroll-container');

                        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                            const page = await pdf.getPage(pageNum);
                            
                            const card = document.createElement('div');
                            card.className = 'pdf-modal-page relative bg-white shadow-2xl rounded-xl overflow-hidden max-w-full flex flex-col items-center border border-white/10 transition-all';
                            card.dataset.page = pageNum;

                            const canvas = document.createElement('canvas');
                            canvas.className = 'block max-w-full h-auto';

                            const parentW = Math.min((scrollContainer ? scrollContainer.clientWidth : 750) - 48, 800);
                            const unscaled = page.getViewport({ scale: 1.0 });
                            const dpr = Math.min(window.devicePixelRatio || 1.5, 2);
                            const scale = (parentW * dpr) / unscaled.width;
                            const viewport = page.getViewport({ scale: scale });

                            canvas.width = viewport.width;
                            canvas.height = viewport.height;
                            canvas.style.width = (viewport.width / dpr) + 'px';
                            canvas.style.height = (viewport.height / dpr) + 'px';

                            const ctx = canvas.getContext('2d');
                            await page.render({ canvasContext: ctx, viewport: viewport }).promise;

                            // Page Footer Info
                            const footer = document.createElement('div');
                            footer.className = 'w-full py-1.5 px-3 bg-gray-900 text-gray-300 text-[11px] font-medium flex justify-between items-center border-t border-gray-800 select-none';
                            footer.innerHTML = `<span>Halaman ${pageNum} dari ${pdf.numPages}</span><span class='text-[10px] text-gray-500 uppercase tracking-wider font-bold'>${title}</span>`;

                            card.appendChild(canvas);
                            card.appendChild(footer);
                            container.appendChild(card);
                        }

                        this.setupScrollObserver();

                    } catch (err) {
                        console.error('Gagal memuat dokumen PDF:', err);
                        this.pdfLoading = false;
                    }
                },

                setupScrollObserver() {
                    const scrollContainer = document.getElementById('pdf-scroll-container');
                    if (!scrollContainer) return;

                    const pages = scrollContainer.querySelectorAll('.pdf-modal-page');
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting && entry.intersectionRatio >= 0.4) {
                                this.currentModalPage = parseInt(entry.target.dataset.page, 10);
                            }
                        });
                    }, {
                        root: scrollContainer,
                        threshold: [0.4, 0.7]
                    });

                    pages.forEach((p) => observer.observe(p));
                },

                goToPage(pageNum) {
                    if (pageNum < 1 || pageNum > this.pdfTotalPages) return;
                    this.currentModalPage = pageNum;
                    const target = document.querySelector(`.pdf-modal-page[data-page='${pageNum}']`);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                },

                cardPrevPage(e) {
                    const wrapper = e.currentTarget.closest('.pdf-card-wrapper');
                    if (wrapper && wrapper._pdfState) {
                        wrapper._pdfState.prev();
                    }
                },

                cardNextPage(e) {
                    const wrapper = e.currentTarget.closest('.pdf-card-wrapper');
                    if (wrapper && wrapper._pdfState) {
                        wrapper._pdfState.next();
                    }
                }
            };
        }

        // Initialize PDF previews on cards
        document.addEventListener('DOMContentLoaded', () => {
            initPdfWorker();
            initCardThumbnails();
        });

        function initCardThumbnails() {
            if (!window.pdfjsLib) return;

            const cards = document.querySelectorAll('.pdf-card-wrapper');
            cards.forEach(async (wrapper) => {
                const url = wrapper.dataset.pdfUrl;
                if (!url) return;

                const canvas = wrapper.querySelector('.pdf-card-canvas');
                const fallback = wrapper.querySelector('.pdf-card-fallback');
                const indicator = wrapper.querySelector('.pdf-card-page-label');
                const prevBtn = wrapper.querySelector('.pdf-card-prev');
                const nextBtn = wrapper.querySelector('.pdf-card-next');

                try {
                    const pdf = await pdfjsLib.getDocument(url).promise;
                    let currentPage = 1;
                    const numPages = pdf.numPages;

                    const renderPage = async (pageNumber) => {
                        const page = await pdf.getPage(pageNumber);
                        const parentW = wrapper.clientWidth || 360;
                        const unscaled = page.getViewport({ scale: 1.0 });
                        const dpr = Math.min(window.devicePixelRatio || 1.5, 2);
                        const scale = (parentW * dpr) / unscaled.width;
                        const viewport = page.getViewport({ scale: scale });

                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        const ctx = canvas.getContext('2d');
                        await page.render({ canvasContext: ctx, viewport: viewport }).promise;

                        canvas.classList.remove('opacity-0');
                        if (fallback) fallback.style.display = 'none';

                        if (indicator) {
                            if (numPages > 1) {
                                indicator.textContent = `${pageNumber} / ${numPages}`;
                                indicator.parentElement.classList.remove('hidden');
                            } else {
                                indicator.parentElement.classList.add('hidden');
                            }
                        }
                    };

                    await renderPage(1);

                    if (numPages > 1) {
                        if (prevBtn) prevBtn.classList.remove('hidden');
                        if (nextBtn) nextBtn.classList.remove('hidden');

                        wrapper._pdfState = {
                            prev: () => {
                                currentPage = currentPage > 1 ? currentPage - 1 : numPages;
                                renderPage(currentPage);
                            },
                            next: () => {
                                currentPage = currentPage < numPages ? currentPage + 1 : 1;
                                renderPage(currentPage);
                            }
                        };

                        // Touch swipe navigation for mobile
                        let touchStartX = 0;
                        wrapper.addEventListener('touchstart', (e) => {
                            touchStartX = e.touches[0].clientX;
                        }, { passive: true });
                        wrapper.addEventListener('touchend', (e) => {
                            const touchEndX = e.changedTouches[0].clientX;
                            const diff = touchEndX - touchStartX;
                            if (diff > 45) wrapper._pdfState.prev();
                            if (diff < -45) wrapper._pdfState.next();
                        }, { passive: true });
                    }
                } catch (err) {
                    console.error('Gagal render kartu PDF:', err);
                }
            });
        }
    </script>

</body>
</html>
