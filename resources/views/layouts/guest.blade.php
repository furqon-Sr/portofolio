<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="admin-panel">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Robust Inline Fallback Styles to Prevent Unstyled Layout Flashes -->
        <style>
            html, body {
                margin: 0;
                padding: 0;
                background-color: #030712 !important;
                color: #ffffff;
                font-family: 'Figtree', system-ui, -apple-system, sans-serif;
                zoom: 1 !important;
            }
            .admin-login-box {
                max-width: 440px;
                width: 100%;
                margin: 0 auto;
                box-sizing: border-box;
            }
        </style>
    </head>
    <body class="bg-[#0c0c0e] text-white min-h-screen font-sans flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-hidden">
        <!-- Ambient Background Glow -->
        <div class="fixed inset-0 pointer-events-none z-0">
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-blue-600/10 blur-[130px]"></div>
        </div>

        <div class="admin-login-box relative z-10 w-full">
            <!-- Brand Header -->
            <div class="mb-8 text-center">
                <a href="/" class="inline-flex flex-col items-center gap-2 group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-500 shadow-lg shadow-blue-500/10 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div class="text-xl font-bold tracking-tight text-white">HANAFI <span class="text-blue-500 text-xs uppercase tracking-widest block font-medium mt-0.5">Admin Portal</span></div>
                </a>
            </div>

            <!-- Login Card -->
            <div class="bg-[#111113]/90 backdrop-blur-xl border border-white/10 p-6 sm:p-8 rounded-2xl shadow-2xl shadow-black/80">
                {{ $slot }}
            </div>

            <!-- Footer Return Link -->
            <div class="text-center mt-6">
                <a href="/" class="text-xs text-gray-500 hover:text-gray-300 transition-colors inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Website Utama</span>
                </a>
            </div>
        </div>
    </body>
</html>
