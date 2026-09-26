<div x-data="projectPreviewModal()"
     x-init="init()"
     @open-project-preview.window="
        show = true; 
        isFullscreen = false;
        showFullscreenDetails = false;
        project = $event.detail;
        if (project.design_url) {
            $nextTick(() => loadProjectPdf(project.design_url));
        }
     "
     @keydown.escape.window="if (isFullscreen) { exitFullscreen(); } else { closeModal(); }"
     @keydown.f.window="if (show && !['INPUT', 'TEXTAREA'].includes($event.target.tagName)) { toggleFullscreen(); }"
     @keydown.arrow-left.window="if (show && project.design_url && pdfTotalPages > 1) { goToPage(currentModalPage - 1); }"
     @keydown.arrow-right.window="if (show && project.design_url && pdfTotalPages > 1) { goToPage(currentModalPage + 1); }"
     x-show="show"
     class="fixed inset-0 z-50 transition-colors duration-300"
     :class="isFullscreen ? 'overflow-hidden' : 'overflow-y-auto'"
     style="display: none;">
     
    <!-- Backdrop Overlay with blur -->
    <div x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/80 backdrop-blur-md"
         @click="!isFullscreen && closeModal()">
    </div>

    <!-- Modal Box Container -->
    <div :class="isFullscreen ? 'fixed inset-0 p-0 m-0 z-50 flex flex-col h-screen w-screen overflow-hidden' : 'flex min-h-screen items-center justify-center p-4 md:p-6 relative'">
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="bg-zinc-950/95 overflow-hidden shadow-2xl z-10 flex flex-col transition-all duration-300"
             :class="isFullscreen ? 'w-full h-full max-w-none max-h-screen rounded-none border-0' : 'relative w-full max-w-4xl border border-zinc-800/80 rounded-3xl max-h-[92vh]'"
             @click.away="!isFullscreen && closeModal()">
             
            <!-- Action buttons absolute top-right -->
            <div class="absolute top-4 right-4 z-30 flex items-center gap-2">
                <!-- Fullscreen Toggle Button -->
                <button type="button"
                        @click="toggleFullscreen()"
                        class="w-8 h-8 rounded-full bg-black/70 border border-zinc-800/80 flex items-center justify-center text-zinc-400 hover:text-white hover:border-blue-500/40 transition-all duration-300 shadow-lg cursor-pointer"
                        :title="isFullscreen ? 'Keluar Layar Penuh (Esc)' : 'Layar Penuh (F)'"
                        :aria-label="isFullscreen ? 'Keluar Fullscreen' : 'Layar Penuh'">
                    <!-- Icon: Enter Fullscreen (Maximize) -->
                    <svg x-show="!isFullscreen" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                    </svg>
                    <!-- Icon: Exit Fullscreen (Minimize) -->
                    <svg x-show="isFullscreen" class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 4v4H5m0 0l5-5M15 4v4h4m0 0l-5-5M9 20v-4H5m0 0l5 5M15 20v-4h4m0 0l-5 5" />
                    </svg>
                </button>

                <!-- Close button -->
                <button @click="closeModal()" 
                        class="w-8 h-8 rounded-full bg-black/70 border border-zinc-800/80 flex items-center justify-center text-zinc-400 hover:text-white hover:border-blue-500/40 transition-all duration-300 shadow-lg cursor-pointer"
                        aria-label="Tutup pratinjau"
                        title="Tutup (Esc)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Header: Category, Views, Title (in fullscreen) & Page Navigator (if PDF) -->
            <div class="border-b border-zinc-900 pr-24 flex flex-col sm:flex-row sm:items-center justify-between gap-3 flex-shrink-0 transition-all duration-300"
                 :class="isFullscreen ? 'py-3.5 px-6 md:px-8 bg-zinc-950' : 'p-6 pb-4'">
                <div class="flex items-center gap-3 min-w-0">
                    <span class="px-3 py-1 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-400 text-[10px] font-bold uppercase tracking-wider flex-shrink-0"
                          x-text="project.category === 'Web Dev' ? 'Web Development' : 'Design Project'">
                    </span>
                    <div class="text-xs text-zinc-400 flex items-center gap-1.5 font-medium flex-shrink-0">
                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <span x-text="project.views ? project.views.toLocaleString('en-US') : 0"></span> views
                    </div>
                    <!-- In Fullscreen, show project title in header -->
                    <span x-show="isFullscreen" class="hidden md:inline-block text-sm font-semibold text-zinc-200 truncate border-l border-zinc-800 pl-3" x-text="project.title"></span>
                </div>

                <!-- Page Navigator when Multi-Page PDF -->
                <div x-show="project.design_url && pdfTotalPages > 1" class="flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1 rounded-full text-xs self-start sm:self-auto flex-shrink-0">
                    <span class="text-zinc-400">Halaman <strong class="text-white" x-text="currentModalPage">1</strong> dari <strong class="text-white" x-text="pdfTotalPages">1</strong></span>
                    <div class="flex items-center gap-1 border-l border-white/10 pl-2">
                        <button type="button" @click="goToPage(currentModalPage - 1)" :disabled="currentModalPage <= 1" class="p-0.5 text-zinc-400 hover:text-white disabled:opacity-30 transition-colors cursor-pointer" title="Sebelumnya (Panah Kiri)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" @click="goToPage(currentModalPage + 1)" :disabled="currentModalPage >= pdfTotalPages" class="p-0.5 text-zinc-400 hover:text-white disabled:opacity-30 transition-colors cursor-pointer" title="Berikutnya (Panah Kanan)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area: Multi-Page Scrollable PDF OR Standard Image Banner -->
            <div class="flex-grow overflow-hidden flex flex-col min-h-0">
                <!-- Case 1: Design Project with PDF Document -->
                <div x-show="project.design_url" 
                     class="w-full h-full flex flex-col min-h-0 transition-all duration-300"
                     :class="isFullscreen ? 'p-2 md:p-4 flex-1' : 'p-4 md:p-6 pb-2'">
                    <div id="project-pdf-scroll-container" 
                         class="w-full flex-grow overflow-y-auto flex flex-col items-center gap-6 py-4 px-2 md:px-6 bg-[#0c0c0e] scroll-smooth custom-scrollbar transition-all duration-300"
                         :class="isFullscreen ? 'max-h-none flex-1 rounded-xl border border-white/5' : 'max-h-[58vh] md:max-h-[64vh] rounded-2xl border border-white/5'">
                        
                        <!-- Loading State -->
                        <div x-show="pdfLoading" class="py-24 flex flex-col items-center justify-center text-zinc-400">
                            <div class="w-10 h-10 border-2 border-blue-500 border-t-transparent rounded-full animate-spin mb-3"></div>
                            <p class="text-sm font-medium text-white">Memuat dokumen desain...</p>
                            <p class="text-xs text-zinc-500 mt-1">Menyiapkan lembaran presentasi</p>
                        </div>

                        <!-- Error State -->
                        <div x-show="pdfError" class="py-16 flex flex-col items-center justify-center text-center p-6" style="display: none;">
                            <div class="w-12 h-12 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-500 mb-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-white mb-1">Gagal menampilkan dokumen di pratinjau</p>
                            <p class="text-xs text-zinc-400 mb-4 max-w-sm">Dokumen dapat dibuka atau diunduh langsung di tab baru browser Anda.</p>
                            <a :href="project.design_url" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-bold transition-all shadow-lg shadow-blue-500/20">
                                <span>Buka Berkas PDF di Tab Baru</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            </a>
                        </div>

                        <!-- Injected PDF Page Canvases -->
                        <div id="project-pdf-pages-list" 
                             class="w-full flex flex-col items-center gap-6"
                             :class="isFullscreen ? 'max-w-5xl xl:max-w-6xl' : ''"></div>
                    </div>
                </div>

                <!-- Case 2: Standard Project (Web Dev or Design without PDF uploaded yet) -->
                <div x-show="!project.design_url" 
                     class="overflow-hidden flex-shrink-0 transition-all duration-300"
                     :class="isFullscreen ? 'flex-1 min-h-0 w-full bg-[#0c0c0e] flex items-center justify-center p-4 md:p-6' : 'relative w-full aspect-[21/9] md:aspect-[21/8] bg-zinc-900 border-b border-zinc-900'">
                    <img :src="project.image" 
                         :alt="project.title"
                         class="transition-all duration-300"
                         :class="isFullscreen ? 'max-h-full max-w-full object-contain rounded-xl shadow-2xl border border-white/5' : 'w-full h-full object-cover opacity-85'"
                         x-show="project.image">
                    <div x-show="!isFullscreen" class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent"></div>
                </div>
            </div>

            <!-- Description & Footer Area -->
            <div :class="isFullscreen ? 'px-6 py-3 border-t border-zinc-900 bg-zinc-950 flex-shrink-0' : 'p-6 md:p-8 pt-4 space-y-4 border-t border-zinc-900 bg-zinc-950/80 flex-shrink-0'">
                <!-- In Normal Mode: Full Title & Description -->
                <div x-show="!isFullscreen">
                    <h3 class="text-xl md:text-2xl font-bold text-white tracking-tight leading-snug mb-2" x-text="project.title"></h3>
                    <!-- Description -->
                    <div class="max-h-[16vh] overflow-y-auto pr-2 border-l-2 border-zinc-800 pl-4 py-0.5 text-zinc-400 text-xs md:text-sm leading-relaxed whitespace-pre-wrap" 
                         x-text="project.description">
                    </div>
                </div>

                <!-- In Fullscreen Mode: Collapsible Info Drawer -->
                <div x-show="isFullscreen && showFullscreenDetails" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="mb-3 p-4 bg-zinc-900/95 rounded-2xl border border-zinc-800 text-zinc-300 text-xs leading-relaxed max-h-[22vh] overflow-y-auto shadow-2xl" 
                     style="display: none;">
                    <h4 class="font-bold text-white text-sm mb-1.5" x-text="project.title"></h4>
                    <p class="whitespace-pre-wrap text-zinc-400 leading-relaxed" x-text="project.description"></p>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-wrap items-center gap-3" :class="!isFullscreen ? 'pt-3 border-t border-zinc-900/80' : ''">
                    <!-- In Fullscreen: Info toggle button -->
                    <button x-show="isFullscreen" 
                            @click="showFullscreenDetails = !showFullscreenDetails"
                            type="button"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-zinc-900 border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 text-zinc-300 hover:text-white text-xs font-semibold transition-all duration-300 cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span x-text="showFullscreenDetails ? 'Tutup Info' : 'Info Project'"></span>
                    </button>

                    <!-- If Web Dev: Visit Website -->
                    <a :href="project.link" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/35 hover:-translate-y-0.5"
                       x-show="project.category === 'Web Dev' && project.link && project.link !== '#'">
                        <span>Visit Website</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>

                    <!-- If Web Dev: GitHub -->
                    <a :href="project.github" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-zinc-900 border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 text-zinc-300 hover:text-white text-sm font-bold rounded-xl transition-all duration-300 hover:-translate-y-0.5"
                       x-show="project.category === 'Web Dev' && project.github">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                        </svg>
                        GitHub
                    </a>

                    <!-- If Design & has fallback link (e.g. Google Drive/Figma) -->
                    <a :href="project.link" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-zinc-900 border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 text-zinc-300 hover:text-white text-xs font-semibold rounded-xl transition-all duration-300 hover:-translate-y-0.5"
                       x-show="project.category === 'Design' && project.link && project.link !== '#'">
                        <span>Buka Sumber / Google Drive</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    </a>

                    <!-- Fullscreen Toggle button in footer -->
                    <button @click="toggleFullscreen()"
                            type="button"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-zinc-900 border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 hover:text-white text-zinc-300 text-xs md:text-sm font-semibold rounded-xl transition-all duration-300 ml-auto cursor-pointer"
                            :title="isFullscreen ? 'Keluar Layar Penuh (Esc)' : 'Layar Penuh (F)'">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="isFullscreen ? 'M9 4v4H5m0 0l5-5M15 4v4h4m0 0l-5-5M9 20v-4H5m0 0l5 5M15 20v-4h4m0 0l-5 5' : 'M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4'" />
                        </svg>
                        <span x-text="isFullscreen ? 'Perkecil' : 'Layar Penuh'"></span>
                    </button>

                    <!-- Close Button -->
                    <button @click="closeModal()" 
                            class="inline-flex items-center justify-center px-5 py-2.5 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 hover:text-white text-zinc-400 text-sm font-semibold rounded-xl transition-all duration-300 cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function projectPreviewModal() {
        return {
            show: false,
            isFullscreen: false,
            showFullscreenDetails: false,
            project: {
                title: '',
                category: '',
                description: '',
                link: '#',
                github: null,
                image: '',
                design_url: null,
                views: 0
            },
            pdfLoading: false,
            pdfError: false,
            pdfTotalPages: 1,
            currentModalPage: 1,

            init() {
                const onFullscreenChange = () => {
                    this.isFullscreen = !!(document.fullscreenElement || document.webkitFullscreenElement);
                };
                document.addEventListener('fullscreenchange', onFullscreenChange);
                document.addEventListener('webkitfullscreenchange', onFullscreenChange);
            },

            toggleFullscreen() {
                if (!this.isFullscreen) {
                    this.enterFullscreen();
                } else {
                    this.exitFullscreen();
                }
            },

            enterFullscreen() {
                this.isFullscreen = true;
                const docEl = document.documentElement;
                try {
                    if (docEl.requestFullscreen) {
                        docEl.requestFullscreen().catch(() => {});
                    } else if (docEl.webkitRequestFullscreen) {
                        docEl.webkitRequestFullscreen();
                    }
                } catch (e) {
                    // Fallback to CSS fullscreen
                }
            },

            exitFullscreen() {
                this.isFullscreen = false;
                try {
                    if (document.fullscreenElement || document.webkitFullscreenElement) {
                        if (document.exitFullscreen) {
                            document.exitFullscreen().catch(() => {});
                        } else if (document.webkitExitFullscreen) {
                            document.webkitExitFullscreen();
                        }
                    }
                } catch (e) {
                    // Fallback to CSS fullscreen
                }
            },

            async loadProjectPdf(url) {
                if (!url || !window.pdfjsLib) return;
                this.pdfLoading = true;
                this.pdfError = false;
                this.pdfTotalPages = 1;
                this.currentModalPage = 1;

                const container = document.getElementById('project-pdf-pages-list');
                if (container) container.innerHTML = '';

                try {
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

                    const pdf = await pdfjsLib.getDocument({
                        url: url,
                        cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                        cMapPacked: true
                    }).promise;
                    this.pdfTotalPages = pdf.numPages;
                    this.pdfLoading = false;

                    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                        const page = await pdf.getPage(pageNum);
                        const parentW = Math.max(container.clientWidth || 0, 1000);
                        const unscaled = page.getViewport({ scale: 1.0 });
                        const dpr = Math.min(window.devicePixelRatio || 1.5, 2.5);
                        const scale = (parentW * dpr) / unscaled.width;
                        const viewport = page.getViewport({ scale: scale });

                        const card = document.createElement('div');
                        card.className = 'project-pdf-modal-page w-full flex flex-col items-center bg-zinc-900/60 rounded-xl overflow-hidden border border-white/5 shadow-2xl';
                        card.dataset.page = pageNum;

                        const canvas = document.createElement('canvas');
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;
                        canvas.className = 'w-full h-auto object-contain block select-none';

                        const ctx = canvas.getContext('2d');
                        await page.render({ canvasContext: ctx, viewport: viewport }).promise;

                        card.appendChild(canvas);

                        const footer = document.createElement('div');
                        footer.className = 'w-full py-2 px-4 bg-black/60 border-t border-white/5 flex items-center justify-between text-[11px] text-gray-400 font-mono';
                        footer.innerHTML = `<span>Halaman ${pageNum} dari ${pdf.numPages}</span><span class="text-[10px] text-gray-500 uppercase tracking-wider font-bold">${this.project.title}</span>`;
                        card.appendChild(footer);

                        container.appendChild(card);
                    }

                    this.setupScrollObserver();
                } catch (err) {
                    console.error('Gagal memuat dokumen desain PDF:', err);
                    this.pdfLoading = false;
                    this.pdfError = true;
                }
            },

            setupScrollObserver() {
                const scrollContainer = document.getElementById('project-pdf-scroll-container');
                if (!scrollContainer) return;

                const pages = scrollContainer.querySelectorAll('.project-pdf-modal-page');
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
                const target = document.querySelector(`.project-pdf-modal-page[data-page='${pageNum}']`);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            },

            closeModal() {
                if (this.isFullscreen) {
                    this.exitFullscreen();
                }
                this.show = false;
                this.showFullscreenDetails = false;
                const container = document.getElementById('project-pdf-pages-list');
                if (container) container.innerHTML = '';
            }
        };
    }
</script>
