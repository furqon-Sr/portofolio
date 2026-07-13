@php
    $siteSetting = \App\Models\AboutSetting::first() ?? new \App\Models\AboutSetting([
        'hero_title' => 'Bridging the gap between optical balance and scalable architecture.',
        'hero_subtitle' => 'Product Designer & Fullstack Dev.'
    ]);
@endphp

<main class="relative mt-16 lg:mt-32 flex flex-col-reverse md:flex-row md:items-center md:justify-between gap-8 md:gap-12">
    <!-- Interactive Background Canvas -->
    <canvas id="hero-particles" class="absolute pointer-events-none z-0" style="top: -40px; left: -40px; width: calc(100% + 80px); height: calc(100% + 80px);"></canvas>

    <div class="w-full md:w-1/2 flex flex-col items-center text-center md:items-start md:text-left gap-6 z-10 animate-slide-up">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-[1.1] text-white tracking-tight">
            {{ $siteSetting->hero_title ?? 'Bridging the gap between optical balance and scalable architecture.' }}
        </h1>
        <p class="text-xl md:text-2xl bg-gradient-to-r from-[#1F7CE6] to-[#E1E1E1] text-transparent bg-clip-text font-medium tracking-wide">
            {{ $siteSetting->hero_subtitle ?? 'Product Designer & Fullstack Dev.' }}
        </p>
        <a href="/works" class="magnetic-btn relative mt-4 px-8 py-3 border border-white/20 text-white hover:text-gray-950 font-medium text-sm rounded-full hover:bg-white hover:border-white transition-all duration-300 inline-block text-center select-none">
            View My Work
        </a>
    </div>

    <div class="w-full md:w-1/2 flex justify-center md:justify-end z-10 animate-fade-in">
        <div class="relative w-3/5 max-w-[240px] md:w-2/3 md:max-w-[320px] lg:w-full lg:max-w-sm aspect-[4/5] rounded-2xl overflow-hidden">
            <img src="{{ $siteSetting->profile_photo ?? asset('img/porto.png') }}" alt="Hanafi" class="object-cover w-full h-full grayscale">
            <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-transparent to-transparent pointer-events-none"></div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const canvas = document.getElementById('hero-particles');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const container = canvas.parentElement;

        let particles = [];
        let mouse = { x: null, y: null, radius: 140 };
        let animationFrameId;
        let isVisible = true;

        // Handles resizing of canvas & keeps resolution sharp on retina displays
        function resize() {
            const rect = container.getBoundingClientRect();
            // Account for offsets of padding/margin (-40px on top/left/right/bottom)
            const extraX = 80;
            const extraY = 80;
            
            canvas.width = (rect.width + extraX) * window.devicePixelRatio;
            canvas.height = (rect.height + extraY) * window.devicePixelRatio;
            ctx.scale(window.devicePixelRatio, window.devicePixelRatio);
            
            canvas.style.width = `${rect.width + extraX}px`;
            canvas.style.height = `${rect.height + extraY}px`;
            
            initParticles();
        }

        // Particle model
        class Particle {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                // Randomized gentle drift vectors
                this.vx = (Math.random() - 0.5) * 0.35;
                this.vy = (Math.random() - 0.5) * 0.35;
                this.radius = Math.random() * 1.5 + 1;
            }

            update(width, height) {
                // Contain particle boundary movements
                if (this.x < 0 || this.x > width) this.vx *= -1;
                if (this.y < 0 || this.y > height) this.vy *= -1;

                this.x += this.vx;
                this.y += this.vy;

                // Mouse interaction - gentle attraction field
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
                ctx.fillStyle = 'rgba(59, 130, 246, 0.25)'; // Subtle theme-compliant blue accent
                ctx.fill();
            }
        }

        function initParticles() {
            particles = [];
            const rect = canvas.getBoundingClientRect();
            // Low particle counts optimized per screen size to protect CPU
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

            // Draw particles
            for (let i = 0; i < particles.length; i++) {
                particles[i].update(rect.width, rect.height);
                particles[i].draw();
            }

            // Draw connecting lines between close points
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

                // Interactive mouse node connections
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

        // Track cursor relative coordinates
        container.addEventListener('mousemove', (e) => {
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
        });

        container.addEventListener('mouseleave', () => {
            mouse.x = null;
            mouse.y = null;
        });

        // IntersectionObserver pauses calculation completely when scrolled out of view
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

        // Magnetic Button Effect
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

        window.addEventListener('resize', resize);
        resize();
    });
</script>
