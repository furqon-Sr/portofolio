@extends('layouts.admin')

@section('title', 'Edit Highlight Card')
@section('page-title', 'Edit Highlight Card')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.about') }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-white/20 transition-all text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Edit Highlight Teks</h3>
            <p class="text-xs text-gray-500 mt-0.5">Ubah judul dan subtitle kartu highlight. Ikon SVG dan layout visual tidak dapat diubah agar layout tetap terjaga.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.about.box.update', $box->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="space-y-2">
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Judul Kartu</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $box->title) }}" 
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                @error('title')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Deskripsi / Subtitle Kartu</label>
                <textarea name="description" id="description" rows="3" required 
                          class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">{{ old('description', $box->description) }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
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
