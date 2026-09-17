@props(['id' => null, 'title', 'category', 'description', 'link' => '#', 'number' => null, 'image' => null, 'github_link' => null, 'design_url' => null, 'views' => 0])

<div x-data="{ views: {{ (int)$views }}, projectId: @js($id) }"
     @click="
         if (projectId) {
             fetch('/api/projects/' + projectId + '/view', { method: 'POST' });
             views++;
         }
         $dispatch('open-project-preview', {
             title: @js($title),
             category: @js($category),
             description: @js($description),
             link: @js($link),
             github: @js($github_link),
             image: @js(Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image)),
             design_url: @js($design_url),
             views: views
         })
     "
     class="cursor-pointer group flex flex-col justify-between h-full bg-[#111113] hover:bg-[#151518] border border-white/10 hover:border-blue-500/40 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1">
     
    <div>
        <!-- Cover Image Container (Flush to top, 16:10 aspect ratio matching reference) -->
        <div class="w-full aspect-[16/10] bg-[#18181b] overflow-hidden relative border-b border-white/5">
            @if($image)
            <img src="{{ Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image) }}" 
                 alt="{{ $title }}" 
                 loading="lazy"
                 class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500 ease-out">
            @else
            <div class="w-full h-full flex items-center justify-center text-gray-600">
                <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60 group-hover:opacity-20 transition-opacity"></div>

            <!-- Top-Right Category / Badge (ala reference Featured pill) -->
            <div class="absolute top-3 right-3 bg-black/80 backdrop-blur-md border border-white/15 text-white text-[11px] font-semibold px-3 py-1 rounded-full flex items-center gap-1.5 shadow-lg pointer-events-none">
                <span class="w-1.5 h-1.5 rounded-full {{ $category === 'Web Dev' ? 'bg-blue-400' : 'bg-purple-400' }}"></span>
                <span>{{ $category === 'Web Dev' ? 'Web Development' : 'Design' }}</span>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-4 sm:p-5">
            <!-- Title -->
            <h3 class="text-base sm:text-lg font-bold text-white tracking-tight group-hover:text-blue-400 transition-colors mb-1.5 leading-snug line-clamp-1">
                {{ $title }}
            </h3>

            <!-- Description -->
            <p class="text-xs sm:text-sm text-gray-400 leading-relaxed line-clamp-2 group-hover:text-gray-300 transition-colors">
                {{ $description }}
            </p>
        </div>
    </div>

    <!-- Bottom Info & Action Bar -->
    <div class="px-4 sm:px-5 pb-4 sm:pb-5 pt-3 border-t border-white/5 mt-auto flex items-center justify-between text-xs font-semibold">
        <!-- Left: Views Counter -->
        <div class="flex items-center gap-1.5 text-gray-500 text-xs font-medium">
            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span x-text="views.toLocaleString('en-US')"></span>
            <span>views</span>
        </div>

        <!-- Right: Action Links -->
        <div class="flex items-center gap-3">
            @if($category === 'Web Dev')
                @if($link)
                <a href="{{ $link }}" target="_blank" @click.stop="if(projectId){ fetch('/api/projects/' + projectId + '/view', { method: 'POST' }); views++; }" 
                   class="text-white hover:text-blue-400 flex items-center gap-1.5 text-xs font-medium transition-colors" title="Buka Website">
                    <span>Website</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
                @endif
                @if($github_link)
                <a href="{{ $github_link }}" target="_blank" @click.stop="if(projectId){ fetch('/api/projects/' + projectId + '/view', { method: 'POST' }); views++; }" 
                   class="text-gray-400 hover:text-white flex items-center gap-1.5 text-xs font-medium transition-colors" title="Source Code GitHub">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" /></svg>
                    <span>GitHub</span>
                </a>
                @endif
            @else
                <span class="text-blue-400 group-hover:text-blue-300 flex items-center gap-1 text-xs font-medium transition-colors">
                    <span>Lihat Desain</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </div>
</div>
