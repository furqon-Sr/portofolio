<x-guest-layout>
    <div class="mb-5">
        <h1 class="text-base font-semibold text-white tracking-tight">Atur Ulang Sandi</h1>
        <p class="text-xs text-zinc-400 mt-1">Masukkan email terdaftar untuk menerima tautan atur ulang kata sandi.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-xs text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-2.5 rounded-xl" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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
                   placeholder="admin@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-400" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 bg-white hover:bg-zinc-200 active:scale-[0.99] text-zinc-950 font-semibold text-sm rounded-xl transition-all duration-150 shadow-sm cursor-pointer flex items-center justify-center gap-2">
                <span>Kirim Tautan Atur Ulang</span>
            </button>
        </div>

        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="text-xs text-zinc-400 hover:text-white transition-colors">
                ← Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
