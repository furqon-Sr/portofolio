@extends('layouts.admin')

@section('title', 'Edit Expertise Logo')
@section('page-title', 'Edit Expertise Logo')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.about') }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-white/20 transition-all text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Edit Keahlian / Tech Logo: {{ $expertise->name }}</h3>
            <p class="text-xs text-gray-500 mt-0.5">Ubah data detail dan visual logo teknologi keahlian.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.about.expertise.update', $expertise->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Nama Teknologi</label>
                    <input type="text" name="name" id="name" required placeholder="Contoh: Laravel" value="{{ old('name', $expertise->name) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    @error('name')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Web Link -->
                <div class="space-y-2">
                    <label for="url" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Tautan Web Dokumentasi (Opsional)</label>
                    <input type="url" name="url" id="url" placeholder="Contoh: https://laravel.com" value="{{ old('url', $expertise->url) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    @error('url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Upload Logo (File or URL) -->
            <div class="space-y-4 p-5 bg-black/30 rounded-2xl border border-white/5" x-data="{ uploadType: 'file' }">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-6">
                        <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Pilihan Sumber Gambar Logo</span>
                        <div class="flex gap-4">
                            <label class="inline-flex items-center text-xs text-gray-300 cursor-pointer">
                                <input type="radio" name="upload_type" value="file" x-model="uploadType" class="mr-2 text-blue-600 focus:ring-0"> Upload File
                            </label>
                            <label class="inline-flex items-center text-xs text-gray-300 cursor-pointer">
                                <input type="radio" name="upload_type" value="url" x-model="uploadType" class="mr-2 text-blue-600 focus:ring-0"> Input URL Gambar
                            </label>
                        </div>
                    </div>

                    <!-- Current Logo Thumbnail -->
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500">Logo Saat Ini:</span>
                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-white/10 flex items-center justify-center {{ $expertise->bg_class }}">
                            <img src="{{ Str::startsWith($expertise->logo, 'http') || Str::startsWith($expertise->logo, 'data:') ? $expertise->logo : asset('img/logos/' . $expertise->logo) }}" 
                                 alt="Current" class="w-7 h-7 object-contain">
                        </div>
                    </div>
                </div>

                <div x-show="uploadType === 'file'" class="space-y-2">
                    <label for="logo_file" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Ganti File Gambar Logo</label>
                    <input type="file" name="logo_file" id="logo_file" accept="image/*"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah logo saat ini. Gunakan gambar berasio 1:1, max 2MB.</p>
                    @error('logo_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div x-show="uploadType === 'url'" class="space-y-2" style="display: none;">
                    <label for="logo_url" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Ganti URL Gambar Logo</label>
                    <input type="url" name="logo_url" id="logo_url" placeholder="Contoh: https://logo.com/react.png" value="{{ old('logo_url', (Str::startsWith($expertise->logo, 'http') ? $expertise->logo : '')) }}"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    @error('logo_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-white/5 pt-6">
                <!-- Background Class -->
                <div class="space-y-2">
                    <label for="bg_class" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Class Background Kartu (Tailwind)</label>
                    <input type="text" name="bg_class" id="bg_class" required placeholder="bg-white atau bg-[#FF2D20]/10" value="{{ old('bg_class', $expertise->bg_class) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500 mt-1">Class background kartu saat normal. Contoh: <strong>bg-white</strong> atau <strong>bg-[#FF2D20]/10</strong>.</p>
                    @error('bg_class')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hover Border Class -->
                <div class="space-y-2">
                    <label for="hover_class" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Class Hover Border (Tailwind)</label>
                    <input type="text" name="hover_class" id="hover_class" required placeholder="hover:border-blue-500 atau hover:border-[#FF2D20]" value="{{ old('hover_class', $expertise->hover_class) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500 mt-1">Border yang aktif saat mouse diarahkan ke kartu. Contoh: <strong>hover:border-blue-500</strong>.</p>
                    @error('hover_class')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-white/5">
                <a href="{{ route('admin.about') }}" class="px-5 py-2.5 rounded-xl border border-white/10 hover:bg-white/5 font-semibold text-sm text-gray-300 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white transition-all shadow-lg shadow-blue-500/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
