@props([
    'id' => null, 
    'title', 
    'category', 
    'description', 
    'link' => '#', 
    'number' => null, 
    'image' => null, 
    'github_link' => null, 
    'design_url' => null, 
    'views' => 0, 
    'has_pdf_cover' => false,
    'year' => '2025',
    'techStack' => []
])

@php
    $cleanTitle = html_entity_decode($title ?? '', ENT_QUOTES, 'UTF-8');
    $cleanDesc = html_entity_decode($description ?? '', ENT_QUOTES, 'UTF-8');
    $resolvedHasPdfCover = filter_var($has_pdf_cover, FILTER_VALIDATE_BOOLEAN) || (
        $category === 'Design' && 
        !empty($design_url) && 
        (empty($image) || in_array(basename($image), ['image.png', 'porto.png', 'pdf-default', 'pdf']) || Str::endsWith(strtolower($image), '.pdf') || $image === $design_url)
    );
@endphp

<div x-data="{ views: {{ (int)$views }}, projectId: @js($id) }"
     @click="
         if (projectId) {
             fetch('/api/projects/' + projectId + '/view', { 
                 method: 'POST', 
                 headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } 
             }).catch(() => {});
             views++;
         }
         $dispatch('open-project-preview', {
             title: @js($cleanTitle),
             category: @js($category),
             description: @js($cleanDesc),
             link: @js($link),
             github: @js($github_link),
             image: @js($resolvedHasPdfCover ? $design_url : (Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image))),
             design_url: @js($design_url),
             views: views
         })
     "
     class="cursor-pointer group flex flex-col justify-between h-full rounded-xl border border-zinc-800/80 bg-zinc-900/60 backdrop-blur overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:border-zinc-700 hover:border-blue-500/30 hover:shadow-2xl hover:shadow-blue-500/5">
     
    <div class="flex flex-col flex-grow">
        <!-- 3.A Image & Thumbnail (aspect-[16/10], overflow-hidden rounded-t-xl bg-zinc-900) -->
        <div class="w-full aspect-[16/10] bg-zinc-900 overflow-hidden relative rounded-t-xl border-b border-zinc-800/60">
            @if($resolvedHasPdfCover)
                <!-- Interactive / Dynamic PDF Document Card -->
                <div class="pdf-card-wrapper w-full h-full relative overflow-hidden bg-zinc-950" data-pdf-thumb="{{ $design_url }}">
                    <canvas data-pdf-thumb="{{ $design_url }}" class="pdf-card-canvas w-full h-full object-cover opacity-0 transition-opacity duration-500 relative z-10"></canvas>
                    
                    <!-- Certificate-Style PDF Document Fallback & Loading Placeholder -->
                    <div class="pdf-card-fallback absolute inset-0 flex flex-col items-center justify-center p-4 bg-gradient-to-b from-zinc-900 to-zinc-950 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-500 mb-2 shadow-lg shadow-red-500/5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-red-400 bg-red-500/10 px-2.5 py-0.5 rounded-full border border-red-500/20">
                            Dokumen PDF
                        </span>
                    </div>
                </div>
            @elseif($image)
                @php
                    $imgUrl = Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image);
                    $cleanImgPath = basename($image);
                    $webpName = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $cleanImgPath);
                    if (!Str::startsWith($image, 'http') && !Str::startsWith($image, 'data:') && file_exists(public_path('img/' . $webpName))) {
                        $imgUrl = asset('img/' . $webpName);
                    }
                @endphp
                <img src="{{ $imgUrl }}" 
                     alt="{{ $title }}" 
                     width="380"
                     height="238"
                     loading="lazy"
                     decoding="async"
                     class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-transform duration-300 ease-out">
            @else
                <div class="w-full h-full flex items-center justify-center text-zinc-600 bg-zinc-900">
                    <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/60 via-transparent to-transparent opacity-60 group-hover:opacity-20 transition-opacity z-10 pointer-events-none"></div>
        </div>

        <!-- 3.B Content & Tech Stack Area (Category badge moved OUT of image) -->
        <div class="p-5 flex flex-col flex-grow justify-between">
            <div>
                <!-- Metadata Baris Atas: Kategori badge di kiri, Tahun rilis di kanan -->
                <div class="flex items-center justify-between gap-2 mb-2.5">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold border {{ $category === 'Web Dev' ? 'bg-blue-500/10 border-blue-500/30 text-blue-400' : 'bg-purple-500/10 border-purple-500/30 text-purple-400' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $category === 'Web Dev' ? 'bg-blue-400' : 'bg-purple-400' }}"></span>
                        <span>{{ $category === 'Web Dev' ? 'Web Development' : 'Design' }}</span>
                    </span>
                    <span class="text-xs text-zinc-500 font-mono tracking-wider">{{ $year ?? '2025' }}</span>
                </div>

                <!-- Judul Proyek -->
                <h3 class="text-lg font-semibold text-white tracking-tight group-hover:text-blue-400 transition-colors leading-snug">
                    {{ $cleanTitle }}
                </h3>

                <!-- Deskripsi Proyek -->
                <p class="text-sm text-zinc-400 line-clamp-2 mt-1.5 leading-relaxed group-hover:text-zinc-300 transition-colors">
                    {{ $cleanDesc }}
                </p>

                <!-- Tech Stack Pills (WAJIB) -->
                @php
                    $tags = !empty($techStack) ? $techStack : ($category === 'Web Dev' ? ['Laravel', 'Tailwind CSS', 'JavaScript'] : ['Figma', 'UI/UX', 'Branding']);
                @endphp
                <div class="flex flex-wrap gap-1.5 mt-3">
                    @foreach($tags as $tech)
                    <span class="px-2 py-0.5 text-xs bg-zinc-800/80 text-zinc-300 rounded border border-zinc-700/60 font-medium tracking-tight">
                        {{ $tech }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- 3.C Footer & Actions (Standarisasi CTA - views counter DIHAPUS) -->
    <div class="px-5 py-3.5 border-t border-zinc-800/80 bg-zinc-950/40 flex items-center justify-between text-xs font-medium mt-auto">
        @if($category === 'Web Dev')
            <div class="flex items-center gap-3">
                @if($link && $link !== '#')
                <a href="{{ $link }}" target="_blank" @click.stop="if(projectId){ fetch('/api/projects/' + projectId + '/view', { method: 'POST', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } }).catch(() => {}); views++; }" 
                   class="inline-flex items-center gap-1.5 text-zinc-300 hover:text-white transition-colors group/btn">
                    <span>Live Demo</span>
                    <svg class="w-3.5 h-3.5 text-zinc-400 group-hover/btn:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
                @endif

                @if($github_link)
                <a href="{{ $github_link }}" target="_blank" @click.stop="if(projectId){ fetch('/api/projects/' + projectId + '/view', { method: 'POST', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } }).catch(() => {}); views++; }" 
                   class="inline-flex items-center gap-1.5 text-zinc-400 hover:text-white transition-colors">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" /></svg>
                    <span>GitHub</span>
                </a>
                @endif
            </div>

            <span class="text-zinc-500 group-hover:text-blue-400 flex items-center transition-colors ml-auto">
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
        @else
            <div class="flex items-center gap-1.5 text-zinc-300 group-hover:text-white transition-colors">
                <span>View Case Study</span>
            </div>
            <span class="text-zinc-500 group-hover:text-purple-400 flex items-center transition-colors">
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
        @endif
    </div>
</div>
