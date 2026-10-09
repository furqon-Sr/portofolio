@props(['id' => null, 'title', 'category', 'description', 'link' => '#', 'number' => null, 'image' => null, 'github_link' => null, 'design_url' => null, 'views' => 0, 'has_pdf_cover' => false])

@php
    $cleanTitle = html_entity_decode($title ?? '', ENT_QUOTES, 'UTF-8');
    $cleanDesc = html_entity_decode($description ?? '', ENT_QUOTES, 'UTF-8');
    $resolvedHasPdfCover = filter_var($has_pdf_cover, FILTER_VALIDATE_BOOLEAN) || (
        $category === 'Design' && 
        !empty($design_url) && 
        (empty($image) || in_array(basename($image), ['image.png', 'porto.png', 'pdf-default', 'pdf']) || Str::endsWith(strtolower($image), '.pdf') || $image === $design_url)
    );
@endphp

<div x-data 
     @click="
         $dispatch('open-project-preview', {
             title: @js($cleanTitle),
             category: @js($category),
             description: @js($cleanDesc),
             link: @js($link),
             github: @js($github_link),
             image: @js($resolvedHasPdfCover ? $design_url : (Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image))),
             design_url: @js($design_url)
         })
     "
     class="cursor-pointer group flex flex-col justify-between h-full transition-all duration-300">
     
    <div>
        <!-- Cover Image Container (Frameless with rounded corners, 16:10 aspect ratio) -->
        <div class="w-full aspect-[16/10] bg-[#18181b] rounded-xl overflow-hidden relative">
            @if($resolvedHasPdfCover)
                <!-- Interactive / Dynamic PDF Document Card (Certificate Style) -->
                <div class="pdf-card-wrapper w-full h-full relative overflow-hidden bg-[#121215]" data-pdf-thumb="{{ $design_url }}">
                    <canvas data-pdf-thumb="{{ $design_url }}" class="pdf-card-canvas w-full h-full object-cover opacity-0 transition-opacity duration-500 relative z-10"></canvas>
                    
                    <!-- Certificate-Style PDF Document Fallback & Loading Placeholder -->
                    <div class="pdf-card-fallback absolute inset-0 flex flex-col items-center justify-center p-4 bg-gradient-to-b from-[#18181c] to-[#0f0f12] text-center">
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
                     class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500 ease-out">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-600">
                    <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60 group-hover:opacity-20 transition-opacity z-10 pointer-events-none"></div>
        </div>

        <!-- Content Area -->
        <div class="mt-4">
            <!-- Title -->
            <h3 class="text-base sm:text-lg font-bold text-white tracking-tight group-hover:text-blue-400 transition-colors mb-1.5 leading-snug line-clamp-1">
                {{ $cleanTitle }}
            </h3>

            <!-- Description -->
            <p class="text-xs sm:text-sm text-gray-400 leading-relaxed line-clamp-2 group-hover:text-gray-300 transition-colors">
                {{ $cleanDesc }}
            </p>
        </div>
    </div>

    <!-- Bottom Info & Action Bar -->
    <div class="mt-4 flex items-center justify-end text-xs font-semibold">
        <!-- Action Links -->
        <div class="flex items-center gap-3">
            @if($category === 'Web Dev')
                @if($link)
                <a href="{{ $link }}" target="_blank" @click.stop 
                   class="text-gray-400 hover:text-white flex items-center gap-1.5 text-xs font-medium transition-colors" title="Buka Website">
                    <span>Website</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
                @endif
                @if($github_link)
                <a href="{{ $github_link }}" target="_blank" @click.stop 
                   class="text-gray-400 hover:text-white flex items-center gap-1.5 text-xs font-medium transition-colors" title="Source Code GitHub">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" /></svg>
                    <span>GitHub</span>
                </a>
                @endif
                @if(!$link && !$github_link)
                <span class="text-gray-500 group-hover:text-blue-400 flex items-center transition-colors">
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
                @endif
            @else
                <span class="text-gray-500 group-hover:text-blue-400 flex items-center transition-colors">
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </div>
</div>
