@php
    $siteSetting = \App\Models\AboutSetting::first() ?? new \App\Models\AboutSetting([
        'logo_type' => 'text',
        'logo_value' => 'HANAFI',
        'footer_name' => 'FAHRURI HANAFI',
        'footer_copyright' => '© 2026 Fahruri Hanafi. All rights reserved.'
    ]);
@endphp
<nav x-data="{ open: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 15 })"
     :class="scrolled || open ? 'bg-gray-950/70 backdrop-blur-xl border-gray-800/60 shadow-2xl py-4 px-6 mt-4' : 'bg-transparent border-transparent py-6 px-0 mt-0'"
     class="sticky top-4 z-50 transition-all duration-300 border rounded-2xl flex flex-col justify-center">
    <div class="flex justify-between items-center w-full">
        <a href="/" class="flex items-center">
            @if(($siteSetting->logo_type ?? 'text') === 'text')
                <div class="text-2xl font-bold tracking-tighter text-white">{{ $siteSetting->logo_value ?? 'HANAFI' }}</div>
            @elseif(($siteSetting->logo_type ?? 'text') === 'svg')
                <div class="h-3 md:h-3.5 flex items-center select-none text-white [&_svg]:!h-full [&_svg]:!w-auto [&_svg]:max-w-full">
                    {!! $siteSetting->logo_value !!}
                </div>
            @else
                <div class="h-3 md:h-3.5 flex items-center select-none [&_img]:!h-full [&_img]:!w-auto">
                    <img src="{{ $siteSetting->logo_value }}" alt="Logo" class="object-contain">
                </div>
            @endif
        </a>
        
        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-400">
            <a href="/works" class="hover:text-white transition-colors">Works</a>
            <a href="/certificates" class="hover:text-white transition-colors">Certificates</a>
            <a href="/#about" class="hover:text-white transition-colors">About</a>
            <a href="/contact" class="hover:text-white transition-colors">Contact</a>
            <a href="{{ asset('assets/cv-hanafi.pdf') }}" download="CV_Hanafi.pdf" class="px-5 py-2 text-sm font-semibold bg-transparent border border-white text-white rounded-full hover:bg-white/20 transition-all duration-300 inline-block backdrop-blur-sm">
                Download CV
            </a>
        </div>

        <!-- Hamburger Icon -->
        <button @click="open = !open" class="block md:hidden text-gray-400 hover:text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="display: none;" 
         class="md:hidden absolute top-full left-0 right-0 mt-3 bg-gray-950/90 backdrop-blur-xl border border-gray-800/80 rounded-2xl z-50 flex flex-col items-center py-6 gap-6 shadow-2xl">
        <a href="/works" @click="open = false" class="text-gray-400 hover:text-white font-medium transition-colors">Works</a>
        <a href="/certificates" @click="open = false" class="text-gray-400 hover:text-white font-medium transition-colors">Certificates</a>
        <a href="/#about" @click="open = false" class="text-gray-400 hover:text-white font-medium transition-colors">About</a>
        <a href="/contact" @click="open = false" class="text-gray-400 hover:text-white font-medium transition-colors">Contact</a>
        <a href="{{ asset('assets/cv-hanafi.pdf') }}" download="CV_Hanafi.pdf" class="px-6 py-2 mt-2 text-sm font-semibold bg-transparent border border-white text-white rounded-full hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
            Download CV
        </a>
    </div>
</nav>

<style>
    /* Page Transitions - Scoped to Frontend Pages */
    body {
        opacity: 0;
        transition: opacity 0.25s ease-in-out;
    }
    body.loaded {
        opacity: 1;
    }
    body.fade-out {
        opacity: 0;
    }
</style>

<script>
    // 1. Page Transition Fade-In
    document.body.classList.add('loaded');

    // Handle back-forward cache show
    window.addEventListener('pageshow', (event) => {
        if (event.persisted) {
            document.body.classList.remove('fade-out');
            document.body.classList.add('loaded');
        }
    });

    // 2. Page Transition Fade-Out on link click
    document.addEventListener('click', e => {
        const link = e.target.closest('a');
        if (!link) return;

        try {
            const isSamePage = link.pathname === window.location.pathname;
            const hrefAttr = link.getAttribute('href') || '';
            const isAnchor = hrefAttr.startsWith('#') || (isSamePage && link.hash);

            // Verify if it's a local link and doesn't open in a new tab/window
            if (link.hostname === window.location.hostname &&
                !link.getAttribute('target') &&
                !isAnchor &&
                !link.href.startsWith('javascript:') &&
                !e.metaKey && !e.ctrlKey && !e.shiftKey) {
                
                e.preventDefault();
                const targetUrl = link.href;

                document.body.classList.remove('loaded');
                document.body.classList.add('fade-out');
                setTimeout(() => {
                    window.location.href = targetUrl;
                }, 200);
            }
        } catch (err) {
            // Fallback for parsing errors
        }
    });

    // 3. 3D Tilt & Spotlight Border tracker
    const initTiltAndSpotlight = () => {
        const cards = document.querySelectorAll('.card-tilt-spotlight');
        
        cards.forEach(card => {
            // Check if already initialized to avoid duplicate listeners
            if (card.dataset.tiltInitialized) return;
            card.dataset.tiltInitialized = 'true';

            // Mousemove tracker
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Update CSS variables for spotlight glow border and inner light glow
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);

                // 3D Tilt Calculations
                const width = rect.width;
                const height = rect.height;
                const rotateX = ((y / height) - 0.5) * 6; // Max tilt: 3 deg (subtle is more premium)
                const rotateY = (0.5 - (x / width)) * 6;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.015, 1.015, 1.015)`;
            });

            // Reset on mouse leave
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            });
        });
    };

    // Initialize immediately
    initTiltAndSpotlight();

    // Re-initialize when active elements change (e.g. filter buttons inside Bento grid run)
    const observer = new MutationObserver(() => {
        initTiltAndSpotlight();
    });
    
    // Watch body changes (covers dynamic rendering and filter modifications)
    observer.observe(document.body, { childList: true, subtree: true });
</script>
