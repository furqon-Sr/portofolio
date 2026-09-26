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
                    <label for="live_link" class="block text-xs font-bold uppercase tracking-wider text-gray-400" x-text="category === 'Web Dev' ? 'Link Live Website' : 'Link Eksternal Cadangan (Opsional)'"></label>
                    <input type="url" name="live_link" id="live_link" :required="category === 'Web Dev'" value="{{ old('live_link', $project->live_link) }}" 
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
                    <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $project->github_link) }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://github.com/username/repo">
                    <p class="text-[10px] text-gray-500">Kosongkan jika bukan kategori website.</p>
                    @error('github_link')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Design PDF Document (For Design Projects) -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-show="category === 'Design'">
                <div class="flex items-center justify-between">
                    <label for="design_pdf_file" class="block text-xs font-bold uppercase tracking-wider text-gray-400">
                        Berkas Dokumen Desain (PDF Multi-Halaman)
                    </label>
                    @if($project->design_file)
                    <span class="text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-full flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        PDF Tersimpan
                    </span>
                    @else
                    <span class="text-[10px] font-semibold text-yellow-400 bg-yellow-500/10 border border-yellow-500/20 px-2.5 py-0.5 rounded-full">
                        Belum Ada File PDF
                    </span>
                    @endif
                </div>

                @if($project->design_file)
                <div class="flex items-center justify-between p-3 rounded-xl bg-white/[0.02] border border-white/5">
                    <div class="flex items-center gap-2.5 text-xs text-gray-300">
                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                        <span>Dokumen PDF Desain saat ini sudah aktif</span>
                    </div>
                    <a href="{{ route('media.project.design', $project->id) }}" target="_blank" class="text-xs text-blue-400 hover:text-blue-300 font-semibold flex items-center gap-1 transition-colors">
                        <span>Pratinjau PDF</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    </a>
                </div>
                @endif

                <div class="space-y-3"
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

                            const chunkSize = 3 * 1024 * 1024; // 3MB safe chunks (minimizes chunk count and avoids WAF rate-limiting)
                             const totalChunks = Math.ceil(file.size / chunkSize);
                             const uploadId = 'up_' + Date.now() + '_' + Math.random().toString(36).substring(2, 9);
                             
                             const getCsrf = () => {
                                 const cookieMatch = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
                                 return cookieMatch ? decodeURIComponent(cookieMatch[1]) : (document.querySelector('input[name=_token]')?.value || '');
                             };
                             
                             try {
                                 for (let i = 0; i < totalChunks; i++) {
                                    if (i > 0) {
                                        // Pacing delay between chunk uploads to prevent Vercel WAF burst rate-limiting (HTTP 403)
                                        await new Promise(r => setTimeout(r, 600));
                                    }
                                     const start = i * chunkSize;
                                     const end = Math.min(start + chunkSize, file.size);
                                     const chunk = file.slice(start, end);
                             
                                     let uploadSuccess = false;
                                     let lastErr = null;
                             
                                     for (let attempt = 1; attempt <= 3; attempt++) {
                                         try {
                                             const formData = new FormData();
                                             formData.append('upload_id', uploadId);
                                             formData.append('chunk_index', i);
                                             formData.append('chunk', chunk, 'part_' + i + '.bin');
                             
                                             const percent = Math.round(((i + 1) / totalChunks) * 85);
                                             this.statusText = attempt > 1 
                                                 ? `Mencoba ulang bagian ${i + 1} (Percobaan ${attempt}/3)...` 
                                                 : `Mengunggah bagian ${i + 1} dari ${totalChunks} (${percent}%)...`;
                             
                                             const res = await fetch('{{ route('admin.upload.chunk') }}', {
                                                 method: 'POST',
                                                 headers: {
                                                     'X-CSRF-TOKEN': getCsrf(),
                                                     'Accept': 'application/json'
                                                 },
                                                 body: formData
                                             });
                             
                                             if (res.ok) {
                                                 const json = await res.json();
                                                 if (json && json.success) {
                                                     uploadSuccess = true;
                                                     break;
                                                 } else {
                                                     lastErr = new Error(json?.message || `Gagal menyimpan bagian ${i + 1}`);
                                                 }
                                             } else {
                                                 let msg = '';
                                                 try {
                                                     const jsonErr = await res.json();
                                                     msg = jsonErr?.message || '';
                                                 } catch(_) {
                                                     msg = `HTTP ${res.status} ${res.statusText}`;
                                                 }
                                                 lastErr = new Error(`Bagian ${i + 1}: ${msg}`);
                                                if (res.status === 403 || res.status === 429 || res.status === 504) {
                                                    lastErr.isRateLimitOrTimeout = true;
                                                }
                                             }
                                         } catch (netErr) {
                                             lastErr = netErr;
                                         }
                             
                                         if (attempt < 3) {
                                            const retryDelay = lastErr?.isRateLimitOrTimeout ? 2500 : 1200;
                                            await new Promise(r => setTimeout(r, retryDelay));
                                        }
                                     }
                             
                                     if (!uploadSuccess) {
                                         throw (lastErr || new Error(`Gagal mengunggah bagian ${i + 1} setelah 3 kali percobaan.`));
                                     }
                             
                                     this.progress = Math.round(((i + 1) / totalChunks) * 85);
                                 }
                             
                                 this.statusText = 'Memverifikasi dan memproses dokumen di cloud...';
                                 this.progress = 92;
                                 await new Promise(r => setTimeout(r, 600));
                             
                                 let combineSuccess = false;
                                 let combineErr = null;
                             
                                 for (let cAttempt = 1; cAttempt <= 3; cAttempt++) {
                                     try {
                                         const combineRes = await fetch('{{ route('admin.upload.combine') }}', {
                                             method: 'POST',
                                             headers: {
                                                 'X-CSRF-TOKEN': getCsrf(),
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
                             
                                         if (combineRes.ok) {
                                             const result = await combineRes.json();
                                             if (result && result.success) {
                                                 combineSuccess = true;
                                                 this.progress = 100;
                                                 this.uploadedUrl = result.url;
                                                 this.statusText = 'Selesai diunggah ke cloud storage!';
                                                 this.uploading = false;
                                                 e.target.value = '';
                                                 break;
                                             } else {
                                                 combineErr = new Error(result?.message || 'Gagal memproses berkas PDF.');
                                             }
                                         } else {
                                             let cMsg = '';
                                             try {
                                                 const cJson = await combineRes.json();
                                                 cMsg = cJson?.message || '';
                                             } catch(_) {
                                                 cMsg = `HTTP ${combineRes.status} ${combineRes.statusText}`;
                                             }
                                             combineErr = new Error(`Gagal memproses dokumen di cloud: ${cMsg}`);
                                         }
                                     } catch (netE) {
                                         combineErr = netE;
                                     }
                             
                                     if (cAttempt < 3) {
                                         this.statusText = `Mencoba ulang proses penggabungan dokumen (Percobaan ${cAttempt + 1}/3)...`;
                                         await new Promise(r => setTimeout(r, 2000));
                                     }
                                 }
                             
                                 if (!combineSuccess) {
                                     throw (combineErr || new Error('Gagal memproses berkas PDF di cloud.'));
                                 }
                             } catch (err) {
                                 console.error(err);
                                 this.errorMessage = err.message || 'Terjadi kesalahan saat mengunggah PDF.';
                                 this.uploading = false;
                                 e.target.value = '';
                             }
                         }
                     }">
                    <span class="block text-xs font-semibold text-gray-300">
                        {{ $project->design_file ? 'Ganti dengan File PDF Baru (Opsional)' : 'Unggah File PDF Desain' }}
                    </span>

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
                                <span class="font-semibold block" x-text="uploadedFilename ? uploadedFilename : 'Dokumen PDF Baru'"></span>
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
                        💡 <strong>Smart Chunking Aktif</strong>: Berkas PDF besar (hingga 50MB) otomatis diunggah langsung ke Cloudflare R2 secara bertahap tanpa batas serverless Vercel.
                    </p>
                    @error('design_pdf_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                    @error('design_pdf_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Cover Image Preview & Replacement -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ imgSource: 'file' }">
                <!-- Info note for Design category -->
                <div x-show="category === 'Design'" class="p-3.5 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-start gap-3 text-xs text-blue-200">
                    <svg class="w-5 h-5 text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <div>
                        <strong class="font-semibold text-white block mb-0.5">Cover Otomatis Dokumen PDF (Seperti Sertifikat)</strong>
                        <span>Untuk kategori <strong>Design</strong> dengan dokumen PDF, cover otomatis menggunakan tampilan dokumen PDF interaktif ala sertifikat. Mengganti gambar cover di bawah bersifat opsional.</span>
                    </div>
                </div>
                
                <!-- Current Thumbnail / PDF Preview -->
                <div class="flex items-center gap-4 bg-white/[0.01] p-4 rounded-xl border border-white/5">
                    @if($project->has_pdf_cover || Str::endsWith(strtolower($project->cover_image), '.pdf') || ($project->category === 'Design' && $project->design_file && in_array($project->cover_image, ['image.png', 'porto.png', 'pdf-default', 'pdf'])))
                    <div class="w-24 h-16 rounded-lg overflow-hidden bg-red-500/10 border border-red-500/20 flex flex-col items-center justify-center text-red-400 flex-shrink-0">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                        <span class="text-[9px] font-black uppercase tracking-wider mt-1">DOKUMEN PDF</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="text-xs font-bold uppercase text-gray-400 tracking-wider">Cover Aktif:</h4>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Default PDF (Seperti Sertifikat)</span>
                        </div>
                        <p class="text-xs text-gray-300 mt-1">Cover project otomatis menampilkan lembar presentasi dokumen PDF interaktif.</p>
                    </div>
                    @else
                    <div class="w-24 h-16 rounded-lg overflow-hidden bg-white/5 border border-white/10 flex-shrink-0 relative">
                        <img src="{{ Str::startsWith($project->cover_image, 'http') || Str::startsWith($project->cover_image, 'data:') ? $project->cover_image : asset('img/' . $project->cover_image) }}" 
                             alt="Current cover" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow">
                        <h4 class="text-xs font-bold uppercase text-gray-500 tracking-wider">Cover Image Saat Ini</h4>
                        <p class="text-xs text-gray-300 mt-1 truncate max-w-[200px] md:max-w-md">{{ Str::startsWith($project->cover_image, 'data:') ? 'Base64 Encoded Image Data' : $project->cover_image }}</p>
                        @if($project->category === 'Design' && $project->design_file)
                        <div class="mt-2">
                            <label class="inline-flex items-center gap-2 text-xs text-blue-400 hover:text-blue-300 cursor-pointer">
                                <input type="checkbox" name="use_default_pdf_cover" value="1" class="rounded border-white/20 bg-black/40 text-blue-600 focus:ring-0">
                                <span>Ganti ke Cover Default PDF (seperti sertifikat)</span>
                            </label>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="flex justify-between items-center mt-4">
                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">
                        Ganti Gambar Cover <span x-show="category === 'Design'" class="text-gray-500 font-normal lowercase">(opsional jika ada PDF)</span>
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
