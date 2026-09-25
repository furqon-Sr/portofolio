@extends('layouts.admin')

@section('title', 'Tambah Portfolio Baru')
@section('page-title', 'Tambah Portfolio')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.projects.index') }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-white/20 transition-all text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Buat Project Baru</h3>
            <p class="text-xs text-gray-500 mt-0.5">Isi detail project Anda untuk dipublikasikan.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="space-y-6" x-data="{ category: 'Web Dev' }">
            @csrf

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="space-y-2">
                    <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Judul Project</label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="Contoh: PDH Design System">
                    @error('title')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="space-y-2">
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Kategori</label>
                    <select name="category" id="category" x-model="category" required 
                            class="w-full bg-[#111111] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="Web Dev">Web Dev (Website Project)</option>
                        <option value="Design">Design (Desain Project)</option>
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
                          class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                          placeholder="Tuliskan rangkuman tentang apa yang Anda lakukan dalam project ini...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Links Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Live Link -->
                <div class="space-y-2">
                    <label for="live_link" class="block text-xs font-bold uppercase tracking-wider text-gray-400" x-text="category === 'Web Dev' ? 'Link Live Website' : 'Link Eksternal Cadangan (Opsional)'"></label>
                    <input type="url" name="live_link" id="live_link" :required="category === 'Web Dev'" value="{{ old('live_link') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://...">
                    <p class="text-[10px] text-gray-500" x-text="category === 'Web Dev' ? 'Gunakan link website asli untuk Web Dev.' : 'Opsional. Link cadangan jika ada klien yang ingin membuka tautan Google Drive / Figma eksternal.'"></p>
                    @error('live_link')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GitHub Link (Optional) -->
                <div class="space-y-2" x-show="category === 'Web Dev'">
                    <label for="github_link" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Link Repository GitHub (Opsional)</label>
                    <input type="url" name="github_link" id="github_link" value="{{ old('github_link') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://github.com/username/repo">
                    <p class="text-[10px] text-gray-500">Kosongkan jika bukan kategori website.</p>
                    @error('github_link')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Design PDF Document (For Design Projects) with Smart Chunked Upload (Bypasses Vercel 4.5MB limit) -->
            <div class="space-y-3 border-t border-white/5 pt-6" x-show="category === 'Design'"
                 x-data="{
                     uploading: false,
                     progress: 0,
                     statusText: '',
                     uploadedUrl: '{{ old('design_pdf_url') }}',
                     uploadedFilename: '',
                     fileSizeText: '',
                     errorMessage: '',
                     async handleFileSelect(e) {
                         const file = e.target.files[0];
                         if (!file) return;

                         if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                             this.errorMessage = 'Hanya format berkas PDF yang diperbolehkan.';
                             e.target.value = '';
                             return;
                         }

                         if (file.size > 50 * 1024 * 1024) {
                             this.errorMessage = 'Ukuran berkas melebihi batas maksimal 50MB.';
                             e.target.value = '';
                             return;
                         }

                         this.errorMessage = '';
                         this.uploadedFilename = file.name;
                         this.fileSizeText = (file.size / (1024 * 1024)).toFixed(1) + ' MB';
                         this.uploading = true;
                         this.progress = 5;
                         this.statusText = 'Mempersiapkan pengunggahan cloud...';

                         const chunkSize = 2 * 1024 * 1024; // 2MB safe chunks
                         const totalChunks = Math.ceil(file.size / chunkSize);
                         const uploadId = 'up_' + Date.now() + '_' + Math.random().toString(36).substring(2, 9);
                         const csrfToken = document.querySelector('input[name=_token]').value;

                         try {
                             for (let i = 0; i < totalChunks; i++) {
                                 const start = i * chunkSize;
                                 const end = Math.min(start + chunkSize, file.size);
                                 const chunk = file.slice(start, end);

                                 const formData = new FormData();
                                 formData.append('upload_id', uploadId);
                                 formData.append('chunk_index', i);
                                 formData.append('chunk', chunk, 'part_' + i + '.bin');

                                 this.statusText = `Mengunggah bagian ${i + 1} dari ${totalChunks} (${Math.round(((i + 1) / totalChunks) * 85)}%)...`;

                                 const res = await fetch('{{ route('admin.upload.chunk') }}', {
                                     method: 'POST',
                                     headers: {
                                         'X-CSRF-TOKEN': csrfToken,
                                         'Accept': 'application/json'
                                     },
                                     body: formData
                                 });

                                 if (!res.ok) {
                                     throw new Error('Gagal mengunggah bagian ' + (i + 1));
                                 }

                                 this.progress = Math.round(((i + 1) / totalChunks) * 85);
                             }

                             this.statusText = 'Memverifikasi dan memproses dokumen di cloud...';
                             this.progress = 92;

                             const combineRes = await fetch('{{ route('admin.upload.combine') }}', {
                                 method: 'POST',
                                 headers: {
                                     'X-CSRF-TOKEN': csrfToken,
                                     'Content-Type': 'application/json',
                                     'Accept': 'application/json'
                                 },
                                 body: JSON.stringify({
                                     upload_id: uploadId,
                                     total_chunks: totalChunks,
                                     filename: file.name,
                                     folder: 'designs'
                                 })
                             });

                             const result = await combineRes.json();
                             if (!result.success) {
                                 throw new Error(result.message || 'Gagal memproses berkas PDF.');
                             }

                             this.progress = 100;
                             this.uploadedUrl = result.url;
                             this.statusText = 'Selesai diunggah ke cloud storage!';
                             this.uploading = false;
                             
                             // Reset file input so form submission doesn't re-upload the large payload
                             e.target.value = '';
                         } catch (err) {
                             console.error(err);
                             this.errorMessage = err.message || 'Terjadi kesalahan saat mengunggah PDF.';
                             this.uploading = false;
                             e.target.value = '';
                         }
                     }
                 }">
                <div class="flex items-center justify-between">
                    <label for="design_pdf_input" class="block text-xs font-bold uppercase tracking-wider text-gray-400">
                        Berkas Dokumen Desain (PDF Multi-Halaman)
                    </label>
                    <span class="text-[10px] font-semibold text-blue-400 bg-blue-500/10 border border-blue-500/20 px-2.5 py-0.5 rounded-full">
                        Cloud Storage Diaktifkan (Hingga 50MB)
                    </span>
                </div>

                <!-- Hidden field holding the finalized uploaded R2 URL -->
                <input type="hidden" name="design_pdf_url" :value="uploadedUrl">

                <!-- Upload Input -->
                <input type="file" id="design_pdf_input" accept=".pdf,application/pdf"
                       @change="handleFileSelect"
                       :disabled="uploading"
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500 transition-all disabled:opacity-50 disabled:cursor-not-allowed">

                <!-- Progress Bar -->
                <div x-show="uploading" class="space-y-2 bg-white/[0.02] border border-white/5 p-4 rounded-xl" style="display: none;">
                    <div class="flex justify-between text-xs text-gray-300">
                        <span class="flex items-center gap-2">
                            <svg class="animate-spin w-3.5 h-3.5 text-blue-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                            <span x-text="statusText"></span>
                        </span>
                        <span class="font-mono text-blue-400 font-bold" x-text="progress + '%'"></span>
                    </div>
                    <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                    </div>
                </div>

                <!-- Success Badge -->
                <div x-show="uploadedUrl && !uploading" class="flex items-center justify-between p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-xs" style="display: none;">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <span class="font-semibold block" x-text="uploadedFilename ? uploadedFilename : 'Dokumen PDF'"></span>
                            <span class="text-[11px] text-emerald-400/80" x-text="'Tersimpan di Cloud Storage (' + fileSizeText + ') • Siap dipublikasikan'"></span>
                        </div>
                    </div>
                    <button type="button" @click="uploadedUrl = ''; uploadedFilename = '';" class="text-gray-400 hover:text-red-400 text-xs underline transition-colors">
                        Batal
                    </button>
                </div>

                <!-- Error Notice -->
                <div x-show="errorMessage" class="p-3 bg-red-500/10 border border-red-500/20 text-red-400 text-xs rounded-xl" style="display: none;" x-text="errorMessage"></div>

                <p class="text-[10px] text-gray-500">
                    💡 <strong>Smart Chunking Aktif</strong>: Berkas PDF besar (Brand Guidelines, Pitch Deck, Portfolio Desain hingga 50MB) otomatis dipecah dan diunggah langsung ke Cloudflare R2 tanpa membebani limit serverless Vercel.
                </p>
                @error('design_pdf_file')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
                @error('design_pdf_url')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cover Image (Base64 or URL) -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ imgSource: 'file' }">
                <!-- Info note for Design category -->
                <div x-show="category === 'Design'" class="p-3.5 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-start gap-3 text-xs text-blue-200">
                    <svg class="w-5 h-5 text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <div>
                        <strong class="font-semibold text-white block mb-0.5">Cover Otomatis Dokumen PDF (Seperti Sertifikat)</strong>
                        <span>Untuk kategori <strong>Design</strong> yang mengunggah dokumen PDF di atas, cover project otomatis menggunakan tampilan halaman dokumen PDF interaktif ala sertifikat. Unggah cover gambar di bawah bersifat <strong>opsional</strong>.</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">
                        Gambar Cover Project <span x-show="category === 'Design'" class="text-gray-500 font-normal lowercase">(opsional jika ada PDF)</span>
                    </span>
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
                    <p class="text-[10px] text-gray-500">Ukuran maksimal file 2MB. Gambar akan otomatis diubah menjadi Base64 agar dapat tersimpan permanen di serverless Vercel.</p>
                    @error('cover_image_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL Input -->
                <div x-show="imgSource === 'url'" class="space-y-2" style="display: none;">
                    <input type="url" name="cover_image_url" id="cover_image_url" value="{{ old('cover_image_url') }}"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://images.unsplash.com/... atau https://imgur.com/...">
                    <p class="text-[10px] text-gray-500">Tempel alamat URL gambar eksternal yang sudah online.</p>
                    @error('cover_image_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 border-t border-white/5 pt-6">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 text-sm font-semibold text-gray-400 hover:text-white transition-all">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white transition-all shadow-lg shadow-blue-500/20">Simpan Project</button>
            </div>
        </form>
    </div>

</div>
@endsection
