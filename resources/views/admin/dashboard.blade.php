@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in">
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-[#111111] p-6 rounded-2xl border border-white/5 shadow-lg relative overflow-hidden group hover:border-blue-500/30 transition-all duration-300">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full bg-blue-600/5 blur-[20px] group-hover:bg-blue-600/10 transition-colors"></div>
            <div class="flex items-center gap-4">
                <div class="p-3.5 bg-blue-600/10 border border-blue-500/20 text-blue-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Portfolio</p>
                    <h3 class="text-3xl font-black text-white mt-1">{{ $projectCount }}</h3>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-white/5 flex justify-between items-center text-xs">
                <span class="text-gray-400">Kelola item portofolio Anda</span>
                <a href="{{ route('admin.projects.index') }}" class="text-blue-500 hover:text-blue-400 font-bold flex items-center gap-1 transition-colors">
                    Kelola
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-[#111111] p-6 rounded-2xl border border-white/5 shadow-lg relative overflow-hidden group hover:border-blue-500/30 transition-all duration-300">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full bg-blue-600/5 blur-[20px] group-hover:bg-blue-600/10 transition-colors"></div>
            <div class="flex items-center gap-4">
                <div class="p-3.5 bg-blue-600/10 border border-blue-500/20 text-blue-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Inbox Leads / Pesan</p>
                    <h3 class="text-3xl font-black text-white mt-1">{{ $messageCount }}</h3>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-white/5 flex justify-between items-center text-xs">
                <span class="text-gray-400">Lihat pesan masuk terbaru</span>
                <a href="{{ route('admin.messages') }}" class="text-blue-500 hover:text-blue-400 font-bold flex items-center gap-1 transition-colors">
                    Inbox
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Panels -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Recent Messages (Col 7) -->
        <div class="lg:col-span-7 bg-[#111111] rounded-2xl border border-white/5 p-6 shadow-xl space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-white tracking-tight">Pesan Masuk Terbaru</h3>
                <a href="{{ route('admin.messages') }}" class="text-xs text-gray-400 hover:text-white transition-colors">Lihat Semua</a>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($recentMessages as $msg)
                <div class="py-4 first:pt-0 last:pb-0 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-600/10 border border-blue-500/20 text-blue-400 font-bold text-sm uppercase flex items-center justify-center flex-shrink-0">
                        {{ substr($msg->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline gap-2">
                            <h4 class="text-sm font-semibold text-gray-200 truncate">{{ $msg->name }}</h4>
                            <span class="text-[10px] text-gray-500 whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-blue-400 truncate mt-0.5">{{ $msg->email }}</p>
                        <p class="text-xs text-gray-400 mt-2 line-clamp-2 leading-relaxed bg-white/[0.02] p-3 rounded-lg border border-white/5">{{ $msg->message }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 py-4 text-center">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Projects (Col 5) -->
        <div class="lg:col-span-5 bg-[#111111] rounded-2xl border border-white/5 p-6 shadow-xl space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-white tracking-tight">Portfolio Terbaru</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-gray-400 hover:text-white transition-colors">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentProjects as $proj)
                <div class="flex items-center gap-4">
                    <div class="w-16 h-10 rounded-lg overflow-hidden bg-white/5 border border-white/10 flex-shrink-0 relative">
                        <img src="{{ Str::startsWith($proj->cover_image, 'http') || Str::startsWith($proj->cover_image, 'data:') ? $proj->cover_image : asset('img/' . $proj->cover_image) }}" 
                             alt="{{ $proj->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="text-sm font-semibold text-gray-200 truncate">{{ $proj->title }}</h4>
                        <span class="inline-block text-[9px] font-bold uppercase tracking-wider text-blue-400 mt-0.5">{{ $proj->category }}</span>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 py-4 text-center">Belum ada item portofolio.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
