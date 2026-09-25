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

            @php
                $svgMap = [
                    'box_1' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
                    'box_2' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>',
                    'box_3' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
                    'box_4' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>',
                ];
                $defaultSvg = $svgMap[$box->key] ?? '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                $isSvg = str_contains($box->icon ?? '', '<svg');
                $isUrl = Str::startsWith($box->icon ?? '', 'http');
                $isBase64 = Str::startsWith($box->icon ?? '', 'data:');
                $initialType = 'svg_file';
                if ($isSvg) {
                    $initialType = 'svg_file';
                } elseif ($isUrl) {
                    $initialType = 'url';
                } elseif ($isBase64) {
                    $initialType = 'file';
                } elseif (empty($box->icon)) {
                    $initialType = 'default';
                }
            @endphp

            <!-- Icon Customization (File, SVG File, Raw SVG, URL, Default) with Live Preview -->
            <div class="space-y-5 p-6 bg-black/30 rounded-2xl border border-white/5" 
                 x-data="{ 
                     uploadType: '{{ $initialType }}',
                     svgContent: @js($isSvg ? $box->icon : ''),
                     defaultSvg: @js($defaultSvg),
                     imgUrl: @js($isUrl ? $box->icon : ''),
                     imgPreview: @js(($isBase64 || $isUrl) ? $box->icon : ''),
                     svgFileName: '',
                     handleSvgFile(e) {
                         const file = e.target.files[0];
                         if (file) {
                             this.svgFileName = file.name;
                             const reader = new FileReader();
                             reader.onload = (event) => {
                                 let text = event.target.result;
                                 const idx = text.indexOf('<svg');
                                 if (idx !== -1) {
                                     text = text.substring(idx);
                                 }
                                 this.svgContent = text;
                             };
                             reader.readAsText(file);
                         }
                     },
                     handleImageFile(e) {
                         const file = e.target.files[0];
                         if (file) {
                             const reader = new FileReader();
                             reader.onload = (event) => {
                                 this.imgPreview = event.target.result;
                             };
                             reader.readAsDataURL(file);
                         }
                     }
                 }">
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-white/5 pb-4">
                    <div class="space-y-2">
                        <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Pilihan Format Ikon</span>
                        <div class="flex flex-wrap gap-2.5">
                            <label class="inline-flex items-center px-3 py-1.5 rounded-lg border cursor-pointer text-xs font-medium transition-all"
                                   :class="uploadType === 'svg_file' ? 'bg-blue-600/20 border-blue-500/50 text-blue-300' : 'bg-white/[0.02] border-white/10 text-gray-400 hover:text-white'">
                                <input type="radio" name="upload_type" value="svg_file" x-model="uploadType" class="hidden">
                                <span>📁 Unggah SVG (.svg)</span>
                                <span class="ml-1.5 text-[9px] bg-blue-500/30 text-blue-300 px-1.5 py-0.5 rounded font-mono">Disarankan</span>
                            </label>

                            <label class="inline-flex items-center px-3 py-1.5 rounded-lg border cursor-pointer text-xs font-medium transition-all"
                                   :class="uploadType === 'svg' ? 'bg-blue-600/20 border-blue-500/50 text-blue-300' : 'bg-white/[0.02] border-white/10 text-gray-400 hover:text-white'">
                                <input type="radio" name="upload_type" value="svg" x-model="uploadType" class="hidden">
                                <span>&lt;/&gt; Paste Kode SVG</span>
                            </label>

                            <label class="inline-flex items-center px-3 py-1.5 rounded-lg border cursor-pointer text-xs font-medium transition-all"
                                   :class="uploadType === 'file' ? 'bg-blue-600/20 border-blue-500/50 text-blue-300' : 'bg-white/[0.02] border-white/10 text-gray-400 hover:text-white'">
                                <input type="radio" name="upload_type" value="file" x-model="uploadType" class="hidden">
                                <span>🖼️ Upload PNG / JPG</span>
                            </label>

                            <label class="inline-flex items-center px-3 py-1.5 rounded-lg border cursor-pointer text-xs font-medium transition-all"
                                   :class="uploadType === 'url' ? 'bg-blue-600/20 border-blue-500/50 text-blue-300' : 'bg-white/[0.02] border-white/10 text-gray-400 hover:text-white'">
                                <input type="radio" name="upload_type" value="url" x-model="uploadType" class="hidden">
                                <span>🔗 Link URL</span>
                            </label>

                            <label class="inline-flex items-center px-3 py-1.5 rounded-lg border cursor-pointer text-xs font-medium transition-all"
                                   :class="uploadType === 'default' ? 'bg-blue-600/20 border-blue-500/50 text-blue-300' : 'bg-white/[0.02] border-white/10 text-gray-400 hover:text-white'">
                                <input type="radio" name="upload_type" value="default" x-model="uploadType" class="hidden">
                                <span>🔄 Ikon Bawaan</span>
                            </label>
                        </div>
                    </div>

                    <!-- Live Preview Box -->
                    <div class="flex items-center gap-3 shrink-0 bg-white/[0.02] p-3 rounded-xl border border-white/10">
                        <div class="text-right">
                            <span class="text-xs font-bold text-gray-200 block">Pratinjau Ikon</span>
                            <span class="text-[10px] text-gray-500">Live preview</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[#1a1a1a] border border-gray-800 flex items-center justify-center text-blue-500 shadow-inner overflow-hidden">
                            <template x-if="uploadType === 'svg_file' || uploadType === 'svg'">
                                <div class="w-full h-full flex items-center justify-center [&>svg]:w-6 [&>svg]:h-6 [&>svg]:max-w-6 [&>svg]:max-h-6 text-blue-500" 
                                     x-html="svgContent ? svgContent : defaultSvg"></div>
                            </template>
                            <template x-if="uploadType === 'file'">
                                <div class="w-full h-full flex items-center justify-center">
                                    <template x-if="imgPreview">
                                        <img :src="imgPreview" class="w-6 h-6 object-contain">
                                    </template>
                                    <template x-if="!imgPreview">
                                        <div class="w-full h-full flex items-center justify-center [&>svg]:w-6 [&>svg]:h-6 text-blue-500" x-html="defaultSvg"></div>
                                    </template>
                                </div>
                            </template>
                            <template x-if="uploadType === 'url'">
                                <div class="w-full h-full flex items-center justify-center">
                                    <template x-if="imgUrl">
                                        <img :src="imgUrl" class="w-6 h-6 object-contain">
                                    </template>
                                    <template x-if="!imgUrl">
                                        <div class="w-full h-full flex items-center justify-center [&>svg]:w-6 [&>svg]:h-6 text-blue-500" x-html="defaultSvg"></div>
                                    </template>
                                </div>
                            </template>
                            <template x-if="uploadType === 'default'">
                                <div class="w-full h-full flex items-center justify-center [&>svg]:w-6 [&>svg]:h-6 text-blue-500" x-html="defaultSvg"></div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Input Type 1: SVG File Upload -->
                <div x-show="uploadType === 'svg_file'" class="space-y-3">
                    <label for="icon_svg_file" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Unggah Berkas SVG (.svg)</label>
                    <div class="relative border-2 border-dashed border-white/10 hover:border-blue-500/50 rounded-2xl p-6 text-center cursor-pointer transition-all bg-white/[0.01] hover:bg-white/[0.03] group">
                        <input type="file" name="icon_svg_file" id="icon_svg_file" accept=".svg,image/svg+xml"
                               @change="handleSvgFile"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="space-y-2 pointer-events-none">
                            <div class="w-12 h-12 mx-auto rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-200" x-text="svgFileName ? 'Berkas dipilih: ' + svgFileName : 'Pilih atau Tarik Berkas .svg Anda ke Sini'"></p>
                            <p class="text-xs text-gray-500">Mendukung berkas format .svg (export dari Figma, Illustrator, Heroicons). Ringan, tajam tanpa batas resolusi, dan langsung tersimpan aman.</p>
                        </div>
                    </div>
                    @error('icon_svg_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Type 2: Raw SVG Code -->
                <div x-show="uploadType === 'svg'" class="space-y-2" style="display: none;">
                    <label for="icon_svg" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Kode SVG Ikon (Tag HTML)</label>
                    <textarea name="icon_svg" id="icon_svg" rows="4" placeholder="Contoh: <svg class='w-6 h-6 text-blue-500' fill='none' viewBox='0 0 24 24'>...</svg>"
                              x-model="svgContent"
                              class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-xs font-mono text-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">@if(str_contains($box->icon ?? '', '<svg')){{ $box->icon }}@endif</textarea>
                    <p class="text-[10px] text-gray-500">💡 Tempel kode &lt;svg&gt; lengkap di sini. Sistem akan otomatis membersihkan tag yang tidak aman dan menerapkan class warna tema.</p>
                    @error('icon_svg')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Type 3: Raster Image Upload -->
                <div x-show="uploadType === 'file'" class="space-y-2" style="display: none;">
                    <label for="icon_file" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Unggah Gambar (PNG / JPG / WEBP / SVG)</label>
                    <input type="file" name="icon_file" id="icon_file" accept="image/*"
                           @change="handleImageFile"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Maksimal 2MB. Gambar raster akan dioptimasi otomatis secara inline.<br><span class="text-amber-500/80">⚠️ File raster PNG/JPG tidak dapat berubah warna otomatis via CSS. Pastikan sudah memiliki warna biru (#3b82f6) atau putih.</span></p>
                    @error('icon_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Type 4: Image URL -->
                <div x-show="uploadType === 'url'" class="space-y-2" style="display: none;">
                    <label for="icon_url" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Link URL Gambar Ikon</label>
                    <input type="url" name="icon_url" id="icon_url" placeholder="Contoh: https://example.com/icon.svg" 
                           x-model="imgUrl"
                           value="@if(Str::startsWith($box->icon ?? '', 'http')){{ $box->icon }}@endif"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Masukkan tautan langsung gambar ikon dari internet.</p>
                    @error('icon_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Type 5: Reset to Default -->
                <div x-show="uploadType === 'default'" class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl text-xs text-blue-300 flex items-center gap-3" style="display: none;">
                    <svg class="w-5 h-5 shrink-0 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Kartu ini akan dikembalikan ke ikon vektor bawaan tema portofolio secara otomatis saat Anda menekan tombol Simpan Perubahan.</span>
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
