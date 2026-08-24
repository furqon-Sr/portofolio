@extends('layouts.admin')

@section('title', 'Manage Clients')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold tracking-tighter text-white">Clients & Collaborations</h1>
        <p class="text-gray-400 mt-1">Manage the companies and clients you have worked with.</p>
    </div>
    <a href="{{ route('admin.clients.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Add Client
    </a>
</div>

<div class="bg-gray-900 border border-white/10 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-400">
            <thead class="text-xs uppercase bg-gray-800/50 text-gray-300">
                <tr>
                    <th class="px-6 py-4 font-medium">Order</th>
                    <th class="px-6 py-4 font-medium">Logo</th>
                    <th class="px-6 py-4 font-medium">Client Name</th>
                    <th class="px-6 py-4 font-medium">URL</th>
                    <th class="px-6 py-4 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($clients as $client)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-300">{{ $client->order_index }}</td>
                    <td class="px-6 py-4">
                        <div class="h-10 w-24 bg-white/5 rounded p-2 flex items-center justify-center">
                            @if(Str::startsWith($client->logo, '<svg') || Str::startsWith($client->logo, 'data:image'))
                                <img src="{{ Str::startsWith($client->logo, '<svg') ? 'data:image/svg+xml;base64,'.base64_encode($client->logo) : $client->logo }}" class="max-h-full max-w-full object-contain">
                            @else
                                <span class="text-xs">Invalid</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-white">{{ $client->name }}</td>
                    <td class="px-6 py-4">
                        @if($client->url)
                            <a href="{{ $client->url }}" target="_blank" class="text-blue-400 hover:underline">Link</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="text-gray-400 hover:text-white transition-colors">Edit</a>
                            <form action="{{ route('admin.clients.delete', $client->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this client?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No clients found. Add your first client!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
