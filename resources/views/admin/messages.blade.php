@extends('layouts.admin')

@section('title', 'Inbox Messages')
@section('page-title', 'Inbox Messages')

@section('content')
<div class="space-y-6 animate-fade-in">

    <!-- Header Stats & Actions -->
    <div class="flex justify-between items-center">
        <div class="text-xs text-gray-400 bg-white/5 border border-white/5 px-4 py-2 rounded-xl">
            Total Pesan: <span class="text-blue-500 font-bold ml-1">{{ $messages->count() }}</span>
        </div>
        @if($messages->count() > 0)
        <form method="POST" action="{{ route('admin.messages.clearAll') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA pesan masuk? Tindakan ini tidak dapat dibatalkan.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 rounded-xl transition-all shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                Hapus Semua Pesan
            </button>
        </form>
        @endif
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
                        <th class="p-5 font-semibold text-right">Aksi</th>
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
                        <!-- Action -->
                        <td class="p-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <form method="POST" action="{{ route('admin.messages.delete', $msg->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari {{ addslashes($msg->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Pesan" class="p-2 rounded-lg bg-white/5 border border-white/5 hover:border-red-500 hover:text-red-400 text-gray-400 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-gray-500">
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