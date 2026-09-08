@php
    $siteSetting = \App\Models\AboutSetting::first() ?? new \App\Models\AboutSetting([
        'hero_title' => 'Bridging the gap between optical balance and scalable architecture.',
        'hero_subtitle' => 'Product Designer & Fullstack Dev.'
    ]);
@endphp

<main class="relative mt-16 lg:mt-32 flex flex-col-reverse md:flex-row md:items-center md:justify-between gap-8 md:gap-12">
    <!-- Interactive Background Canvas -->
    <canvas id="hero-particles" class="absolute pointer-events-none z-0" style="top: -40px; left: -40px; width: calc(100% + 80px); height: calc(100% + 80px);"></canvas>

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

    <!-- Right Column: Profile Card with SVG Border Draw & 3D Tilt -->
    <div class="w-full md:w-1/2 flex justify-center md:justify-end z-10" style="perspective: 1200px;">
        <div id="hero-card-wrapper" class="relative group cursor-pointer" style="transform-style: preserve-3d;">
            
            <!-- Ambient Dynamic Glow Backing -->
            <div id="hero-card-glow" class="absolute -inset-3 bg-gradient-to-tr from-blue-600/30 via-cyan-500/20 to-blue-400/30 rounded-3xl blur-2xl opacity-0 transition-opacity duration-1000 pointer-events-none"></div>

            <!-- Main Profile Card Container -->
            <div id="hero-profile-card" class="relative w-[220px] sm:w-[260px] md:w-[290px] lg:w-[330px] aspect-[4/5] rounded-2xl overflow-hidden will-change-transform shadow-2xl shadow-black/90 border border-white/5" style="transform-style: preserve-3d;">
                
                <!-- SVG Animated Border Outline -->
                <svg class="absolute inset-0 w-full h-full pointer-events-none z-20" xmlns="http://www.w3.org/2000/svg">
                    <rect id="hero-border-rect" x="1" y="1" width="calc(100% - 2px)" height="calc(100% - 2px)" rx="16" ry="16" fill="none" stroke="url(#hero-blue-grad)" stroke-width="1.5" stroke-dasharray="1400" stroke-dashoffset="1400" />
                    <defs>
                        <linearGradient id="hero-blue-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#93C5FD" stop-opacity="0.9" />
                            <stop offset="50%" stop-color="#3B82F6" stop-opacity="0.5" />
                            <stop offset="100%" stop-color="#60A5FA" stop-opacity="0.9" />
                        </linearGradient>
                    </defs>
                </svg>

                <!-- Profile Photo -->
                <div class="relative w-full h-full" style="mask-image: linear-gradient(to top, transparent 0%, black 35%); -webkit-mask-image: linear-gradient(to top, transparent 0%, black 35%);">
                    <img id="hero-profile-img" src="{{ $siteSetting->profile_photo ?? asset('img/porto.png') }}" alt="Hanafi" class="object-cover w-full h-full grayscale transition-all duration-700 group-hover:grayscale-[40%] group-hover:scale-105 select-none pointer-events-none">
                </div>

                <!-- Subtle Card Glare / Reflection Overlay -->
                <div id="hero-card-glare" class="absolute inset-0 rounded-2xl pointer-events-none z-10 opacity-0 transition-opacity duration-300" style="background: radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.15), transparent 70%);"></div>
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
        const borderRect = document.getElementById('hero-border-rect');
        const cardGlow = document.getElementById('hero-card-glow');
        const cardGlare = document.getElementById('hero-card-glare');

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
                    delay: 350,
                    complete: () => {
                        if (cardGlow) cardGlow.classList.remove('opacity-0');
                    }
                });
            }

            // Animate SVG Border Drawing
            if (borderRect) {
                anime({
                    targets: borderRect,
                    strokeDashoffset: [1400, 0],
                    duration: 2000,
                    easing: 'cubicBezier(0.25, 1, 0.5, 1)',
                    delay: 450,
                    complete: () => {
                        // Subtle breathing pulse loop on SVG border
                        anime({
                            targets: borderRect,
                            strokeOpacity: [0.45, 0.95],
                            strokeWidth: [1.2, 1.8],
                            duration: 3000,
                            direction: 'alternate',
                            loop: true,
                            easing: 'easeInOutSine'
                        });
                    }
                });
            }

            // --- 2. INTERACTIVE 3D TILT WITH PHYSICS SMOOTHING ---
            const heroSection = document.querySelector('main');
            if (heroSection && cardWrapper && window.matchMedia('(hover: hover)').matches) {
                heroSection.addEventListener('mousemove', (e) => {
                    const rect = cardWrapper.getBoundingClientRect();
                    const cardCenterX = rect.left + rect.width / 2;
                    const cardCenterY = rect.top + rect.height / 2;

                    const deltaX = (e.clientX - cardCenterX) / (window.innerWidth / 2);
                    const deltaY = (e.clientY - cardCenterY) / (window.innerHeight / 2);

                    const tiltX = -deltaY * 9;
                    const tiltY = deltaX * 9;

                    anime({
                        targets: cardWrapper,
                        rotateX: tiltX,
                        rotateY: tiltY,
                        duration: 350,
                        easing: 'easeOutQuad'
                    });

                    if (cardGlare) {
                        cardGlare.style.opacity = '1';
                        const glareX = ((e.clientX - rect.left) / rect.width) * 100;
                        const glareY = ((e.clientY - rect.top) / rect.height) * 100;
                        cardGlare.style.background = `radial-gradient(circle at ${glareX}% ${glareY}%, rgba(255, 255, 255, 0.16), transparent 60%)`;
                    }
                });

                heroSection.addEventListener('mouseleave', () => {
                    if (cardGlare) cardGlare.style.opacity = '0';
                    anime({
                        targets: cardWrapper,
                        rotateX: 0,
                        rotateY: 0,
                        duration: 850,
                        easing: 'cubicBezier(0.16, 1, 0.3, 1)'
                    });
                });
            }
        }

        // --- 3. BACKGROUND PARTICLES CANVAS ---
        const canvas = document.getElementById('hero-particles');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            const container = canvas.parentElement;

            let particles = [];
            let mouse = { x: null, y: null, radius: 140 };
            let animationFrameId;
            let isVisible = true;

            function resize() {
                const rect = container.getBoundingClientRect();
                const extraX = 80;
                const extraY = 80;
                
                canvas.width = (rect.width + extraX) * window.devicePixelRatio;
                canvas.height = (rect.height + extraY) * window.devicePixelRatio;
                ctx.scale(window.devicePixelRatio, window.devicePixelRatio);
                
                canvas.style.width = `${rect.width + extraX}px`;
                canvas.style.height = `${rect.height + extraY}px`;
                
                initParticles();
            }

            class Particle {
                constructor(x, y) {
                    this.x = x;
                    this.y = y;
                    this.vx = (Math.random() - 0.5) * 0.35;
                    this.vy = (Math.random() - 0.5) * 0.35;
                    this.radius = Math.random() * 1.5 + 1;
                }

                update(width, height) {
                    if (this.x < 0 || this.x > width) this.vx *= -1;
                    if (this.y < 0 || this.y > height) this.vy *= -1;

                    this.x += this.vx;
                    this.y += this.vy;

                    if (mouse.x !== null && mouse.y !== null) {
                        const dx = mouse.x - this.x;
                        const dy = mouse.y - this.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < mouse.radius) {
                            const force = (mouse.radius - dist) / mouse.radius;
                            this.x += (dx / dist) * force * 0.25;
                            this.y += (dy / dist) * force * 0.25;
                        }
                    }
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(59, 130, 246, 0.25)';
                    ctx.fill();
                }
            }

            function initParticles() {
                particles = [];
                const rect = canvas.getBoundingClientRect();
                const count = window.innerWidth < 768 ? 20 : 45;
                
                for (let i = 0; i < count; i++) {
                    const x = Math.random() * rect.width;
                    const y = Math.random() * rect.height;
                    particles.push(new Particle(x, y));
                }
            }

            function animate() {
                if (!isVisible) return;
                
                const rect = canvas.getBoundingClientRect();
                ctx.clearRect(0, 0, rect.width, rect.height);

                for (let i = 0; i < particles.length; i++) {
                    particles[i].update(rect.width, rect.height);
                    particles[i].draw();
                }

                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const dx = particles[i].x - particles[j].x;
                        const dy = particles[i].y - particles[j].y;
                        const dist = Math.sqrt(dx * dx + dy * dy);

                        if (dist < 100) {
                            const alpha = ((100 - dist) / 100) * 0.08;
                            ctx.strokeStyle = `rgba(59, 130, 246, ${alpha})`;
                            ctx.lineWidth = 0.5;
                            ctx.beginPath();
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.stroke();
                        }
                    }

                    if (mouse.x !== null && mouse.y !== null) {
                        const dx = particles[i].x - mouse.x;
                        const dy = particles[i].y - mouse.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < mouse.radius) {
                            const alpha = ((mouse.radius - dist) / mouse.radius) * 0.12;
                            ctx.strokeStyle = `rgba(59, 130, 246, ${alpha})`;
                            ctx.lineWidth = 0.5;
                            ctx.beginPath();
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(mouse.x, mouse.y);
                            ctx.stroke();
                        }
                    }
                }

                animationFrameId = requestAnimationFrame(animate);
            }

            container.addEventListener('mousemove', (e) => {
                const rect = canvas.getBoundingClientRect();
                mouse.x = e.clientX - rect.left;
                mouse.y = e.clientY - rect.top;
            });

            container.addEventListener('mouseleave', () => {
                mouse.x = null;
                mouse.y = null;
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    isVisible = entry.isIntersecting;
                    if (isVisible) {
                        cancelAnimationFrame(animationFrameId);
                        animate();
                    }
                });
            }, { threshold: 0.05 });

            observer.observe(canvas);

            window.addEventListener('resize', resize);
            resize();
        }

        // --- 4. MAGNETIC BUTTON ---
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
