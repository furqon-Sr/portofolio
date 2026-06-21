@extends('layouts.admin')

@section('title', 'Tambah Sertifikat Baru')
@section('page-title', 'Tambah Sertifikat')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
    
    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.certificates.index') }}" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-white/20 transition-all text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Buat Sertifikat Baru</h3>
            <p class="text-xs text-gray-500 mt-0.5">Isi detail kredensial sertifikat Anda.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.certificates.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Form Grid 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Certificate Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Nama Sertifikat</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="Contoh: AWS Certified Cloud Practitioner">
                    @error('name')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Issuer -->
                <div class="space-y-2">
                    <label for="issuer" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Organisasi Penerbit</label>
                    <input type="text" name="issuer" id="issuer" required value="{{ old('issuer') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="Contoh: Amazon Web Services (AWS)">
                    @error('issuer')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Grid 2 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Issued At -->
                <div class="space-y-2">
                    <label for="issued_at" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Tanggal Terbit</label>
                    <input type="text" name="issued_at" id="issued_at" required value="{{ old('issued_at') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="Contoh: Juni 2026">
                    @error('issued_at')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Credential ID (Optional) -->
                <div class="space-y-2 md:col-span-2">
                    <label for="credential_id" class="block text-xs font-bold uppercase tracking-wider text-gray-400">ID Kredensial (Opsional)</label>
                    <input type="text" name="credential_id" id="credential_id" value="{{ old('credential_id') }}" 
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="Contoh: AWS-CCP-12345">
                    @error('credential_id')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Credential URL (Optional) -->
            <div class="space-y-2">
                <label for="credential_url" class="block text-xs font-bold uppercase tracking-wider text-gray-400">Tautan Verifikasi Kredensial (Opsional)</label>
                <input type="url" name="credential_url" id="credential_url" value="{{ old('credential_url') }}" 
                       class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                       placeholder="https://aws.amazon.com/verify/12345">
                <p class="text-[10px] text-gray-500">Tautan langsung ke situs penerbit untuk memverifikasi keabsahan sertifikat Anda.</p>
                @error('credential_url')
                    <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Certificate Image (Base64 or URL) -->
            <div class="space-y-4 border-t border-white/5 pt-6" x-data="{ imgSource: 'file' }">
                <div class="flex justify-between items-center">
                    <span class="block text-xs font-bold uppercase tracking-wider text-gray-400">Gambar / Foto Sertifikat</span>
                    <!-- Tab Toggle -->
                    <div class="flex p-0.5 bg-black/40 rounded-lg border border-white/5">
                        <button type="button" @click="imgSource = 'file'" :class="imgSource === 'file' ? 'bg-blue-600 text-white' : 'text-gray-400'" class="px-3 py-1 text-[10px] font-bold rounded-md transition-all">Upload File</button>
                        <button type="button" @click="imgSource = 'url'" :class="imgSource === 'url' ? 'bg-blue-600 text-white' : 'text-gray-400'" class="px-3 py-1 text-[10px] font-bold rounded-md transition-all">Paste URL</button>
                    </div>
                </div>

                <!-- File Input -->
                <div x-show="imgSource === 'file'" class="space-y-2">
                    <input type="file" name="image_file" id="image_file" accept="image/*"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-gray-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500 transition-all">
                    <p class="text-[10px] text-gray-500">Ukuran maksimal file 2MB. Gambar akan otomatis diubah menjadi Base64 agar dapat tersimpan permanen di serverless Vercel.</p>
                    @error('image_file')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL Input -->
                <div x-show="imgSource === 'url'" class="space-y-2" style="display: none;">
                    <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}"
                           class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                           placeholder="https://images.unsplash.com/... atau https://imgur.com/...">
                    <p class="text-[10px] text-gray-500">Tempel alamat URL gambar eksternal yang sudah online.</p>
                    @error('image_url')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 border-t border-white/5 pt-6">
                <a href="{{ route('admin.certificates.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 text-sm font-semibold text-gray-400 hover:text-white transition-all">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-sm text-white transition-all shadow-lg shadow-blue-500/20">Simpan Sertifikat</button>
            </div>
        </form>
    </div>

</div>
@endsection
