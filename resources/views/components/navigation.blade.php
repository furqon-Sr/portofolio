<nav x-data="{ open: false }" class="py-6 border-b border-gray-800 relative z-50">
    <div class="flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tighter text-white">HANAFI</div>
        
        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-400">
            <a href="/works" class="hover:text-white transition-colors">Works</a>
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
         class="md:hidden absolute top-full left-0 right-0 bg-[#111111] border-b border-gray-800 z-50 flex flex-col items-center py-6 gap-6 shadow-2xl">
        <a href="/works" class="text-gray-400 hover:text-white font-medium transition-colors">Works</a>
        <a href="/#about" class="text-gray-400 hover:text-white font-medium transition-colors">About</a>
        <a href="/contact" class="text-gray-400 hover:text-white font-medium transition-colors">Contact</a>
        <a href="{{ asset('assets/cv-hanafi copy.pdf') }}" download="CV_Hanafi.pdf" class="px-6 py-2 mt-2 text-sm font-semibold bg-transparent border border-white text-white rounded-full hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
            Download CV
        </a>
    </div>
</nav>
