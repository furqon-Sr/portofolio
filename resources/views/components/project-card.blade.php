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
        <h3 class="text-base sm:text-lg font-bold text-white tracking-tight group-hover:text-blue-400 transition-colors leading-snug line-clamp-1">
            {{ $cleanTitle }}
        </h3>
    </div>
</div>
