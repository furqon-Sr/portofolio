@extends('layouts.admin')

@section('title', 'Inbox Messages')
@section('page-title', 'Inbox Messages')

@section('content')
<div class="space-y-6 animate-fade-in">

    <!-- Header Stats -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold text-white tracking-tight">Inbox Leads / Pesan Masuk</h3>
            <p class="text-xs text-gray-500 mt-0.5">Daftar semua pesan prospek yang dikirim melalui formulir kontak.</p>
        </div>
        <div class="text-xs text-gray-400 bg-white/5 border border-white/5 px-4 py-2 rounded-xl">
            Total Pesan: <span class="text-blue-500 font-bold ml-1">{{ $messages->count() }}</span>
        </div>
    </div>

    <!-- Messages Table Card -->
    <div class="bg-[#111111] rounded-2xl border border-white/5 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 border-b border-white/5 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="p-5 font-semibold">Tanggal Masuk</th>
                        <th class="p-5 font-semibold">Pengirim</th>
                        <th class="p-5 font-semibold">Email</th>
                        <th class="p-5 font-semibold">Isi Pesan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-white/[0.01] transition-colors group">
                        <!-- Date -->
                        <td class="p-5 text-xs text-gray-500 whitespace-nowrap">
                            {{ $msg->created_at->format('d M Y • H:i') }}
                        </td>
                        <!-- Sender -->
                        <td class="p-5 text-sm font-semibold text-gray-200 whitespace-nowrap">
                            {{ $msg->name }}
                        </td>
                        <!-- Email -->
                        <td class="p-5 text-sm whitespace-nowrap">
                            <a href="mailto:{{ $msg->email }}" class="text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1.5 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                {{ $msg->email }}
                            </a>
                        </td>
                        <!-- Message -->
                        <td class="p-5 text-xs text-gray-400 max-w-md">
                            <p class="truncate group-hover:whitespace-normal group-hover:text-gray-300 transition-all leading-relaxed bg-white/[0.01] p-3 rounded-lg border border-white/5">
                                {{ $msg->message }}
                            </p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-500">
                            Belum ada pesan masuk di database.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection