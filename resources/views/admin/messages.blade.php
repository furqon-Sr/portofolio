<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox Leads - Admin Panel</title>
    @vite('resources/css/app.css') 
</head>
<body class="bg-gray-950 text-white min-h-screen p-6 md:p-12 font-sans">

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Lead Inbox</h1>
                <p class="text-gray-400 mt-1 text-sm">Manajemen pesan masuk dari user.</p>
            </div>
            <div class="text-sm text-gray-500">
                Total Leads: <span class="text-blue-500 font-bold">{{ $messages->count() }}</span>
            </div>
        </div>

        <div class="bg-[#1a1a1a] rounded-2xl border border-white/10 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#111] border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="p-5 font-medium">Waktu Masuk</th>
                            <th class="p-5 font-medium">Nama Prospek</th>
                            <th class="p-5 font-medium">Email Kontak</th>
                            <th class="p-5 font-medium">Isi Pesan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($messages as $msg)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="p-5 text-sm text-gray-500 whitespace-nowrap">
                                {{ $msg->created_at->format('d M Y • H:i') }}
                            </td>
                            <td class="p-5 text-sm font-semibold text-gray-200 whitespace-nowrap">
                                {{ $msg->name }}
                            </td>
                            <td class="p-5 text-sm">
                                <a href="mailto:{{ $msg->email }}" class="text-blue-400 hover:text-blue-300 transition-colors">
                                    {{ $msg->email }}
                                </a>
                            </td>
                            <td class="p-5 text-sm text-gray-400 max-w-md">
                                <p class="truncate group-hover:whitespace-normal group-hover:text-gray-300 transition-all">
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

</body>
</html>