@props(['siteSetting' => null])

@php
    $siteSetting = $siteSetting ?? $siteSettingsData ?? \App\Models\AboutSetting::first() ?? new \App\Models\AboutSetting([
        'hero_title' => 'Bridging the gap between optical balance and scalable architecture.',
        'hero_subtitle' => 'Product Designer & Fullstack Dev.'
    ]);
@endphp

<main class="relative mt-16 lg:mt-32 flex flex-col-reverse md:flex-row md:items-center md:justify-between gap-8 md:gap-12">
    <!-- Point-light scene (three.js). Screen-blended so only the light shows on top of the page background. -->
    <div id="hero-lights" aria-hidden="true" class="absolute pointer-events-none z-0 opacity-0 transition-opacity duration-1000"
         style="left: 50%; width: 100vw; margin-left: -50vw; top: -7rem; bottom: -9rem; mix-blend-mode: screen; -webkit-mask-image: linear-gradient(to bottom, transparent, #000 16%, #000 78%, transparent); mask-image: linear-gradient(to bottom, transparent, #000 16%, #000 78%, transparent);">
        <canvas class="block w-full h-full"></canvas>
    </div>

    <!-- Left Column: Kinetic Typography -->
    <div class="w-full md:w-1/2 flex flex-col items-center text-center md:items-start md:text-left gap-6 z-10">
        <h1 id="hero-title" class="text-4xl md:text-5xl lg:text-6xl font-bold leading-[1.15] text-white tracking-tight will-change-transform">
            {{ $siteSetting->hero_title ?? 'Bridging the gap between optical balance and scalable architecture.' }}
        </h1>
        <p id="hero-subtitle" class="text-xl md:text-2xl bg-gradient-to-r from-[#1F7CE6] via-[#60A5FA] to-[#E1E1E1] text-transparent bg-clip-text font-medium tracking-wide will-change-transform">
            {{ $siteSetting->hero_subtitle ?? 'Product Designer & Fullstack Dev.' }}
        </p>
        <div id="hero-cta" class="flex flex-wrap items-center justify-center md:justify-start gap-4 mt-2 will-change-transform">
            <a href="/works" class="magnetic-btn relative px-8 py-3 border border-white/20 text-white hover:text-gray-950 font-medium text-sm rounded-full hover:bg-white hover:border-white transition-all duration-300 inline-block text-center select-none shadow-lg shadow-blue-500/10 hover:shadow-white/20">
                View My Work
            </a>
        </div>
    </div>

    <!-- Right Column: Profile Card (layout anchor + fallback; the lit version is drawn by hero-lights.js) -->
    <div class="w-full md:w-1/2 flex justify-center md:justify-end z-10" style="perspective: 1200px;">
        <div id="hero-card-wrapper" class="relative group" style="transform-style: preserve-3d;">

            <!-- Main Profile Card Container (Clean without border) -->
            <div id="hero-profile-card" class="relative w-[220px] sm:w-[260px] md:w-[290px] lg:w-[330px] aspect-[4/5] rounded-2xl overflow-hidden will-change-transform shadow-2xl shadow-black/90" style="transform-style: preserve-3d;">
                
                <!-- Profile Photo -->
                <div class="relative w-full h-full" style="mask-image: linear-gradient(to top, transparent 0%, black 35%); -webkit-mask-image: linear-gradient(to top, transparent 0%, black 35%);">
                    @php
                        $defaultHeroImg = file_exists(public_path('img/porto.webp')) ? asset('img/porto.webp') : asset('img/porto.png');
                        $rawHeroPhoto = $siteSetting->profile_photo ?? $defaultHeroImg;
                        if (str_ends_with($rawHeroPhoto, 'porto.png') && file_exists(public_path('img/porto.webp'))) {
                            $rawHeroPhoto = str_replace('porto.png', 'porto.webp', $rawHeroPhoto);
                        }
                        $heroImgSrc = Str::startsWith($rawHeroPhoto, 'data:') 
                            ? route('media.profile', ['v' => $siteSetting->updated_at?->timestamp ?? 1]) 
                            : $rawHeroPhoto;
                    @endphp
                    <img id="hero-profile-img" 
                         src="{{ $heroImgSrc }}" 
                         alt="Hanafi" 
                         width="330" 
                         height="412" 
                         fetchpriority="high" 
                         loading="eager" 
                         decoding="async" 
                         class="object-cover w-full h-full grayscale transition-all duration-700 group-hover:grayscale-[40%] group-hover:scale-105 select-none pointer-events-none">
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- 1. KINETIC TYPOGRAPHY & CARD REVEAL VIA ANIME.JS ---
        const titleEl = document.getElementById('hero-title');
        const subtitleEl = document.getElementById('hero-subtitle');
        const ctaEl = document.getElementById('hero-cta');
        const cardWrapper = document.getElementById('hero-card-wrapper');

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (typeof anime !== 'undefined' && !prefersReducedMotion) {
            // Split title text into kinetic words
            if (titleEl) {
                const words = titleEl.innerText.trim().split(/\s+/);
                titleEl.innerHTML = words.map(word => 
                    `<span class="inline-block overflow-hidden pb-1 -mb-1 mr-[0.28em] align-top"><span class="hero-word inline-block will-change-transform opacity-0">${word}</span></span>`
                ).join('');

                // Animate title words with staggered slide-up
                anime({
                    targets: '#hero-title .hero-word',
                    translateY: ['115%', '0%'],
                    opacity: [0, 1],
                    rotateZ: [2.5, 0],
                    duration: 950,
                    easing: 'cubicBezier(0.16, 1, 0.3, 1)',
                    delay: anime.stagger(40, { start: 150 })
                });
            }

            // Animate subtitle
            if (subtitleEl) {
                subtitleEl.style.opacity = '0';
                anime({
                    targets: subtitleEl,
                    translateY: [25, 0],
                    opacity: [0, 1],
                    duration: 900,
                    easing: 'cubicBezier(0.16, 1, 0.3, 1)',
                    delay: 550
                });
            }

            // Animate CTA
            if (ctaEl) {
                ctaEl.style.opacity = '0';
                anime({
                    targets: ctaEl,
                    translateY: [20, 0],
                    opacity: [0, 1],
                    scale: [0.95, 1],
                    duration: 800,
                    easing: 'cubicBezier(0.16, 1, 0.3, 1)',
                    delay: 750
                });
            }

            // Animate Profile Card Entrance
            if (cardWrapper) {
                cardWrapper.style.opacity = '0';
                anime({
                    targets: cardWrapper,
                    translateY: [40, 0],
                    scale: [0.92, 1],
                    opacity: [0, 1],
                    duration: 1200,
                    easing: 'cubicBezier(0.16, 1, 0.3, 1)',
                    delay: 350
                });
            }
        }

        // --- 2. MAGNETIC BUTTON ---
        document.querySelectorAll('.magnetic-btn').forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = (e.clientX - rect.left) - (rect.width / 2);
                const y = (e.clientY - rect.top) - (rect.height / 2);
                
                btn.style.transform = `translate3d(${x * 0.35}px, ${y * 0.35}px, 0)`;
                btn.style.transition = 'transform 0.08s ease-out';
            });
            
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translate3d(0, 0, 0)';
                btn.style.transition = 'transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            });
        });
    });
</script>

<script type="module" src="{{ asset('js/hero-lights.js') }}?v={{ \@filemtime(public_path('js/hero-lights.js')) }}"></script>
