@extends('layouts.admin')

@section('title', 'Manage Portfolio')
@section('page-title', 'Manage Portfolio')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Action Header -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Daftar Karya / Portfolio</h3>
            <p class="text-xs text-gray-500 mt-0.5">Kelola karya visual dan website yang tampil di halaman utama.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white flex items-center gap-2 transition-all shadow-lg shadow-blue-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Portfolio
        </a>
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
                        <!-- Image -->
                        <td class="p-5 whitespace-nowrap">
                            <div class="w-16 h-10 rounded-lg overflow-hidden bg-white/5 border border-white/10 relative">
                                <img src="{{ Str::startsWith($proj->cover_image, 'http') || Str::startsWith($proj->cover_image, 'data:') ? $proj->cover_image : asset('img/' . $proj->cover_image) }}" 
                                     alt="{{ $proj->title }}" class="w-full h-full object-cover">
                            </div>
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
