<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact - Fahruri Hanafi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .animate-slide-up { animation: slide-up 1s ease-out forwards; }
        @keyframes slide-up {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="relative overflow-x-hidden bg-gray-950 text-white antialiased selection:bg-blue-600 selection:text-white">
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute top-[40%] right-[-5%] w-[400px] h-[400px] rounded-full bg-blue-600/10 blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[20%] w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-[120px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8 flex flex-col min-h-screen">
        <x-navigation />

        <main class="flex-grow flex items-center justify-center py-24 animate-slide-up">
            <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-6">Let's build something <span class="text-blue-500">amazing</span> together.</h1>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        I'm currently available for freelance projects and open to full-time opportunities. If you're looking for a developer who understands design, or a designer who understands engineering, let's talk.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#1a1a1a] border border-gray-800 flex items-center justify-center text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Email</p>
                                <a href="mailto:fahrurihanafi@gmail.com" class="text-white hover:text-blue-400 transition-colors font-semibold">fahrurihanafi@gmail.com</a>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#1a1a1a] border border-gray-800 flex items-center justify-center text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Location</p>
                                <p class="text-white font-semibold">Surabaya, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Contact Form -->
                <div class="bg-[#1a1a1a] p-8 md:p-10 rounded-2xl border border-white-10 shadow-2xl">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-600 text-white rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full bg-[#111] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="Tulis nama Anda">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full bg-[#111] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="Tulis email Anda">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-400 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full bg-[#111] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors resize-none" placeholder="Tulis pesan Anda"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-1">
                            Send Message
                        </button>
                    </form>
                </div>
                
            </div>
        </main>

        <x-footer />
    </div>
</body>
</html>
