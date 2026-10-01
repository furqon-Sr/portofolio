<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="{{ url('/blog/' . $article->slug) }}" />
    @php 
        $siteSettingsData = $siteSetting ?? \App\Models\AboutSetting::first(); 
        $logoText = $siteSettingsData->footer_name ?? 'Hanafi';
    @endphp
    <title>{{ $article->title }} | {{ $logoText }} Blog</title>
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
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slide-up 1s ease-out forwards; }
        
        /* Article Typography Styles */
        .prose p { margin-bottom: 1.5em; line-height: 1.8; color: #a1a1aa; } /* text-gray-400 */
        .prose h1, .prose h2, .prose h3 { color: #f4f4f5; font-weight: 700; margin-top: 2em; margin-bottom: 1em; }
        .prose a { color: #3b82f6; text-decoration: underline; text-underline-offset: 4px; }
        .prose ul, .prose ol { margin-bottom: 1.5em; padding-left: 1.5em; color: #a1a1aa; }
        .prose ul { list-style-type: disc; }
        .prose ol { list-style-type: decimal; }
        .prose li { margin-bottom: 0.5em; }
        .prose blockquote { border-left: 4px solid #3b82f6; padding-left: 1em; margin-left: 0; font-style: italic; color: #d4d4d8; }
        .prose strong { color: #e4e4e7; font-weight: 600; }
        .prose img { border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5); margin: 2rem auto; max-width: 100%; height: auto; display: block; cursor: zoom-in; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .prose img:hover { transform: scale(1.01); box-shadow: 0 25px 35px -5px rgba(59, 130, 246, 0.2); }
        .prose pre { background-color: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.75rem; padding: 1rem 1.25rem; overflow-x: auto; margin-bottom: 1.5em; }
        .prose code { color: #60a5fa; font-size: 0.9em; background-color: rgba(255, 255, 255, 0.05); padding: 0.15rem 0.35rem; border-radius: 0.25rem; }
        .prose pre code { background-color: transparent; padding: 0; color: inherit; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white"
      x-data="{
          previewModal: false,
          previewSrc: '',
          previewAlt: '',
          previewZoom: 1,
          panX: 0,
          panY: 0,
          isDragging: false,
          startX: 0,
          startY: 0,
          hasMoved: false,
          openPreview(src, alt) {
              this.previewSrc = src;
              this.previewAlt = alt || '';
              this.previewZoom = 1;
              this.panX = 0;
              this.panY = 0;
              this.previewModal = true;
              document.body.style.overflow = 'hidden';
          },
          closePreview() {
              this.previewModal = false;
              this.previewZoom = 1;
              this.panX = 0;
              this.panY = 0;
              document.body.style.overflow = '';
          },
          zoomIn() {
              this.previewZoom = Math.min(3, +(this.previewZoom + 0.35).toFixed(2));
          },
          zoomOut() {
              this.previewZoom = Math.max(1, +(this.previewZoom - 0.35).toFixed(2));
              if (this.previewZoom === 1) {
                  this.panX = 0;
                  this.panY = 0;
              }
          },
          handleImageClick(e) {
              if (this.hasMoved) return;
              if (this.previewZoom === 1) {
                  this.previewZoom = 1.8;
              } else {
                  this.previewZoom = 1;
                  this.panX = 0;
                  this.panY = 0;
              }
          },
          startDrag(e) {
              if (this.previewZoom <= 1) return;
              this.isDragging = true;
              this.hasMoved = false;
              this.startX = e.clientX - this.panX;
              this.startY = e.clientY - this.panY;
          },
          onDrag(e) {
              if (!this.isDragging || this.previewZoom <= 1) return;
              const newX = e.clientX - this.startX;
              const newY = e.clientY - this.startY;
              if (Math.abs(newX - this.panX) > 3 || Math.abs(newY - this.panY) > 3) {
                  this.hasMoved = true;
              }
              this.panX = newX;
              this.panY = newY;
          },
          stopDrag() {
              this.isDragging = false;
          }
      }">
    <!-- Ambient Background Container -->
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
            <main class="pt-24 pb-32 animate-slide-up">
            
            <article class="max-w-3xl mx-auto">
                <!-- Back Link -->
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-white mb-10 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to Blog
                </a>

                <!-- Header -->
                <header class="mb-12">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-xs uppercase tracking-widest font-bold text-blue-500 bg-blue-500/10 px-3 py-1 rounded-full border border-blue-500/20">
                            {{ $article->created_at->format('M d, Y') }}
                        </span>
                        <span class="text-sm text-gray-500 font-medium">&bull; {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-[1.1] mb-6">
                        {{ $article->title }}
                    </h1>
                    @if($article->excerpt)
                    <p class="text-xl text-gray-400 font-medium leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                    @endif
                </header>

                <!-- Cover Image (Uncropped with Lightbox Preview) -->
                @if($article->cover_image)
                <div class="mb-16">
                    <div class="w-full rounded-3xl overflow-hidden bg-[#0c0c0e] border border-white/10 shadow-2xl relative group cursor-pointer"
                         @click="openPreview('{{ $article->cover_image }}', '{{ addslashes($article->title) }}')">
                        
                        <!-- Ambient Blurred Backdrop to avoid harsh empty black space while showing entire image -->
                        <div class="absolute inset-0 bg-cover bg-center blur-3xl opacity-20 scale-125 pointer-events-none"
                             style="background-image: url('{{ $article->cover_image }}')"></div>
                        <div class="absolute inset-0 bg-black/40 pointer-events-none"></div>

                        <!-- Full Uncropped Image -->
                        <div class="relative z-10 w-full flex items-center justify-center p-3 sm:p-5 md:p-8 min-h-[250px] max-h-[620px]">
                            <img src="{{ $article->cover_image }}" 
                                 alt="{{ $article->title }}" 
                                 class="max-w-full max-h-[560px] w-auto h-auto object-contain rounded-2xl shadow-xl transition-transform duration-300 group-hover:scale-[1.01] cursor-zoom-in">
                        </div>
                    </div>
                    @if($article->cover_image_source || $article->cover_image_source_url)
                    <div class="mt-3 px-2 flex items-center justify-end gap-1.5 text-xs text-gray-500">
                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Sumber Gambar:</span>
                        @if($article->cover_image_source_url)
                            <a href="{{ $article->cover_image_source_url }}" target="_blank" rel="noopener noreferrer" class="text-blue-400 hover:text-blue-300 underline underline-offset-2 transition-colors font-medium inline-flex items-center gap-1">
                                {{ $article->cover_image_source ?: parse_url($article->cover_image_source_url, PHP_URL_HOST) }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        @else
                            <span class="text-gray-400 font-medium">{{ $article->cover_image_source }}</span>
                        @endif
                    </div>
                    @endif
                </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-lg prose-invert max-w-none text-gray-300">
                    {!! \Illuminate\Support\Str::markdown($article->content, ['html_input' => 'allow', 'allow_unsafe_links' => false, 'renderer' => ['soft_break' => "<br>\n"]]) !!}
                </div>

                <!-- References Section -->
                @if(!empty($article->references) && is_array($article->references) && count($article->references) > 0)
                <div class="mt-20 pt-10 border-t border-white/10">
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Referensi & Jurnal
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($article->references as $ref)
                            <a href="{{ $ref['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="group flex items-start gap-4 p-4 rounded-2xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.05] hover:border-white/10 transition-all duration-300 hover:-translate-y-1">
                                <div class="mt-1 p-2 bg-blue-500/10 text-blue-400 rounded-lg group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                </div>
                                <div class="overflow-hidden">
                                    <h4 class="text-sm font-semibold text-gray-200 group-hover:text-blue-400 transition-colors leading-relaxed">{{ $ref['title'] ?? 'Referensi' }}</h4>
                                    <p class="text-xs text-gray-500 mt-1 truncate">{{ $ref['url'] ?? '' }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

        </main>
        </div>
        
        <!-- Full-Width Footer (Mentok Kanan Kiri) -->
        <div class="w-full px-6 md:px-10 lg:px-12">
            <x-footer />
        </div>
    </div>

    <!-- Fullscreen Image Preview Lightbox Modal -->
    <div x-show="previewModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="closePreview()"
         class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-xl select-none"
         style="display: none;"
         role="dialog"
         aria-modal="true"
         @mousemove="onDrag($event)"
         @mouseup="stopDrag()"
         @mouseleave="stopDrag()">
        
        <!-- Backdrop Click to Close -->
        <div class="absolute inset-0 z-10 cursor-zoom-out" @click="closePreview()"></div>

        <!-- Top Right Minimalist Controls (Matches reference modelcontextprotocol.io) -->
        <div class="fixed top-4 right-4 sm:top-6 sm:right-6 z-50 flex items-center gap-2.5 pointer-events-auto">
            <!-- Zoom Out Button -->
            <button type="button" 
                    @click.stop="zoomOut()" 
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-neutral-900/80 hover:bg-neutral-800 border border-white/10 hover:border-white/25 flex items-center justify-center text-white transition-all shadow-xl"
                    :class="previewZoom <= 1 ? 'opacity-40 cursor-not-allowed' : 'opacity-100 hover:scale-105 active:scale-95 cursor-pointer'"
                    :disabled="previewZoom <= 1"
                    aria-label="Perkecil">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
            </button>

            <!-- Zoom In Button -->
            <button type="button" 
                    @click.stop="zoomIn()" 
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-neutral-900/80 hover:bg-neutral-800 border border-white/10 hover:border-white/25 flex items-center justify-center text-white transition-all shadow-xl"
                    :class="previewZoom >= 3 ? 'opacity-40 cursor-not-allowed' : 'opacity-100 hover:scale-105 active:scale-95 cursor-pointer'"
                    :disabled="previewZoom >= 3"
                    aria-label="Perbesar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            </button>

            <!-- Close Button -->
            <button type="button" 
                    @click.stop="closePreview()" 
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-neutral-900/80 hover:bg-neutral-800 border border-white/10 hover:border-white/25 flex items-center justify-center text-white transition-all shadow-xl hover:scale-105 active:scale-95 cursor-pointer"
                    aria-label="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <!-- Image Display Area -->
        <div class="relative z-20 w-full h-full flex items-center justify-center p-4 sm:p-8 pointer-events-none"
             @wheel.prevent="if ($event.deltaY < 0) { zoomIn(); } else { zoomOut(); }">
            <img :src="previewSrc" 
                 :alt="previewAlt" 
                 @click.stop="handleImageClick($event)"
                 @mousedown="startDrag($event)"
                 :class="[
                     previewZoom > 1 ? (isDragging ? 'cursor-grabbing' : 'cursor-zoom-out') : 'cursor-zoom-in'
                 ]"
                 :style="`transform: translate(${panX}px, ${panY}px) scale(${previewZoom}); transform-origin: center center; transition: ${isDragging ? 'none' : 'transform 0.25s cubic-bezier(0.16, 1, 0.3, 1)'};`"
                 class="max-w-[92vw] max-h-[88vh] w-auto h-auto object-contain rounded-xl shadow-2xl select-none pointer-events-auto">
        </div>
    </div>

    <!-- Script to enable click-to-preview on all inline article images -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const bindProseImages = () => {
                document.querySelectorAll('.prose img').forEach(img => {
                    if (!img.dataset.hasPreviewListener) {
                        img.dataset.hasPreviewListener = 'true';
                        img.title = 'Klik untuk memperbesar gambar';
                        img.addEventListener('click', (e) => {
                            e.stopPropagation();
                            const bodyEl = document.querySelector('body[x-data]');
                            if (window.Alpine && bodyEl) {
                                const alpineData = Alpine.$data(bodyEl);
                                if (alpineData && alpineData.openPreview) {
                                    alpineData.openPreview(img.src, img.alt);
                                }
                            }
                        });
                    }
                });
            };

            bindProseImages();
            // Re-bind if dynamic content loads
            setTimeout(bindProseImages, 500);
        });
    </script>
</body>
</html>
