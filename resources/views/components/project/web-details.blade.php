@props(['project'])

<div class="space-y-12">
    <!-- Tech Stack & Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 bg-[#1a1a1a] rounded-3xl p-8 border border-gray-800">
            <h3 class="text-xl font-bold text-white mb-4">Technical Overview</h3>
            <p class="text-gray-400 leading-relaxed mb-6">
                This web application was built with a focus on scalable architecture and operational efficiency. The frontend utilizes modern framework capabilities to ensure a responsive, accessible, and fast user experience. On the backend, robust APIs serve data reliably while maintaining strict security protocols.
            </p>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-[#222] border border-gray-700 rounded-md text-xs text-gray-300">Laravel</span>
                <span class="px-3 py-1 bg-[#222] border border-gray-700 rounded-md text-xs text-gray-300">TailwindCSS</span>
                <span class="px-3 py-1 bg-[#222] border border-gray-700 rounded-md text-xs text-gray-300">MySQL</span>
                <span class="px-3 py-1 bg-[#222] border border-gray-700 rounded-md text-xs text-gray-300">Alpine.js</span>
            </div>
        </div>
        
        <div class="bg-[#1a1a1a] rounded-3xl p-8 border border-gray-800 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Role</h3>
                <p class="text-gray-400 text-sm mb-6">Fullstack Developer</p>
                <h3 class="text-xl font-bold text-white mb-2">Timeline</h3>
                <p class="text-gray-400 text-sm">3 Months</p>
            </div>
            
            @if(isset($project->github_link) && $project->github_link)
            <div class="mt-8">
                <a href="{{ $project->github_link }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-[#24292e] hover:bg-[#2f363d] border border-gray-700 text-white font-semibold rounded-xl transition-all shadow-lg hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                    View Source on GitHub
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Feature Image/Mockup -->
    <div class="aspect-[16/9] w-full bg-[#111] border border-gray-800 rounded-3xl overflow-hidden relative group flex items-center justify-center">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/30 to-[#111]"></div>
        <p class="text-blue-500/50 font-bold text-2xl tracking-widest uppercase z-10">Web App Preview</p>
    </div>
</div>
