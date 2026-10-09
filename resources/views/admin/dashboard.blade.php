@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-14 animate-fade-in">

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
        <a href="{{ route('admin.projects.index') }}" class="group block">
            <p class="text-xs text-gray-500 tracking-wide">Total Portfolio</p>
            <p class="text-4xl font-semibold text-white mt-2 tabular-nums">{{ $projectCount }}</p>
            <p class="text-xs text-gray-600 group-hover:text-blue-400 mt-2 transition-colors">Kelola &rarr;</p>
        </a>
        <a href="{{ route('admin.certificates.index') }}" class="group block">
            <p class="text-xs text-gray-500 tracking-wide">Total Sertifikat</p>
            <p class="text-4xl font-semibold text-white mt-2 tabular-nums">{{ $certificateCount }}</p>
            <p class="text-xs text-gray-600 group-hover:text-blue-400 mt-2 transition-colors">Kelola &rarr;</p>
        </a>
        <a href="{{ route('admin.messages') }}" class="group block">
            <p class="text-xs text-gray-500 tracking-wide">Pesan Masuk</p>
            <p class="text-4xl font-semibold text-white mt-2 tabular-nums">{{ $messageCount }}</p>
            <p class="text-xs text-gray-600 group-hover:text-blue-400 mt-2 transition-colors">Buka inbox &rarr;</p>
        </a>
    </div>

    <!-- Interaction Statistics -->
    <section>
        <div class="flex items-end justify-between gap-4">
            <div>
                <h3 class="text-sm font-medium text-white">Statistik Interaksi</h3>
                <p class="text-xs text-gray-500 mt-1">14 hari terakhir</p>
            </div>
            <div class="flex items-center gap-5 text-xs text-gray-500">
                <span class="flex items-center gap-2"><span class="w-3 h-px bg-blue-500"></span>Pesan masuk</span>
                <span class="flex items-center gap-2"><span class="w-3 h-px bg-gray-500"></span>Konten baru</span>
            </div>
        </div>
        <div class="relative h-56 mt-6">
            <canvas id="interactionChart"></canvas>
        </div>
    </section>

    <!-- Recent -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-14">

        <!-- Recent Messages -->
        <section class="lg:col-span-7">
            <div class="flex justify-between items-baseline">
                <h3 class="text-sm font-medium text-white">Pesan Terbaru</h3>
                <a href="{{ route('admin.messages') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Lihat semua</a>
            </div>
            <div class="mt-6 space-y-7">
                @forelse($recentMessages as $msg)
                <div class="group">
                    <div class="flex justify-between items-baseline gap-3">
                        <div class="min-w-0 flex items-baseline gap-2">
                            <h4 class="text-sm text-gray-200 truncate">{{ $msg->name }}</h4>
                            <span class="text-xs text-gray-600 truncate">{{ $msg->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="text-[11px] text-gray-600">{{ $msg->created_at->diffForHumans() }}</span>
                            <form method="POST" action="{{ route('admin.messages.delete', $msg->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari {{ addslashes($msg->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus Pesan" class="text-gray-700 hover:text-red-400 opacity-0 group-hover:opacity-100 focus:opacity-100 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1.5 line-clamp-2 leading-relaxed">{{ $msg->message }}</p>
                </div>
                @empty
                <p class="text-sm text-gray-600">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </section>

        <!-- Recent Projects & Certificates -->
        <div class="lg:col-span-5 space-y-12">
            <section>
                <div class="flex justify-between items-baseline">
                    <h3 class="text-sm font-medium text-white">Portfolio Terbaru</h3>
                    <a href="{{ route('admin.projects.index') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Lihat semua</a>
                </div>
                <div class="mt-6 space-y-4">
                    @forelse($recentProjects as $proj)
                    <div class="flex items-center gap-4">
                        <img src="{{ $proj->cover_image_url }}" alt="{{ $proj->title }}" class="w-12 h-8 rounded object-cover flex-shrink-0">
                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm text-gray-200 truncate">{{ $proj->title }}</h4>
                            <p class="text-[11px] text-gray-600 mt-0.5">{{ $proj->category }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-600">Belum ada item portofolio.</p>
                    @endforelse
                </div>
            </section>

            <section>
                <div class="flex justify-between items-baseline">
                    <h3 class="text-sm font-medium text-white">Sertifikat Terbaru</h3>
                    <a href="{{ route('admin.certificates.index') }}" class="text-xs text-gray-500 hover:text-white transition-colors">Lihat semua</a>
                </div>
                <div class="mt-6 space-y-4">
                    @forelse($recentCertificates as $cert)
                    <div class="flex items-center gap-4">
                        @if($cert->is_pdf)
                            <div class="w-12 h-8 rounded flex items-center justify-center flex-shrink-0 text-red-400/80">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                            </div>
                        @else
                            <img src="{{ $cert->image_url }}" alt="{{ $cert->name }}" class="w-12 h-8 rounded object-cover flex-shrink-0">
                        @endif
                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm text-gray-200 truncate">{{ $cert->name }}</h4>
                            <p class="text-[11px] text-gray-600 mt-0.5">{{ $cert->issuer }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-600">Belum ada sertifikat.</p>
                    @endforelse
                </div>
            </section>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const data = @json($chartData);
        const ctx = document.getElementById('interactionChart');
        if (!ctx || typeof Chart === 'undefined') return;

        const series = (label, values, color) => ({
            label,
            data: values,
            borderColor: color,
            borderWidth: 1.5,
            tension: 0.4,
            pointRadius: 0,
            pointHoverRadius: 0,
            fill: false,
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    series('Pesan masuk', data.messages, '#3b82f6'),
                    series('Konten baru', data.content, '#6b7280'),
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111111',
                        titleColor: '#9ca3af',
                        bodyColor: '#e5e7eb',
                        displayColors: false,
                        padding: 10,
                        cornerRadius: 6,
                    },
                },
                scales: {
                    x: {
                        display: true,
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#4b5563', font: { size: 10 }, maxTicksLimit: 7, maxRotation: 0 },
                    },
                    y: {
                        display: false,
                        beginAtZero: true,
                        grid: { display: false },
                        border: { display: false },
                    },
                },
            },
        });
    });
</script>
@endsection
