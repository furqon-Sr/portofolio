<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="admin-panel dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $siteSetting = $siteSetting ?? \App\Models\AboutSetting::first() ?? new \App\Models\AboutSetting([
                'logo_type' => 'text',
                'logo_value' => 'HANAFI',
                'footer_name' => 'FAHRURI HANAFI',
            ]);
            $brandTitle = $siteSetting->footer_name ?? ($siteSetting->logo_type === 'text' && !empty($siteSetting->logo_value) ? $siteSetting->logo_value : 'Console');
        @endphp

        <title>{{ $brandTitle }} - Console</title>

        <!-- Dynamic Favicon from Admin Dashboard Settings -->
        @if(!empty($siteSetting->favicon))
            <link rel="icon" type="image/png" href="{{ $siteSetting->favicon }}">
        @else
            <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Robust Inline Fallback Styles -->
        <style>
            html, body {
                margin: 0;
                padding: 0;
                background-color: #09090b !important;
                color: #ffffff;
                font-family: 'Figtree', system-ui, -apple-system, sans-serif;
                zoom: 1 !important;
            }
            .admin-login-box {
                max-width: 400px;
                width: 100%;
                margin: 0 auto;
                box-sizing: border-box;
            }
        </style>
    </head>
    <body class="bg-[#09090b] text-zinc-100 min-h-screen font-sans flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-hidden selection:bg-white selection:text-black">
        <!-- Subtle Ambient Background Lighting -->
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            <div class="absolute -top-36 left-1/2 -translate-x-1/2 w-[600px] h-[360px] bg-gradient-to-b from-blue-500/10 via-purple-500/5 to-transparent blur-3xl opacity-60"></div>
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[420px] h-[180px] bg-white/[0.015] blur-3xl"></div>
        </div>

        <div class="admin-login-box relative z-10 w-full flex flex-col items-center">
            <!-- Brand & Icon Header (Integrated with Admin Dashboard Settings) -->
            <div class="mb-7 text-center">
                <a href="/" class="group inline-flex flex-col items-center gap-3 transition-transform duration-200 hover:scale-[1.02]">
                    <!-- Admin Icon / Logo Container -->
                    <div class="w-12 h-12 rounded-2xl bg-zinc-900/90 border border-white/10 flex items-center justify-center p-2.5 shadow-xl shadow-black/40 group-hover:border-white/25 transition-all">
                        @if(!empty($siteSetting->favicon))
                            <img src="{{ $siteSetting->favicon }}" alt="{{ $brandTitle }}" class="w-full h-full object-contain rounded-lg">
                        @elseif(($siteSetting->logo_type ?? '') === 'svg' && !empty($siteSetting->logo_value))
                            <div class="w-full h-full flex items-center justify-center text-white [&_svg]:w-full [&_svg]:h-full [&_svg]:object-contain">
                                {!! $siteSetting->logo_value !!}
                            </div>
                        @elseif(in_array($siteSetting->logo_type ?? '', ['file', 'url']) && !empty($siteSetting->logo_value))
                            <img src="{{ $siteSetting->logo_value }}" alt="{{ $brandTitle }}" class="w-full h-full object-contain">
                        @else
                            <!-- Sleek Minimalist Terminal / Console Emblem -->
                            <svg class="w-5 h-5 text-zinc-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 9l3 3-3 3m5 0h3M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold tracking-tight text-white">{{ $brandTitle }}</span>
                        <span class="text-[10px] font-mono tracking-wider uppercase px-2 py-0.5 rounded-full bg-white/[0.04] border border-white/10 text-zinc-400">Console</span>
                    </div>
                </a>
            </div>

            <!-- Login Card -->
            <div class="w-full bg-[#111114]/80 backdrop-blur-xl border border-white/[0.08] p-6 sm:p-8 rounded-2xl shadow-2xl shadow-black/80">
                {{ $slot }}
            </div>

            <!-- Footer Return Link -->
            <div class="text-center mt-6">
                <a href="/" class="text-xs text-zinc-500 hover:text-zinc-300 transition-colors inline-flex items-center gap-1.5 group">
                    <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Website</span>
                </a>
            </div>
        </div>
    </body>
</html>
