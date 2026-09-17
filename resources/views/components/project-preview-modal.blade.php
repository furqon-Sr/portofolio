<div x-data="{ 
        show: false, 
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
        pdfTotalPages: 1,
        currentModalPage: 1,

        async loadProjectPdf(url) {
            if (!url || !window.pdfjsLib) return;
            this.pdfLoading = true;
            this.pdfTotalPages = 1;
            this.currentModalPage = 1;

            const container = document.getElementById('project-pdf-pages-list');
            if (container) container.innerHTML = '';

            try {
                if (!pdfjsLib.GlobalWorkerOptions.workerSrc) {
                    try {
                        const workerBlob = new Blob(
                            ['importScripts(\"https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js\");'],
                            { type: \"application/javascript\" }
                        );
                        pdfjsLib.GlobalWorkerOptions.workerSrc = URL.createObjectURL(workerBlob);
                    } catch(e) {
                        pdfjsLib.GlobalWorkerOptions.workerSrc = '';
                    }
                }

                const pdf = await pdfjsLib.getDocument(url).promise;
                this.pdfTotalPages = pdf.numPages;
                this.pdfLoading = false;

                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);
                    const parentW = container.clientWidth || 700;
                    const unscaled = page.getViewport({ scale: 1.0 });
                    const dpr = Math.min(window.devicePixelRatio || 1.5, 2);
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
                    footer.innerHTML = `<span>Halaman ${pageNum} dari ${pdf.numPages}</span><span class='text-[10px] text-gray-500 uppercase tracking-wider font-bold'>${this.project.title}</span>`;
                    card.appendChild(footer);

                    container.appendChild(card);
                }

                this.setupScrollObserver();
            } catch (err) {
                console.error('Gagal memuat dokumen desain PDF:', err);
                this.pdfLoading = false;
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
            this.show = false;
            const container = document.getElementById('project-pdf-pages-list');
            if (container) container.innerHTML = '';
        }
     }"
     @open-project-preview.window="
        show = true; 
        project = $event.detail;
        if (project.design_url) {
            $nextTick(() => loadProjectPdf(project.design_url));
        }
     "
     @keydown.escape.window="closeModal()"
     x-show="show"
     class="fixed inset-0 z-50 overflow-y-auto"
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
         @click="closeModal()">
    </div>

    <!-- Modal Box Container -->
    <div class="flex min-h-screen items-center justify-center p-4 md:p-6 relative">
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative w-full max-w-4xl bg-zinc-950/95 border border-zinc-800/80 rounded-3xl overflow-hidden shadow-2xl z-10 flex flex-col max-h-[92vh]"
             @click.away="closeModal()">
             
            <!-- Close button absolute top-right -->
            <button @click="closeModal()" 
                    class="absolute top-4 right-4 z-30 w-8 h-8 rounded-full bg-black/70 border border-zinc-800/80 flex items-center justify-center text-zinc-400 hover:text-white hover:border-blue-500/40 transition-all duration-300 shadow-lg"
                    aria-label="Close modal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Header: Category, Views & Page Navigator (if PDF) -->
            <div class="p-6 pb-4 border-b border-zinc-900 pr-14 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-400 text-[10px] font-bold uppercase tracking-wider"
                          x-text="project.category === 'Web Dev' ? 'Web Development' : 'Design Project'">
                    </span>
                    <div class="text-xs text-zinc-400 flex items-center gap-1.5 font-medium">
                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <span x-text="project.views ? project.views.toLocaleString('en-US') : 0"></span> views
                    </div>
                </div>

                <!-- Page Navigator when Multi-Page PDF -->
                <div x-show="project.design_url && pdfTotalPages > 1" class="flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1 rounded-full text-xs self-start sm:self-auto">
                    <span class="text-zinc-400">Halaman <strong class="text-white" x-text="currentModalPage">1</strong> dari <strong class="text-white" x-text="pdfTotalPages">1</strong></span>
                    <div class="flex items-center gap-1 border-l border-white/10 pl-2">
                        <button type="button" @click="goToPage(currentModalPage - 1)" :disabled="currentModalPage <= 1" class="p-0.5 text-zinc-400 hover:text-white disabled:opacity-30 transition-colors" title="Sebelumnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" @click="goToPage(currentModalPage + 1)" :disabled="currentModalPage >= pdfTotalPages" class="p-0.5 text-zinc-400 hover:text-white disabled:opacity-30 transition-colors" title="Berikutnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area: Multi-Page Scrollable PDF OR Standard Image Banner -->
            <div class="flex-grow overflow-hidden flex flex-col">
                <!-- Case 1: Design Project with PDF Document -->
                <div x-show="project.design_url" class="w-full h-full flex flex-col p-4 md:p-6 pb-2">
                    <div id="project-pdf-scroll-container" 
                         class="w-full flex-grow overflow-y-auto max-h-[58vh] md:max-h-[64vh] flex flex-col items-center gap-6 py-4 px-2 md:px-6 bg-[#0c0c0e] rounded-2xl border border-white/5 scroll-smooth custom-scrollbar">
                        
                        <!-- Loading State -->
                        <div x-show="pdfLoading" class="py-24 flex flex-col items-center justify-center text-zinc-400">
                            <div class="w-10 h-10 border-2 border-blue-500 border-t-transparent rounded-full animate-spin mb-3"></div>
                            <p class="text-sm font-medium text-white">Memuat dokumen desain...</p>
                            <p class="text-xs text-zinc-500 mt-1">Menyiapkan lembaran presentasi</p>
                        </div>

                        <!-- Injected PDF Page Canvases -->
                        <div id="project-pdf-pages-list" class="w-full flex flex-col items-center gap-6"></div>
                    </div>
                </div>

                <!-- Case 2: Standard Project (Web Dev or Design without PDF uploaded yet) -->
                <div x-show="!project.design_url" class="relative w-full aspect-[21/9] md:aspect-[21/8] bg-zinc-900 overflow-hidden border-b border-zinc-900 flex-shrink-0">
                    <img :src="project.image" 
                         :alt="project.title"
                         class="w-full h-full object-cover opacity-85"
                         x-show="project.image">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent"></div>
                </div>
            </div>

            <!-- Description & Footer Area -->
            <div class="p-6 md:p-8 pt-4 space-y-4 border-t border-zinc-900 bg-zinc-950/80">
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-white tracking-tight leading-snug mb-2" x-text="project.title"></h3>
                    <!-- Description -->
                    <div class="max-h-[16vh] overflow-y-auto pr-2 border-l-2 border-zinc-800 pl-4 py-0.5 text-zinc-400 text-xs md:text-sm leading-relaxed whitespace-pre-wrap" 
                         x-text="project.description">
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-wrap items-center gap-3 pt-3 border-t border-zinc-900/80">
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

                    <!-- Close Button -->
                    <button @click="closeModal()" 
                            class="inline-flex items-center justify-center px-5 py-2.5 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 hover:text-white text-zinc-400 text-sm font-semibold rounded-xl transition-all duration-300 ml-auto">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
