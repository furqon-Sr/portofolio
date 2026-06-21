@extends('layouts.admin')

@section('title', 'Manage Certificates')
@section('page-title', 'Manage Certificates')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <!-- Action Header -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Daftar Sertifikat</h3>
            <p class="text-xs text-gray-500 mt-0.5">Kelola sertifikat dan lisensi kompetensi Anda.</p>
        </div>
        <a href="{{ route('admin.certificates.create') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white flex items-center gap-2 transition-all shadow-lg shadow-blue-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Sertifikat
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 border-b border-white/5 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="p-5 font-semibold">Gambar</th>
                        <th class="p-5 font-semibold">Nama Sertifikat</th>
                        <th class="p-5 font-semibold">Penerbit</th>
                        <th class="p-5 font-semibold">Tautan Verifikasi</th>
                        <th class="p-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($certificates as $cert)
                    <tr class="hover:bg-white/[0.01] transition-colors group">
                        <!-- Image -->
                        <td class="p-5 whitespace-nowrap">
                            <div class="w-16 h-10 rounded-lg overflow-hidden bg-white/5 border border-white/10 relative">
                                <img src="{{ Str::startsWith($cert->image, 'http') || Str::startsWith($cert->image, 'data:') ? $cert->image : asset('img/' . $cert->image) }}" 
                                     alt="{{ $cert->name }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <!-- Name & Date -->
                        <td class="p-5">
                            <h4 class="text-sm font-semibold text-gray-100 group-hover:text-blue-500 transition-colors leading-tight">{{ $cert->name }}</h4>
                            <p class="text-[10px] text-gray-500 mt-1 uppercase font-bold tracking-wider">Tanggal Terbit: {{ $cert->issued_at }}</p>
                        </td>
                        <!-- Issuer & Credential ID -->
                        <td class="p-5 whitespace-nowrap">
                            <span class="text-xs text-gray-300 font-semibold">{{ $cert->issuer }}</span>
                            @if($cert->credential_id)
                            <p class="text-[10px] text-gray-500 mt-0.5">ID: {{ $cert->credential_id }}</p>
                            @endif
                        </td>
                        <!-- Verification Link -->
                        <td class="p-5 whitespace-nowrap text-xs">
                            @if($cert->credential_url)
                            <div class="flex items-center gap-1.5 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                <a href="{{ $cert->credential_url }}" target="_blank" class="hover:text-white hover:underline truncate max-w-[150px] inline-block">Verifikasi Kredensial</a>
                            </div>
                            @else
                            <span class="text-gray-600">-</span>
                            @endif
                        </td>
                        <!-- Actions -->
                        <td class="p-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.certificates.edit', $cert->id) }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-blue-500 hover:text-blue-400 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.certificates.delete', $cert->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">
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
                            Belum ada data sertifikat di database. Klik tombol "Tambah Sertifikat" untuk menambahkannya.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
