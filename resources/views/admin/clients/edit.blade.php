@extends('layouts.admin')

@section('title', 'Edit Client')

@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.clients.index') }}" class="text-gray-400 hover:text-white transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
    </a>
    <h1 class="text-3xl font-bold tracking-tighter text-white">Edit Client</h1>
</div>

<div class="bg-gray-900 border border-white/10 rounded-2xl p-6 md:p-8 max-w-3xl">
    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" x-data="{ logoPreview: '{{ Str::startsWith($client->logo, '<svg') ? 'data:image/svg+xml;base64,'.base64_encode($client->logo) : $client->logo }}' }">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Client / Company Name</label>
                <input type="text" name="name" value="{{ $client->name }}" required class="w-full bg-gray-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
            </div>

            <!-- URL -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Website URL (Optional)</label>
                <input type="url" name="url" value="{{ $client->url }}" class="w-full bg-gray-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
            </div>
            
            <!-- Order -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Order Index (Sort)</label>
                <input type="number" name="order_index" value="{{ $client->order_index }}" class="w-full bg-gray-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
            </div>

            <!-- Logo Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Client Logo (Image)</label>
                <div class="flex items-start gap-6">
                    <div class="flex-1">
                        <input type="file" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500/10 file:text-blue-400 hover:file:bg-blue-500/20 cursor-pointer"
                            @change="
                                const file = $event.target.files[0];
                                if(file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        logoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                }
                            "
                        >
                        <input type="hidden" name="logo" :value="logoPreview">
                        <p class="text-xs text-gray-500 mt-2">Leave empty to keep existing logo. Upload transparent PNG or SVG for best results.</p>
                    </div>
                    
                    <template x-if="logoPreview">
                        <div class="w-24 h-24 rounded-xl bg-white/5 border border-white/10 overflow-hidden flex-shrink-0 p-3 flex items-center justify-center">
                            <img :src="logoPreview" class="max-w-full max-h-full object-contain">
                        </div>
                    </template>
                </div>
            </div>

        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                Update Client
            </button>
        </div>
    </form>
</div>
@endsection
