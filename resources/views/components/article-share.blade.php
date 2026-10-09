@props([
    'url' => url()->current(),
    'title' => '',
])

@php
    $encodedUrl = urlencode($url);
    $encodedTitle = urlencode($title);
    $encodedWhatsApp = urlencode($title ? ($title . ' ' . $url) : $url);
    $xShareUrl = "https://twitter.com/intent/tweet?text={$encodedTitle}&url={$encodedUrl}";
    $linkedInShareUrl = "https://www.linkedin.com/sharing/share-offsite/?url={$encodedUrl}";
    $whatsAppShareUrl = "https://api.whatsapp.com/send?text={$encodedWhatsApp}";
@endphp

<div x-data="{
    copied: false,
    hasNativeShare: typeof navigator !== 'undefined' && typeof navigator.share === 'function',
    copyLink() {
        const shareUrl = '{{ $url }}';
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(shareUrl).then(() => {
                this.showCopied();
            }).catch(() => {
                this.fallbackCopy(shareUrl);
            });
        } else {
            this.fallbackCopy(shareUrl);
        }
    },
    fallbackCopy(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.opacity = '0';
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            this.showCopied();
        } catch (e) {}
        document.body.removeChild(textArea);
    },
    showCopied() {
        this.copied = true;
        setTimeout(() => { this.copied = false; }, 2200);
    },
    nativeShare() {
        if (navigator.share) {
            navigator.share({
                title: '{{ addslashes($title) }}',
                url: '{{ $url }}'
            }).catch(() => {});
        }
    }
}" class="inline-flex items-center gap-1.5 {{ $attributes->get('class') }}">

    <!-- Copy Link -->
    <button type="button" 
            @click="copyLink()" 
            :title="copied ? 'Link tersalin!' : 'Salin link'"
            :class="copied ? 'border-emerald-500/40 bg-emerald-500/15 text-emerald-400' : 'border-white/10 bg-white/[0.03] text-gray-400 hover:text-white hover:bg-white/[0.08] hover:border-white/20'"
            class="relative group w-8 h-8 rounded-full flex items-center justify-center border transition-all duration-200 active:scale-90"
            aria-label="Salin tautan artikel">
        <!-- Normal Link Icon -->
        <svg x-show="!copied" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
        </svg>
        <!-- Copied Checkmark Icon -->
        <svg x-show="copied" style="display: none;" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
        </svg>
        
        <!-- Tooltip -->
        <span x-text="copied ? 'Tersalin!' : 'Salin link'" 
              class="pointer-events-none absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-0.5 text-[10px] font-medium text-gray-200 bg-gray-900/95 border border-white/10 rounded-md shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-150 whitespace-nowrap z-30">
        </span>
    </button>

    <!-- X (Twitter) -->
    <a href="{{ $xShareUrl }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="relative group w-8 h-8 rounded-full flex items-center justify-center border border-white/10 bg-white/[0.03] text-gray-400 hover:text-white hover:bg-white/[0.08] hover:border-white/20 transition-all duration-200 active:scale-90"
       aria-label="Bagikan ke X">
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
        </svg>
        <span class="pointer-events-none absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-0.5 text-[10px] font-medium text-gray-200 bg-gray-900/95 border border-white/10 rounded-md shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-150 whitespace-nowrap z-30">
            Bagikan ke X
        </span>
    </a>

    <!-- LinkedIn -->
    <a href="{{ $linkedInShareUrl }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="relative group w-8 h-8 rounded-full flex items-center justify-center border border-white/10 bg-white/[0.03] text-gray-400 hover:text-blue-400 hover:bg-white/[0.08] hover:border-white/20 transition-all duration-200 active:scale-90"
       aria-label="Bagikan ke LinkedIn">
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2V10.9H6.46M7.83 6.45a1.62 1.62 0 1 0 0 3.24 1.62 1.62 0 0 0 0-3.24z"/>
        </svg>
        <span class="pointer-events-none absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-0.5 text-[10px] font-medium text-gray-200 bg-gray-900/95 border border-white/10 rounded-md shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-150 whitespace-nowrap z-30">
            Bagikan ke LinkedIn
        </span>
    </a>

    <!-- WhatsApp -->
    <a href="{{ $whatsAppShareUrl }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="relative group w-8 h-8 rounded-full flex items-center justify-center border border-white/10 bg-white/[0.03] text-gray-400 hover:text-emerald-400 hover:bg-white/[0.08] hover:border-white/20 transition-all duration-200 active:scale-90"
       aria-label="Bagikan ke WhatsApp">
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="pointer-events-none absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-0.5 text-[10px] font-medium text-gray-200 bg-gray-900/95 border border-white/10 rounded-md shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-150 whitespace-nowrap z-30">
            Bagikan ke WhatsApp
        </span>
    </a>

    <!-- Native Web Share (if supported on mobile/tablet/browser) -->
    <button type="button" 
            x-show="hasNativeShare" 
            @click="nativeShare()" 
            class="relative group w-8 h-8 rounded-full flex items-center justify-center border border-white/10 bg-white/[0.03] text-gray-400 hover:text-white hover:bg-white/[0.08] hover:border-white/20 transition-all duration-200 active:scale-90"
            aria-label="Bagikan lainnya">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
        </svg>
        <span class="pointer-events-none absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-0.5 text-[10px] font-medium text-gray-200 bg-gray-900/95 border border-white/10 rounded-md shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-150 whitespace-nowrap z-30">
            Bagikan lainnya
        </span>
    </button>
</div>
