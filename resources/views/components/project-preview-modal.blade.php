<div x-data="{ 
        show: false, 
        project: {
            title: '',
            category: '',
            description: '',
            link: '#',
            github: null,
            image: '',
            number: '01'
        }
     }"
     @open-project-preview.window="show = true; project = $event.detail"
     @keydown.escape.window="show = false"
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
         @click="show = false">
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
             class="relative w-full max-w-3xl bg-zinc-950/95 border border-zinc-800/80 rounded-3xl overflow-hidden shadow-2xl z-10"
             @click.away="show = false">
             
            <!-- Close button absolute top-right -->
            <button @click="show = false" 
                    class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-black/60 border border-zinc-800/80 flex items-center justify-center text-zinc-400 hover:text-white hover:border-blue-500/40 transition-all duration-300"
                    aria-label="Close modal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Hero Image Banner -->
            <div class="relative w-full aspect-[21/9] md:aspect-[21/8] bg-zinc-900 overflow-hidden border-b border-zinc-900">
                <img :src="project.image" 
                     :alt="project.title"
                     class="w-full h-full object-cover opacity-80"
                     x-show="project.image">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent"></div>
            </div>

            <!-- Content Area -->
            <div class="p-6 md:p-8 space-y-6">
                <!-- Category and Title -->
                <div>
                    <div class="flex items-center justify-between gap-4 mb-2">
                        <span class="px-3 py-1 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-400 text-[10px] font-bold uppercase tracking-wider"
                              x-text="project.category === 'Web Dev' ? 'Web Development' : 'Design Project'">
                        </span>
                        <span class="text-zinc-600 font-bold text-xs" x-text="'#' + project.number"></span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-white tracking-tight leading-tight" x-text="project.title"></h3>
                </div>

                <!-- Scrollable Description to handle long text gracefully -->
                <div class="max-h-[30vh] overflow-y-auto pr-2 border-l-2 border-zinc-800 pl-4 py-1 text-zinc-400 text-sm md:text-base leading-relaxed whitespace-pre-wrap" 
                     x-text="project.description">
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-wrap items-center gap-3 pt-6 border-t border-zinc-900">
                    <!-- Website / Google Drive Link Button -->
                    <a :href="project.link" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/35 hover:-translate-y-0.5"
                       x-show="project.link">
                        <span x-text="project.category === 'Web Dev' ? 'Visit Website' : 'View Design'"></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>

                    <!-- GitHub Button -->
                    <a :href="project.github" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-zinc-900 border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 text-zinc-300 hover:text-white font-bold rounded-xl transition-all duration-300 hover:-translate-y-0.5"
                       x-show="project.github">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                        </svg>
                        GitHub
                    </a>

                    <!-- Close Button -->
                    <button @click="show = false" 
                            class="inline-flex items-center justify-center px-5 py-3 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 hover:text-white text-zinc-400 font-bold rounded-xl transition-all duration-300 ml-auto md:w-auto">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
