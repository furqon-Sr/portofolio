@props(['project'])

<div class="space-y-12">
    <!-- Design Rationale -->
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h3 class="text-2xl font-bold text-white mb-4">Design Rationale</h3>
        <p class="text-gray-400 text-lg leading-relaxed">
            The visual identity was crafted to communicate zero-pixel drift design and optical precision. The following brand guidelines, poster implementations, and social media mockups illustrate the systematic approach to this brand.
        </p>
    </div>

    <!-- Masonry Grid / Image Stack -->
    @if(isset($project->gallery_assets) && count($project->gallery_assets) > 0)
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
            @foreach($project->gallery_assets as $index => $asset)
                <div class="break-inside-avoid relative group rounded-2xl overflow-hidden border border-gray-800 bg-[#1a1a1a]">
                    <div class="w-full aspect-[4/5] bg-gradient-to-br from-[#222] to-[#111] flex flex-col items-center justify-center gap-4 group-hover:scale-105 transition-transform duration-700">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <span class="text-gray-500 text-sm font-medium">{{ $asset }}</span>
                    </div>
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-semibold tracking-wider uppercase text-sm">View Details</span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="w-full py-32 bg-[#1a1a1a] border border-gray-800 rounded-3xl flex flex-col items-center justify-center gap-4">
            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            <p class="text-gray-500 font-medium">Gallery assets are currently unavailable for this project.</p>
        </div>
    @endif
</div>
