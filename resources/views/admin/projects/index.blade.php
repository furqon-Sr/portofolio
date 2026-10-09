@extends('layouts.admin')

@section('title', 'Manage Portfolio')
@section('page-title', 'Manage Portfolio')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Action Header -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Daftar Karya / Portfolio</h3>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white flex items-center gap-2 transition-all shadow-lg shadow-blue-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Portfolio
        </a>
    </div>

    <!-- Graphic Design Portfolio PDF Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl"
         x-data="{
             dragging: false,
             selectedFileName: '',
             selectedFileSize: '',
             showReplaceForm: false,
             handleFileSelect(e) {
                 const file = e.target.files[0] || (e.dataTransfer ? e.dataTransfer.files[0] : null);
                 if (file) {
                     if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                         alert('Hanya file berformat PDF yang diizinkan!');
                         e.target.value = '';
                         this.selectedFileName = '';
                         this.selectedFileSize = '';
                         return;
                     }
                     if (file.size > 30 * 1024 * 1024) {
                         alert('Ukuran file melebihi batas maksimal 30 MB!');
                         e.target.value = '';
                         this.selectedFileName = '';
                         this.selectedFileSize = '';
                         return;
                     }
                     this.selectedFileName = file.name;
                     const sz = file.size;
                     this.selectedFileSize = sz >= 1048576 ? (sz / 1048576).toFixed(1) + ' MB' : Math.round(sz / 1024) + ' KB';
                 }
             }
         }">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-white/5 mb-6">
            <div class="space-y-1">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-white tracking-tight">Dokumen PDF Portfolio (Graphic Design)</h3>
                </div>
                <p class="text-xs text-gray-400 max-w-2xl leading-relaxed">
                    Unggah kompilasi karya desain grafis dalam satu berkas PDF resmi. File ini akan terhubung langsung secara dinamis ke tombol unduh di halaman <strong>Works (filter Design)</strong>.
                </p>
            </div>
            
            @if($aboutSetting && $aboutSetting->has_design_portfolio_pdf)
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Aktif Terpasang
                </span>
            </div>
            @endif
        </div>

        @if($aboutSetting && $aboutSetting->has_design_portfolio_pdf)
            <!-- Active File Status Box -->
            <div x-show="!showReplaceForm" class="space-y-6">
                <div class="p-5 bg-black/40 border border-white/10 rounded-xl flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 flex-shrink-0 shadow-lg shadow-red-500/5">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                        </div>
                        <div class="min-w-0 space-y-1">
                            <div class="text-sm font-bold text-white truncate max-w-md" title="{{ $aboutSetting->design_portfolio_pdf_name ?? 'Portfolio_Graphic_Design.pdf' }}">
                                {{ $aboutSetting->design_portfolio_pdf_name ?? 'Portfolio_Graphic_Design_Hanafi.pdf' }}
                            </div>
                            <div class="flex items-center gap-3 text-xs text-gray-400 font-mono">
                                <span class="bg-white/5 px-2 py-0.5 rounded text-[11px] text-gray-300">Format: PDF</span>
                                @if($aboutSetting->design_portfolio_pdf_size_formatted)
                                <span class="bg-white/5 px-2 py-0.5 rounded text-[11px] text-blue-400 font-semibold">{{ $aboutSetting->design_portfolio_pdf_size_formatted }}</span>
                                @endif
                                <span class="text-gray-500">Diperbarui: {{ $aboutSetting->updated_at?->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2.5 flex-wrap sm:flex-nowrap">
                        <a href="{{ route('portfolio.design.download') }}" target="_blank" 
                           class="px-4 py-2 bg-blue-600/20 hover:bg-blue-600 text-blue-400 hover:text-white border border-blue-500/30 rounded-xl text-xs font-bold transition-all flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Lihat PDF</span>
                        </a>

                        <button type="button" @click="showReplaceForm = true"
                                class="px-4 py-2 bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/10 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            <span>Ganti File</span>
                        </button>

                        <form action="{{ route('admin.portfolio.design-pdf.delete') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file PDF Portfolio ini? Tombol download di frontend akan disembunyikan secara otomatis.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-red-300 border border-red-500/20 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- Upload / Replace Form -->
        <div x-show="{{ ($aboutSetting && $aboutSetting->has_design_portfolio_pdf) ? 'showReplaceForm' : 'true' }}" style="{{ ($aboutSetting && $aboutSetting->has_design_portfolio_pdf) ? 'display: none;' : '' }}">
            <form action="{{ route('admin.portfolio.design-pdf.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Drag and Drop Box -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Unggah File PDF Portofolio</label>
                        <div @dragover.prevent="dragging = true"
                             @dragleave.prevent="dragging = false"
                             @drop.prevent="dragging = false; $refs.fileInput.files = $event.dataTransfer.files; handleFileSelect($event)"
                             :class="dragging ? 'border-blue-500 bg-blue-500/5' : 'border-white/10 hover:border-white/20 bg-black/30'"
                             class="relative border-2 border-dashed rounded-2xl p-6 text-center cursor-pointer transition-all">
                            <input type="file" name="design_pdf_file" id="design_pdf_file" accept=".pdf,application/pdf" x-ref="fileInput"
                                   @change="handleFileSelect($event)"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="flex flex-col items-center justify-center space-y-3 pointer-events-none">
                                <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-semibold text-gray-200">
                                        <span class="text-blue-400 underline">Pilih file PDF</span> atau tarik & lepas ke sini
                                    </p>
                                    <p class="text-[11px] text-gray-500 font-mono">Format PDF (.pdf) &bull; Maksimal 30 MB</p>
                                </div>
                                <div x-show="selectedFileName" class="mt-2 px-3 py-1.5 rounded-lg bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-mono inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                                    <span x-text="selectedFileName" class="font-bold truncate max-w-[200px]"></span>
                                    <span x-text="'(' + selectedFileSize + ')'" class="text-gray-400 font-normal"></span>
                                </div>
                            </div>
                        </div>
                        @error('design_pdf_file')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alternate URL Input -->
                    <div class="flex flex-col justify-between">
                        <div>
                            <label for="design_pdf_url" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Atau Tautan URL Eksternal (Cloud / Drive)</label>
                            <input type="url" name="design_pdf_url" id="design_pdf_url" 
                                   placeholder="https://drive.google.com/... atau URL berkas PDF"
                                   value="{{ old('design_pdf_url') }}"
                                   class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm text-gray-200 placeholder-gray-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                            <p class="text-[11px] text-gray-500 mt-2 leading-relaxed">
                                Opsi alternatif jika file PDF tersimpan di Cloudflare R2, Google Drive, Dropbox, atau server publik lainnya.
                            </p>
                            @error('design_pdf_url')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-white/5 mt-4">
                            @if($aboutSetting && $aboutSetting->has_design_portfolio_pdf)
                            <button type="button" @click="showReplaceForm = false; selectedFileName = ''"
                                    class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white text-xs font-semibold transition-all">
                                Batal
                            </button>
                            @endif

                            <button type="submit" 
                                    class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-lg shadow-blue-500/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span>Simpan & Pasang PDF</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 border-b border-white/5 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="p-5 font-semibold">Cover</th>
                        <th class="p-5 font-semibold">Judul Project</th>
                        <th class="p-5 font-semibold">Kategori</th>
                        <th class="p-5 font-semibold">Link Tautan</th>
                        <th class="p-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($projects as $proj)
                    <tr class="hover:bg-white/[0.01] transition-colors group">
                        <!-- Image / PDF Preview -->
                        <td class="p-5 whitespace-nowrap">
                            @if($proj->has_pdf_cover || Str::endsWith(strtolower($proj->cover_image_url), '.pdf') || ($proj->category === 'Design' && $proj->design_pdf_url && in_array($proj->cover_image, ['image.png', 'porto.png', 'pdf-default', 'pdf', ''])))
                            <a href="{{ $proj->design_pdf_url }}" target="_blank" class="w-16 h-10 rounded-lg overflow-hidden bg-red-500/10 border border-red-500/20 flex flex-col items-center justify-center text-red-400 hover:bg-red-500/20 transition-all group/pdf" title="Lihat Dokumen PDF Desain">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                                <span class="text-[8px] font-black uppercase tracking-wider mt-0.5">PDF</span>
                            </a>
                            @else
                            <div class="w-16 h-10 rounded-lg overflow-hidden bg-white/5 border border-white/10 relative">
                                <img src="{{ $proj->cover_image_url }}" 
                                     alt="{{ $proj->title }}" class="w-full h-full object-cover">
                            </div>
                            @endif
                        </td>
                        <!-- Title -->
                        <td class="p-5">
                            <h4 class="text-sm font-semibold text-gray-100 group-hover:text-blue-500 transition-colors leading-tight">{{ $proj->title }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-1 mt-1 max-w-sm">{{ $proj->description }}</p>
                        </td>
                        <!-- Category -->
                        <td class="p-5 whitespace-nowrap">
                            <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $proj->category === 'Web Dev' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : 'bg-purple-500/10 text-purple-400 border border-purple-500/20' }}">
                                {{ $proj->category }}
                            </span>
                        </td>
                        <!-- Links -->
                        <td class="p-5 space-y-1 text-xs">
                            <div class="flex items-center gap-1.5 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                <a href="{{ $proj->live_link }}" target="_blank" class="hover:text-white hover:underline truncate max-w-[150px] inline-block">{{ $proj->live_link }}</a>
                            </div>
                            @if($proj->category === 'Web Dev' && $proj->github_link)
                            <div class="flex items-center gap-1.5 text-gray-500">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" /></svg>
                                <a href="{{ $proj->github_link }}" target="_blank" class="hover:text-white hover:underline truncate max-w-[150px] inline-block">{{ $proj->github_link }}</a>
                            </div>
                            @endif
                        </td>
                        <!-- Actions -->
                        <td class="p-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.projects.edit', $proj->id) }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-blue-500 hover:text-blue-400 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.projects.delete', $proj->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portfolio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-red-500 hover:text-red-400 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-gray-500">
                            Belum ada karya portfolio di database. Klik tombol "Tambah Portfolio" untuk menambahkannya.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
