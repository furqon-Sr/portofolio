@props(['title', 'category', 'description', 'link' => '#', 'number' => '01', 'image' => null, 'github_link' => null])

<div x-data
     @click="$dispatch('open-project-preview', {
         title: @js($title),
         category: @js($category),
         description: @js($description),
         link: @js($link),
         github: @js($github_link),
         image: @js(Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image)),
         number: @js($number)
     })"
     class="cursor-pointer group block bg-[#111111]/40 border border-gray-800/60 rounded-2xl p-4 transition-all duration-500 hover:border-blue-500/40 hover:shadow-2xl hover:shadow-blue-500/5">
    
    <!-- Clickable Image Area -->
    <div class="block aspect-[16/10] bg-[#1a1a1a] border border-gray-800/80 rounded-xl overflow-hidden relative mb-4 transition-all duration-500 group-hover:border-blue-500/30">
        @if($image)
            <img src="{{ Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image) }}" alt="{{ $title }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-transparent to-transparent opacity-85 group-hover:opacity-70 transition-opacity duration-500"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="w-full h-full flex items-center justify-center text-gray-800 font-bold text-2xl md:text-5xl group-hover:scale-110 group-hover:text-blue-900 transition-all duration-700">
                {{ $number }}
            </div>
        @endif
    </div>
    
    <!-- Details & Links Area -->
    <div class="space-y-2">
        <div class="flex items-start justify-between gap-2">
            <div class="hover:text-blue-500 transition-colors">
                <h4 class="text-white font-bold text-xs md:text-base leading-tight">{{ $title }}</h4>
            </div>
            <span class="text-blue-500 text-[9px] font-bold uppercase tracking-wider flex-shrink-0 mt-0.5">{{ $category }}</span>
        </div>
        <p class="text-gray-500 text-[10px] md:text-xs leading-relaxed line-clamp-2">{{ $description }}</p>
        
        <!-- Options for Website Project -->
        @if($category === 'Web Dev')
        <div class="flex items-center gap-4 pt-3 mt-3 border-t border-white/5 text-[10px] md:text-xs font-semibold">
            <!-- Pilihan 1: Ke Website -->
            <a href="{{ $link }}" target="_blank" @click.stop class="text-white hover:text-blue-500 flex items-center gap-1.5 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                Website
            </a>
            <!-- Pilihan 2: Ke GitHub -->
            @if($github_link)
            <a href="{{ $github_link }}" target="_blank" @click.stop class="text-gray-400 hover:text-white flex items-center gap-1.5 transition-colors">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" /></svg>
                GitHub
            </a>
            @endif
        </div>
        @else
        <!-- Design Links -->
        <div class="flex items-center gap-4 pt-3 mt-3 border-t border-white/5 text-[10px] md:text-xs font-semibold">
            <span class="text-white/80 hover:text-blue-500 flex items-center gap-1.5 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                View Design
            </span>
        </div>
        @endif
    </div>

</div>
