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
            <h3 class="text-lg font-bold text-white tracking-tight">Edit Highlight Card</h3>
            <p class="text-xs text-gray-500 mt-0.5">Ubah judul, subtitle, dan ikon untuk kartu highlight. Layout visual tetap terjaga dengan aman.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.about.box.update', $box->id) }}" enctype="multipart/form-data" class="space-y-6">
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

            <!-- Icon Customization (File or URL or SVG) -->
            <div class="space-y-4 p-5 bg-black/30 rounded-2xl border border-white/5" x-data="{ uploadType: '{{ Str::startsWith($box->icon, '<svg') ? 'svg' : (Str::startsWith($box->icon, 'http') ? 'url' : (Str::startsWith($box->icon, 'data:') ? 'file' : 'svg')) }}' }">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Pilihan Tipe Ikon</span>
                        <div class="flex flex-wrap gap-4">
                            <label class="inline-flex items-center text-xs text-gray-300 cursor-pointer">
                                <input type="radio" name="upload_type" value="svg" x-model="uploadType" class="mr-2 text-blue-600 focus:ring-0"> SVG Code
                            </label>
                            <label class="inline-flex items-center text-xs text-gray-300 cursor-pointer">
                                <input type="radio" name="upload_type" value="file" x-model="uploadType" class="mr-2 text-blue-600 focus:ring-0"> Upload Gambar
                            </label>
                            <label class="inline-flex items-center text-xs text-gray-300 cursor-pointer">
                                <input type="radio" name="upload_type" value="url" x-model="uploadType" class="mr-2 text-blue-600 focus:ring-0"> Link URL Gambar
                            </label>
                        </div>
                    </div>

                    <!-- Current Icon Preview -->
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500">Ikon Saat Ini:</span>
                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-white/10 flex items-center justify-center bg-blue-500/10 text-blue-400">
                            @if(Str::startsWith($box->icon, '<svg'))
                                {!! $box->icon !!}
                            @elseif(Str::startsWith($box->icon, 'http') || Str::startsWith($box->icon, 'data:'))
                                <img src="{{ $box->icon }}" class="w-6 h-6 object-contain">
                            @else
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            @endif
                        </div>
                    </div>
                </div>

                <div x-show="uploadType === 'svg'" class="space-y-2">
                    <label for="icon_svg" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Kode SVG Ikon</label>
                    <textarea name="icon_svg" id="icon_svg" rows="3" placeholder="Contoh: <svg class='w-6 h-6 text-blue-500' ...>...</svg>"
                              class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-xs font-mono text-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">@if(Str::startsWith($box->icon, '<svg')){{ $box->icon }}@endif</textarea>
                    <p class="text-[10px] text-gray-500">💡 <strong>Rekomendasi</strong>: Tempel kode tag HTML &lt;svg&gt; lengkap di sini. Pastikan menyertakan class <code>w-6 h-6 text-blue-500</code> agar ikon otomatis berwarna biru mengikuti tema dan responsif terhadap hover.</p>
                    @error('icon_svg')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div x-show="uploadType === 'file'" class="space-y-2" style="display: none;">
                    <label for="icon_file" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Unggah Gambar Ikon</label>
                    <input type="file" name="icon_file" id="icon_file" accept="image/*"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Pilih gambar/icon format PNG/JPG/SVG. Maksimal 2MB.<br><span class="text-amber-500/80">⚠️ Gambar/file ikon tidak bisa berubah warna otomatis melalui CSS. Pastikan berkas Anda sudah berwarna biru (#3b82f6) atau putih (#ffffff).</span></p>
                    @error('icon_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div x-show="uploadType === 'url'" class="space-y-2" style="display: none;">
                    <label for="icon_url" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Link URL Gambar Ikon</label>
                    <input type="url" name="icon_url" id="icon_url" placeholder="Contoh: https://example.com/icon.svg" value="@if(Str::startsWith($box->icon, 'http')){{ $box->icon }}@endif"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Masukkan tautan gambar ikon.<br><span class="text-amber-500/80">⚠️ URL ikon tidak bisa berubah warna otomatis melalui CSS. Pastikan tautan gambar Anda sudah berwarna biru (#3b82f6) atau putih (#ffffff).</span></p>
                    @error('icon_url')
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
