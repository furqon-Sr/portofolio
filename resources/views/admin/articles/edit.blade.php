@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.articles.index') }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-white/20 transition-all text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Edit Artikel</h3>
            <p class="text-xs text-gray-500 mt-0.5">Perbarui tulisan blog Anda.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="space-y-2">
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Judul Artikel</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $article->title) }}" 
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                @error('title')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Excerpt -->
            <div class="space-y-2">
                <label for="excerpt" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Cuplikan (Excerpt)</label>
                <textarea name="excerpt" id="excerpt" rows="2" 
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">{{ old('excerpt', $article->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div class="space-y-2">
                <label for="content" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Isi Artikel</label>
                <textarea name="content" id="content" rows="12" required
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sumber / Jurnal Referensi -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ references: {{ old('references') ? json_encode(old('references')) : ($article->references ? json_encode($article->references) : '[]') }} }">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Sumber / Jurnal Referensi (Opsional)</span>
                        <p class="text-[10px] text-gray-500 mt-1">Tambahkan link referensi atau sumber jurnal terkait artikel ini.</p>
                    </div>
                    <button type="button" @click="references.push({ title: '', url: '' })" class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white text-xs font-semibold rounded-lg transition-all flex items-center gap-1.5 border border-white/10 hover:border-white/20">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Referensi
                    </button>
                </div>

                <div class="space-y-3">
                    <template x-for="(ref, index) in references" :key="index">
                        <div class="flex items-start gap-3 p-4 bg-black/20 border border-white/5 rounded-xl group relative">
                            <div class="flex-1 space-y-3">
                                <div>
                                    <input type="text" x-model="ref.title" :name="`references[${index}][title]`" required
                                           class="w-full bg-white/[0.02] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-gray-600"
                                           placeholder="Nama Sumber / Judul Jurnal">
                                </div>
                                <div>
                                    <input type="url" x-model="ref.url" :name="`references[${index}][url]`" required
                                           class="w-full bg-white/[0.02] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-gray-600"
                                           placeholder="https://...">
                                </div>
                            </div>
                            <button type="button" @click="references.splice(index, 1)" class="p-2 text-gray-500 hover:text-red-400 hover:bg-red-400/10 rounded-lg transition-all" title="Hapus Referensi">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </template>
                </div>
                <!-- Empty State -->
                <div x-show="references.length === 0" class="py-4 text-center border border-dashed border-white/10 rounded-xl bg-white/[0.01]">
                    <p class="text-xs text-gray-500">Belum ada referensi yang ditambahkan.</p>
                </div>
                @error('references')
                    <p class="text-xs text-red-500 font-medium mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cover Image Preview -->
            @if($article->cover_image)
            <div class="space-y-2">
                <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Gambar Cover Saat Ini</span>
                <div class="w-32 h-20 rounded-lg overflow-hidden bg-white/5 border border-white/10">
                    <img src="{{ Str::startsWith($article->cover_image, 'http') || Str::startsWith($article->cover_image, 'data:') ? $article->cover_image : asset('img/' . $article->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                </div>
            </div>
            @endif

            <!-- Cover Image Update -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ imgSource: 'file' }">
                <div class="flex justify-between items-center">
                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Ganti Gambar Cover (Opsional)</span>
                    <!-- Tab Toggle -->
                    <div class="flex p-0.5 bg-black/40 rounded-lg border border-white/5">
                        <button type="button" @click="imgSource = 'file'" :class="imgSource === 'file' ? 'bg-blue-600 text-white' : 'text-gray-400'" class="px-3 py-1 text-[10px] font-bold rounded-md transition-all">Upload File</button>
                        <button type="button" @click="imgSource = 'url'" :class="imgSource === 'url' ? 'bg-blue-600 text-white' : 'text-gray-400'" class="px-3 py-1 text-[10px] font-bold rounded-md transition-all">Paste URL</button>
                    </div>
                </div>

                <!-- File Input -->
                <div x-show="imgSource === 'file'" class="space-y-2">
                    <input type="file" name="cover_image_file" id="cover_image_file" accept="image/*"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-2 text-sm text-gray-300 focus:outline-none focus:border-blue-500 transition-all">
                    @error('cover_image_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL Input -->
                <div x-show="imgSource === 'url'" class="space-y-2" style="display: none;">
                    <input type="url" name="cover_image_url" id="cover_image_url" value="{{ old('cover_image_url') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://example.com/image.jpg">
                    @error('cover_image_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-white/5 flex justify-end">
                <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white transition-all shadow-lg shadow-blue-500/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
