@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru')
@section('page-title', 'Tambah Artikel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.articles.index') }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-white/20 transition-all text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Tulis Artikel Baru</h3>
            <p class="text-xs text-gray-500 mt-0.5">Bagikan pemikiran, tutorial, atau insight Anda.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div class="space-y-2">
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Judul Artikel</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}" 
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                       placeholder="Contoh: Mengapa React Tetap Populer di 2026?">
                @error('title')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Excerpt -->
            <div class="space-y-2">
                <label for="excerpt" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Cuplikan (Excerpt)</label>
                <textarea name="excerpt" id="excerpt" rows="2" 
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                       placeholder="Ringkasan singkat artikel untuk ditampilkan di halaman depan (opsional).">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content with Rich Markdown Toolbar & Live Preview -->
            <div class="space-y-2" x-data="{
                activeTab: 'edit',
                content: `{{ old('content', '') }}`,
                previewHtml: '',
                updatePreview() {
                    if (typeof marked !== 'undefined') {
                        this.previewHtml = marked.parse(this.content || '');
                    } else {
                        this.previewHtml = (this.content || '').replace(/\n/g, '<br>');
                    }
                },
                insertFormat(prefix, suffix, placeholder = 'teks') {
                    const textarea = this.$refs.contentInput;
                    const start = textarea.selectionStart;
                    const end = textarea.selectionEnd;
                    const text = textarea.value;
                    const selected = text.substring(start, end) || placeholder;
                    const replacement = prefix + selected + suffix;
                    
                    textarea.value = text.substring(0, start) + replacement + text.substring(end);
                    this.content = textarea.value;
                    textarea.focus();
                    textarea.setSelectionRange(start + prefix.length, start + prefix.length + selected.length);
                }
            }">
                <div class="flex items-center justify-between">
                    <label for="content" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Isi Artikel</label>
                    <!-- Editor Mode Tabs -->
                    <div class="flex p-0.5 bg-black/40 rounded-lg border border-white/5 text-xs">
                        <button type="button" @click="activeTab = 'edit'" :class="activeTab === 'edit' ? 'bg-blue-600 text-white shadow' : 'text-gray-400 hover:text-white'" class="px-3 py-1 font-semibold rounded-md transition-all flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Tulis (Editor)
                        </button>
                        <button type="button" @click="activeTab = 'preview'; updatePreview();" :class="activeTab === 'preview' ? 'bg-blue-600 text-white shadow' : 'text-gray-400 hover:text-white'" class="px-3 py-1 font-semibold rounded-md transition-all flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Pratinjau (Preview)
                        </button>
                    </div>
                </div>

                <!-- Toolbar Container -->
                <div x-show="activeTab === 'edit'" class="flex flex-wrap items-center gap-1 p-2 bg-black/40 border border-white/10 rounded-t-xl border-b-0">
                    <!-- Bold -->
                    <button type="button" @click="insertFormat('**', '**', 'teks tebal')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded font-bold text-xs" title="Tebal (Bold)">
                        <span class="w-4 h-4 flex items-center justify-center font-bold">B</span>
                    </button>
                    <!-- Italic -->
                    <button type="button" @click="insertFormat('*', '*', 'teks miring')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded italic text-xs" title="Miring (Italic)">
                        <span class="w-4 h-4 flex items-center justify-center italic font-serif">I</span>
                    </button>
                    <!-- Strikethrough -->
                    <button type="button" @click="insertFormat('~~', '~~', 'coret')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded text-xs" title="Coret (Strikethrough)">
                        <span class="w-4 h-4 flex items-center justify-center line-through">S</span>
                    </button>

                    <div class="h-4 w-px bg-white/10 mx-1"></div>

                    <!-- Heading 2 -->
                    <button type="button" @click="insertFormat('## ', '\n', 'Judul Bagian')" class="px-2 py-1 text-gray-300 hover:text-white hover:bg-white/10 rounded font-bold text-xs" title="Heading 2">
                        H2
                    </button>
                    <!-- Heading 3 -->
                    <button type="button" @click="insertFormat('### ', '\n', 'Sub-bagian')" class="px-2 py-1 text-gray-300 hover:text-white hover:bg-white/10 rounded font-semibold text-xs" title="Heading 3">
                        H3
                    </button>

                    <div class="h-4 w-px bg-white/10 mx-1"></div>

                    <!-- Quote -->
                    <button type="button" @click="insertFormat('> ', '\n', 'Kutipan inspiratif')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded text-xs" title="Kutipan (Quote)">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    </button>
                    <!-- Bullet List -->
                    <button type="button" @click="insertFormat('- ', '\n', 'Item daftar')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded text-xs" title="Daftar Poin (List)">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <!-- Numbered List -->
                    <button type="button" @click="insertFormat('1. ', '\n', 'Item urutan')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded text-xs font-mono font-bold" title="Daftar Angka (Numbered List)">
                        1.
                    </button>

                    <div class="h-4 w-px bg-white/10 mx-1"></div>

                    <!-- Link -->
                    <button type="button" @click="insertFormat('[', '](https://url-tujuan.com)', 'Judul Tautan')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded text-xs flex items-center gap-1" title="Sisipkan Link">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </button>
                    <!-- Image -->
                    <button type="button" @click="insertFormat('![', '](https://link-gambar.com/gambar.png)', 'Keterangan Gambar')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded text-xs flex items-center gap-1" title="Sisipkan Gambar Pendukung (Inline Media)">
                        <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </button>
                    <!-- Code Block -->
                    <button type="button" @click="insertFormat('```\n', '\n```', 'kode program')" class="p-1.5 text-gray-300 hover:text-white hover:bg-white/10 rounded text-xs font-mono" title="Blok Kode (Code Block)">
                        &lt;/&gt;
                    </button>
                </div>

                <!-- Textarea Editor -->
                <div x-show="activeTab === 'edit'">
                    <textarea name="content" id="content" x-ref="contentInput" x-model="content" rows="14" required
                           class="w-full bg-white/[0.02] border border-white/10 rounded-b-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all font-mono leading-relaxed"
                           placeholder="Tulis artikel dengan gaya Markdown. Gunakan tombol toolbar di atas untuk memformat teks (tebal, miring, list, gambar pendukung, dll).">{{ old('content') }}</textarea>
                </div>

                <!-- Live Preview -->
                <div x-show="activeTab === 'preview'" class="w-full min-h-[350px] bg-black/30 border border-white/10 rounded-xl p-6 overflow-y-auto" style="display: none;">
                    <div class="prose prose-invert max-w-none text-gray-300" x-html="previewHtml"></div>
                </div>

                <p class="text-[10px] text-gray-500">Mendukung format Markdown: **tebal**, *miring*, heading ##, tautan [link](url), dan gambar ![alt](url).</p>
                @error('content')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sumber / Jurnal Referensi -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ references: {{ old('references') ? json_encode(old('references')) : '[]' }} }">
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

            <!-- Cover Image (Base64 or URL) -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ imgSource: 'file' }">
                <div class="flex justify-between items-center">
                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Gambar Cover (Opsional)</span>
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
                    <p class="text-[10px] text-gray-500 mt-1">Otomatis dikompresi agar tidak melampaui batas payload Vercel.</p>
                    @error('cover_image_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL Input -->
                <div x-show="imgSource === 'url'" class="space-y-2" style="display: none;">
                    <input type="url" name="cover_image_url" id="cover_image_url" value="{{ old('cover_image_url') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://example.com/image.jpg">
                    <p class="text-[10px] text-gray-500 mt-1">Atau gunakan URL gambar langsung.</p>
                    @error('cover_image_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sumber Gambar / Attribution Link -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div class="space-y-1">
                        <label for="cover_image_source" class="block text-[11px] font-semibold text-gray-400">Label Sumber Gambar (Opsional)</label>
                        <input type="text" name="cover_image_source" id="cover_image_source" value="{{ old('cover_image_source') }}"
                               class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-gray-600"
                               placeholder="Contoh: Unsplash / SpaceX atau Dokumentasi">
                        @error('cover_image_source')
                            <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="cover_image_source_url" class="block text-[11px] font-semibold text-gray-400">Link Sumber Gambar / URL (Opsional)</label>
                        <input type="url" name="cover_image_source_url" id="cover_image_source_url" value="{{ old('cover_image_source_url') }}"
                               class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-gray-600"
                               placeholder="https://unsplash.com/photos/...">
                        @error('cover_image_source_url')
                            <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-white/5 flex justify-end">
                <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white transition-all shadow-lg shadow-blue-500/20">
                    Publish Artikel
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
@endsection
