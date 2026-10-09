<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-xs text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-2.5 rounded-xl" :status="session('status')" />

    <div class="mb-6 text-center">
        <h1 class="text-base font-semibold text-white tracking-tight">Masuk ke Akun</h1>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-zinc-300 mb-1.5">Email</label>
            <input id="email" 
                   class="w-full bg-zinc-950/70 border border-white/10 rounded-xl px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/20 transition-all duration-150" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   placeholder="admin@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-medium text-zinc-300">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[11px] text-zinc-400 hover:text-white transition-colors">Lupa sandi?</a>
                @endif
            </div>
            <input id="password" 
                   class="w-full bg-zinc-950/70 border border-white/10 rounded-xl px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/20 transition-all duration-150"
                   type="password"
                   name="password"
                   required 
                   autocomplete="current-password" 
                   placeholder="••••••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-xs pt-0.5">
            <label for="remember_me" class="inline-flex items-center text-zinc-400 hover:text-zinc-200 cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded bg-zinc-900 border-white/20 text-white focus:ring-0 focus:ring-offset-0" name="remember">
                <span class="ms-2 text-xs">Ingat saya</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-white hover:bg-zinc-200 active:scale-[0.99] text-zinc-950 font-semibold text-sm rounded-xl transition-all duration-150 shadow-sm cursor-pointer flex items-center justify-center gap-2">
                <span>Masuk ke Akun</span>
                <svg class="w-4 h-4 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </form>
</x-guest-layout>
