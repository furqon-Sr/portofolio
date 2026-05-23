@extends('layouts.admin')

@section('title', 'Edit Portfolio')
@section('page-title', 'Edit Portfolio')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.projects.index') }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-white/20 transition-all text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Edit Project: {{ $project->title }}</h3>
            <p class="text-xs text-gray-500 mt-0.5">Ubah detail data project Anda.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data" class="space-y-6" x-data="{ category: '{{ old('category', $project->category) }}' }">
            @csrf
            @method('PUT')

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="space-y-2">
                    <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Judul Project</label>
                    <input type="text" name="title" id="title" required value="{{ old('title', $project->title) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    @error('title')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="space-y-2">
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Kategori</label>
                    <select name="category" id="category" x-model="category" required 
                            class="w-full bg-[#111111] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="Web Dev" {{ old('category', $project->category) === 'Web Dev' ? 'selected' : '' }}>Web Dev (Website Project)</option>
                        <option value="Design" {{ old('category', $project->category) === 'Design' ? 'selected' : '' }}>Design (Desain Project)</option>
                    </select>
                    @error('category')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Deskripsi Singkat</label>
                <textarea name="description" id="description" rows="4" required 
                          class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Links Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Live Link -->
                <div class="space-y-2">
                    <label for="live_link" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Link Preview / Tautan</label>
                    <input type="url" name="live_link" id="live_link" required value="{{ old('live_link', $project->live_link) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Gunakan link website asli untuk Web Dev, atau link folder Google Drive untuk Design.</p>
                    @error('live_link')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GitHub Link (Optional) -->
                <div class="space-y-2" x-show="category === 'Web Dev'">
                    <label for="github_link" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Link Repository GitHub (Opsional)</label>
                    <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $project->github_link) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Kosongkan jika bukan kategori website.</p>
                    @error('github_link')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Cover Image Preview & Replacement -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ imgSource: 'file' }">
                
                <!-- Current Thumbnail -->
                <div class="flex items-center gap-4 bg-white/[0.01] p-4 rounded-xl border border-white/5">
                    <div class="w-24 h-16 rounded-lg overflow-hidden bg-white/5 border border-white/10 flex-shrink-0 relative">
                        <img src="{{ Str::startsWith($project->cover_image, 'http') || Str::startsWith($project->cover_image, 'data:') ? $project->cover_image : asset('img/' . $project->cover_image) }}" 
                             alt="Current cover" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase text-gray-500 tracking-wider">Cover Image Saat Ini</h4>
                        <p class="text-xs text-gray-300 mt-1 truncate max-w-[200px] md:max-w-md">{{ Str::startsWith($project->cover_image, 'data:') ? 'Base64 Encoded Image Data' : $project->cover_image }}</p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-4">
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
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar. File diunggah akan otomatis diubah menjadi Base64.</p>
                    @error('cover_image_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL Input -->
                <div x-show="imgSource === 'url'" class="space-y-2" style="display: none;">
                    <input type="url" name="cover_image_url" id="cover_image_url" value="{{ old('cover_image_url') }}"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://images.unsplash.com/... atau https://imgur.com/... (Biarkan kosong jika tidak diubah)">
                    <p class="text-[10px] text-gray-500">Tempel URL gambar baru untuk mengganti cover saat ini.</p>
                    @error('cover_image_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 border-t border-white/5 pt-6">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 text-sm font-semibold text-gray-400 hover:text-white transition-all">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white transition-all shadow-lg shadow-blue-500/20">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</div>
@endsection
