@extends('layouts.admin')

@section('title', 'Manage About Me')
@section('page-title', 'Manage About Me')

@section('content')
<div class="space-y-10 animate-fade-in">
    
    <!-- SECTION 1: ABOUT ME TEXT -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-white tracking-tight">About Me Description</h3>
            <p class="text-xs text-gray-500 mt-0.5">Ubah teks paragraf deskripsi singkat tentang diri Anda yang tampil di halaman utama.</p>
        </div>

        <form action="{{ route('admin.about.text.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="about_text" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Bio</label>
                <textarea name="about_text" id="about_text" rows="4" 
                          class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm text-gray-200 placeholder-gray-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                          required>{{ old('about_text', $aboutSetting->about_text ?? '') }}</textarea>
                @error('about_text')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white transition-all shadow-lg shadow-blue-500/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION 2: 4 GRID BOXES (TEXT ONLY) -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 overflow-hidden shadow-xl">
        <div class="p-6 md:p-8 border-b border-white/5">
            <h3 class="text-lg font-bold text-white tracking-tight">4 Grid Highlights (Edit Teks Saja)</h3>
            <p class="text-xs text-gray-500 mt-0.5">Kelola teks judul dan sub-deskripsi untuk 4 kartu grid highlight. Bentuk layout dan ikon SVG tetap dipertahankan sesuai desain asli.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 border-b border-white/5 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="p-5 font-semibold">Ikon Pratinjau</th>
                        <th class="p-5 font-semibold">Judul Kartu</th>
                        <th class="p-5 font-semibold">Deskripsi / Subtitle</th>
                        <th class="p-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @php
                        $svgMap = [
                            'box_1' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
                            'box_2' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>',
                            'box_3' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
                            'box_4' => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>',
                        ];
                    @endphp
                    @foreach($aboutBoxes as $box)
                    <tr class="hover:bg-white/[0.01] transition-colors group">
                        <td class="p-5 whitespace-nowrap">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center border border-blue-500/20">
                                {!! $svgMap[$box->key] ?? '' !!}
                            </div>
                        </td>
                        <td class="p-5 font-semibold text-gray-200">
                            {{ $box->title }}
                        </td>
                        <td class="p-5 text-gray-400 text-sm">
                            {{ $box->description }}
                        </td>
                        <td class="p-5 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.about.box.edit', $box->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/5 border border-white/5 hover:border-blue-500 hover:text-blue-400 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                Edit Teks
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- SECTION 3: EXPERTISE LOGOS -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 overflow-hidden shadow-xl">
        <div class="p-6 md:p-8 border-b border-white/5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="text-lg font-bold text-white tracking-tight">Expertise / Tech Logos</h3>
                <p class="text-xs text-gray-500 mt-0.5">Kelola logo teknologi/keahlian yang tersusun di sebelah kanan bagian About Me.</p>
            </div>
            <a href="{{ route('admin.about.expertise.create') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white flex items-center gap-2 transition-all shadow-lg shadow-blue-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Keahlian
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 border-b border-white/5 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="p-5 font-semibold">Logo</th>
                        <th class="p-5 font-semibold">Nama Teknologi</th>
                        <th class="p-5 font-semibold">Tautan Web</th>
                        <th class="p-5 font-semibold">Tema Desain (Classes)</th>
                        <th class="p-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($expertises as $exp)
                    <tr class="hover:bg-white/[0.01] transition-colors group">
                        <!-- Logo Image -->
                        <td class="p-5 whitespace-nowrap">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center border border-white/10 {{ $exp->bg_class }} overflow-hidden">
                                <img src="{{ Str::startsWith($exp->logo, 'http') || Str::startsWith($exp->logo, 'data:') ? $exp->logo : asset('img/logos/' . $exp->logo) }}" 
                                     alt="{{ $exp->name }}" class="w-8 h-8 object-contain">
                            </div>
                        </td>
                        <!-- Name -->
                        <td class="p-5 font-semibold text-gray-200">
                            {{ $exp->name }}
                        </td>
                        <!-- Web Link -->
                        <td class="p-5 text-sm">
                            @if($exp->url)
                                <a href="{{ $exp->url }}" target="_blank" class="text-blue-400 hover:underline flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                    {{ Str::limit($exp->url, 25) }}
                                </a>
                            @else
                                <span class="text-gray-600">-</span>
                            @endif
                        </td>
                        <!-- Styling classes -->
                        <td class="p-5 text-xs font-mono text-gray-500">
                            <span class="block">Background: {{ $exp->bg_class }}</span>
                            <span class="block mt-0.5">Border Hover: {{ $exp->hover_class }}</span>
                        </td>
                        <!-- Actions -->
                        <td class="p-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.about.expertise.edit', $exp->id) }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-blue-500 hover:text-blue-400 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.about.expertise.delete', $exp->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus logo keahlian ini?')">
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
                            Belum ada logo teknologi di database. Klik tombol "Tambah Keahlian" untuk menambahkannya.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
