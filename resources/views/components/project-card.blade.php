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
     class="cursor-pointer group flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-8 py-6 md:py-8 border-b border-white/10 hover:translate-y-[-2px] transition-all duration-300">
     
     <!-- Left: Number, Thumbnail & Title -->
     <div class="flex items-center gap-4 md:gap-6 md:w-1/3 flex-shrink-0 min-w-0">
         <span class="font-mono text-xs md:text-sm text-gray-600 font-semibold group-hover:text-blue-500 transition-colors w-6">
             {{ $number }}
         </span>
         
         @if($image)
         <div class="w-16 md:w-24 aspect-[16/10] bg-[#121212] border border-white/5 rounded overflow-hidden flex-shrink-0 relative group-hover:border-white/20 transition-all duration-500">
             <img src="{{ Str::startsWith($image, 'http') || Str::startsWith($image, 'data:') ? $image : asset('img/' . $image) }}" 
                  alt="{{ $title }}" 
                  class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
         </div>
         @endif
         
         <div class="min-w-0">
             <h4 class="text-base md:text-lg font-bold text-white tracking-tight group-hover:text-blue-400 transition-colors truncate">
                 {{ $title }}
             </h4>
             <span class="md:hidden text-[9px] font-bold text-blue-500 uppercase tracking-widest mt-0.5 block">
                 {{ $category }}
             </span>
         </div>
     </div>

     <!-- Middle: Description -->
     <div class="flex-1 min-w-0 md:px-4">
         <p class="text-gray-400 text-xs md:text-sm leading-relaxed truncate group-hover:text-gray-300 transition-colors">
             {{ $description }}
         </p>
     </div>
     
     <!-- Middle-Right: Category (Desktop Only) -->
     <div class="hidden md:block flex-shrink-0 w-24 text-right">
         <span class="text-xs font-bold text-blue-500 uppercase tracking-widest">
             {{ $category }}
         </span>
     </div>

     <!-- Right: Action Links -->
     <div class="flex items-center gap-4 text-xs md:text-sm font-semibold flex-shrink-0 md:w-40 md:justify-end">
         @if($category === 'Web Dev')
             <a href="{{ $link }}" target="_blank" @click.stop class="text-white hover:text-blue-500 flex items-center gap-1.5 transition-colors">
                 <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                 Website
             </a>
             @if($github_link)
             <a href="{{ $github_link }}" target="_blank" @click.stop class="text-gray-400 hover:text-white flex items-center gap-1.5 transition-colors">
                 <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" /></svg>
                 GitHub
             </a>
             @endif
         @else
             <span class="text-white/80 hover:text-blue-500 flex items-center gap-1.5 transition-colors">
                 <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                 View Design
             </span>
         @endif
     </div>
</div>
