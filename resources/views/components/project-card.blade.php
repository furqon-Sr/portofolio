@props(['title', 'category', 'description', 'link' => '#', 'number' => '01', 'image' => null])

<a href="{{ $link }}" target="_blank" class="group cursor-pointer block">
    <div class="aspect-[16/10] bg-[#1a1a1a] border border-gray-800 rounded-xl md:rounded-2xl overflow-hidden relative mb-3 md:mb-6 transition-all duration-500 group-hover:border-blue-500/50 group-hover:shadow-2xl group-hover:shadow-blue-500/10">
        @if($image)
            <img src="{{ asset('img/' . $image) }}" alt="{{ $title }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-transparent to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-500"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="w-full h-full flex items-center justify-center text-gray-800 font-bold text-2xl md:text-5xl group-hover:scale-110 group-hover:text-blue-900 transition-all duration-700">
                {{ $number }}
            </div>
        @endif
    </div>
    
    <div class="space-y-1 md:space-y-2">
        <div class="flex items-start md:items-center justify-between gap-1">
            <h4 class="text-white font-bold text-xs md:text-xl leading-tight group-hover:text-blue-500 transition-colors">{{ $title }}</h4>
            <span class="text-blue-600 opacity-0 group-hover:opacity-100 transition-all translate-x-[-10px] group-hover:translate-x-0 mt-0.5 md:mt-0 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </span>
        </div>
        <p class="text-blue-500 text-[8px] md:text-xs font-semibold uppercase tracking-wider">{{ $category }}</p>
        <p class="text-gray-500 text-[10px] md:text-sm leading-snug md:leading-relaxed line-clamp-2 md:line-clamp-none">{{ $description }}</p>
    </div>
</a>
