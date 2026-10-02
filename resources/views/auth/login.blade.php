<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-white tracking-tight">Selamat Datang Kembali</h2>
        <p class="text-xs text-gray-400 mt-1">Masuk untuk mengelola portofolio & konten</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-1.5">Email</label>
            <input id="email" 
                   class="w-full bg-[#18181b] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   placeholder="admin@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-1.5">Password</label>
            <input id="password" 
                   class="w-full bg-[#18181b] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                   type="password"
                   name="password"
                   required 
                   autocomplete="current-password" 
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-xs pt-1">
            <label for="remember_me" class="inline-flex items-center text-gray-400 hover:text-gray-300 cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded bg-[#18181b] border-white/15 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-900" name="remember">
                <span class="ms-2">Ingat saya</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white font-bold text-sm rounded-xl transition-all duration-200 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/35 cursor-pointer">
                Masuk ke Admin Portal
            </button>
        </div>
    </form>
</x-guest-layout>
