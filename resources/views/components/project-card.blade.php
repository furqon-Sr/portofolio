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
     class="cursor-pointer group flex flex-col h-full transition-all duration-300">
     
    <!-- Cover Image Container (Frameless with rounded corners, 16:10 aspect ratio) -->
    <div class="w-full aspect-[16/10] bg-[#18181b] rounded-xl overflow-hidden relative">
        @if($resolvedHasPdfCover)
            <!-- Interactive / Dynamic PDF Document Card -->
            <div class="pdf-card-wrapper w-full h-full relative overflow-hidden bg-[#121215]" data-pdf-thumb="{{ $design_url }}">
                <canvas data-pdf-thumb="{{ $design_url }}" class="pdf-card-canvas w-full h-full object-cover opacity-0 transition-opacity duration-500 relative z-10"></canvas>
                
                <!-- Elegant & Professional PDF Loading Skeleton Placeholder -->
                <div class="pdf-card-fallback absolute inset-0 flex flex-col items-center justify-center p-4 bg-[#111114] overflow-hidden select-none transition-opacity duration-500">
                    <!-- Subtle Ambient Shimmer Background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/[0.04] to-transparent -translate-x-full animate-shimmer pointer-events-none"></div>

                    <!-- Glowing Orbit Loader -->
                    <div class="relative flex flex-col items-center justify-center gap-3.5 z-10">
                        <div class="relative w-10 h-10 flex items-center justify-center">
                            <!-- Soft ambient pulse glow -->
                            <div class="absolute inset-0 rounded-full bg-blue-500/15 blur-md animate-pulse"></div>
                            <!-- Subtle track ring -->
                            <div class="w-8 h-8 rounded-full border border-white/10"></div>
                            <!-- Elegant spinning arc -->
                            <div class="absolute inset-0 w-8 h-8 m-auto rounded-full border-2 border-transparent border-t-blue-500 border-r-blue-400/60 animate-spin"></div>
                            <!-- Center luminous dot -->
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-400/90 shadow-sm shadow-blue-400"></div>
                        </div>

                        <!-- Minimalist status label -->
                        <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-white/[0.03] border border-white/5 backdrop-blur-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-ping"></span>
                            <span class="text-[10px] font-medium tracking-widest uppercase text-zinc-400 font-mono">Memuat Dokumen</span>
                        </div>
                    </div>
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
        <h3 class="text-base sm:text-lg font-bold text-white tracking-tight group-hover:text-blue-400 transition-colors leading-snug line-clamp-1">
            {{ $cleanTitle }}
        </h3>
    </div>
</div>
