<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Node.js & Frontend Environment Dashboard - Laravel 12</title>

    {{-- Tailwind CSS CDN + Lucide Icons --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a',
                            900: '#14532d',
                            950: '#052e16',
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col antialiased transition-colors duration-200">

    {{-- Header Navbar --}}
    <header class="sticky top-0 z-40 border-b border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Brand --}}
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center shadow-lg shadow-emerald-500/10 text-emerald-500">
                        <i data-lucide="layers" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h1 class="text-base font-bold bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 bg-clip-text text-transparent">
                            Node.js & Frontend Suite
                        </h1>
                        <div class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1.5 font-mono">
                            <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Laravel 12 • Node {{ $nodeVersion }} • Vite 5
                        </div>
                    </div>
                </div>

                {{-- Right Actions & Theme Switcher --}}
                <div class="flex items-center space-x-2 sm:space-x-3">
                    {{-- Dark/Light Mode Switcher --}}
                    <button id="themeToggleBtn" onclick="toggleTheme()" class="p-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-amber-400 hover:scale-105 transition-all" title="Toggle Dark/Light Mode">
                        <i id="themeIcon" data-lucide="sun" class="w-4 h-4"></i>
                    </button>

                    {{-- Export Diagnostics --}}
                    <a href="{{ route('frontend.dashboard.export') }}" target="_blank" class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 flex items-center gap-1.5 transition-all">
                        <i data-lucide="file-json" class="w-3.5 h-3.5 text-emerald-500"></i>
                        <span class="hidden sm:inline">Export Report</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs font-medium">
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Container --}}
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        {{-- Top Metrics Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Node.js Status --}}
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Node.js Engine</span>
                    <i data-lucide="box" class="w-4 h-4 text-emerald-500"></i>
                </div>
                <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white">{{ $nodeVersion }}</div>
                <div class="text-xs text-emerald-500 font-medium mt-1 flex items-center gap-1">
                    <i data-lucide="check" class="w-3.5 h-3.5"></i> Active LTS Compatible
                </div>
            </div>

            {{-- NPM Version --}}
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">NPM Package CLI</span>
                    <i data-lucide="package" class="w-4 h-4 text-red-500"></i>
                </div>
                <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white">v{{ $npmVersion }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Ready for modern lockfiles</div>
            </div>

            {{-- Vite 5 Engine --}}
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Vite Bundler</span>
                    <i data-lucide="zap" class="w-4 h-4 text-purple-500"></i>
                </div>
                <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white">{{ $viteVersion }}</div>
                <div class="text-xs text-purple-500 font-medium mt-1">Vite 5 Fast HMR Engine</div>
            </div>

            {{-- Health Percentage --}}
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Environment Health</span>
                    <i data-lucide="shield-check" class="w-4 h-4 text-teal-500"></i>
                </div>
                <div class="text-2xl font-bold font-mono text-teal-500">{{ $healthPercentage }}%</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $healthyCount }} of {{ $totalChecks }} checks passing</div>
            </div>
        </div>

        {{-- 1. NPM Script Runner & Web Terminal Console --}}
        <div class="rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="terminal" class="w-5 h-5 text-emerald-500"></i>
                    <div>
                        <h2 class="text-sm font-bold text-slate-900 dark:text-white">NPM Script Runner & Live Terminal Console</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Trigger frontend build commands and inspect console stdout output.</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap items-center gap-2">
                    {{-- Build Script --}}
                    <form method="POST" action="{{ route('frontend.dashboard.run-script') }}">
                        @csrf
                        <input type="hidden" name="action" value="build">
                        <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm shadow-emerald-600/20 transition-all">
                            <i data-lucide="play" class="w-3.5 h-3.5"></i>
                            <span>npm run build</span>
                        </button>
                    </form>

                    {{-- List Packages --}}
                    <form method="POST" action="{{ route('frontend.dashboard.run-script') }}">
                        @csrf
                        <input type="hidden" name="action" value="list">
                        <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 text-xs font-semibold border border-slate-300 dark:border-slate-700 flex items-center gap-1.5 transition-all">
                            <i data-lucide="list" class="w-3.5 h-3.5"></i>
                            <span>npm list</span>
                        </button>
                    </form>

                    {{-- Audit Script --}}
                    <form method="POST" action="{{ route('frontend.dashboard.run-script') }}">
                        @csrf
                        <input type="hidden" name="action" value="audit">
                        <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 text-xs font-semibold border border-slate-300 dark:border-slate-700 flex items-center gap-1.5 transition-all">
                            <i data-lucide="shield-alert" class="w-3.5 h-3.5 text-amber-500"></i>
                            <span>npm audit</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Terminal Window --}}
            <div class="p-4 bg-slate-950 font-mono text-xs text-emerald-400">
                <div class="flex items-center justify-between pb-2 mb-2 border-b border-slate-800 text-slate-500 text-[11px]">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-yellow-500 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
                        <span class="ml-2 text-slate-400 font-semibold">$ {{ $lastExecution['command'] ?? 'npm run build' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400">Duration: <strong>{{ $lastExecution['duration_ms'] ?? 0 }}ms</strong></span>
                        <span class="text-slate-600">•</span>
                        <span class="text-slate-400">Time: {{ $lastExecution['executed_at'] ?? now()->format('H:i:s') }}</span>
                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold {{ ($lastExecution['status'] ?? 'success') === 'success' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}">
                            {{ strtoupper($lastExecution['status'] ?? 'SUCCESS') }}
                        </span>
                    </div>
                </div>
                <pre class="overflow-x-auto whitespace-pre-wrap leading-relaxed py-2 text-slate-200 max-h-72">{{ $lastExecution['output'] ?? 'No command execution recorded.' }}</pre>
            </div>
        </div>

        {{-- 2. Node.js LTS Matrix & Tooling Detection Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- Node.js LTS Compatibility Matrix --}}
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-check" class="w-5 h-5 text-emerald-500"></i>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Node.js LTS Compatibility Matrix</h3>
                    </div>
                    <span class="text-xs text-slate-500 font-mono">Laravel 12 Standard</span>
                </div>

                <div class="space-y-2.5">
                    @foreach($ltsMatrix as $lts)
                        <div class="p-3 rounded-xl border flex items-center justify-between transition-all {{ $lts['is_current'] ? 'bg-emerald-500/10 border-emerald-500/30' : 'bg-slate-50 dark:bg-slate-950/60 border-slate-200 dark:border-slate-800' }}">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono font-bold text-xs text-slate-900 dark:text-white">{{ $lts['version'] }}</span>
                                    <span class="text-[11px] text-slate-500 dark:text-slate-400">({{ $lts['codename'] }})</span>
                                    @if($lts['is_current'])
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-500 border border-emerald-500/30">ACTIVE</span>
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                                    Vite 5: <strong class="text-emerald-500">Supported</strong> • Tailwind 3/4: <strong class="text-emerald-500">Supported</strong>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $lts['badge'] }}">
                                {{ $lts['status'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tooling & System Telemetry --}}
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i data-lucide="cpu" class="w-5 h-5 text-cyan-500"></i>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Tooling & Runtime Telemetry</h3>
                    </div>
                    <span class="text-xs text-slate-500 font-mono">{{ $nodeTelemetry['platform'] }} ({{ $nodeTelemetry['arch'] }})</span>
                </div>

                {{-- Package Managers Detection --}}
                <div>
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Package Managers Availability</div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach($packageManagers as $mgr => $info)
                            <div class="p-3 rounded-xl border text-center {{ $info['available'] ? 'bg-emerald-500/5 border-emerald-500/20' : 'bg-slate-50 dark:bg-slate-950/40 border-slate-200 dark:border-slate-800' }}">
                                <div class="font-bold text-xs uppercase text-slate-800 dark:text-slate-200">{{ $mgr }}</div>
                                <div class="text-[11px] font-mono mt-0.5 {{ $info['available'] ? 'text-emerald-500 font-semibold' : 'text-slate-400' }}">
                                    {{ $info['available'] ? $info['version'] : 'Not found' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Node & V8 Engine Specs --}}
                <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 space-y-2 text-xs">
                    <div class="flex justify-between">
                        <span class="text-slate-500 dark:text-slate-400">V8 JavaScript Engine:</span>
                        <strong class="font-mono text-slate-800 dark:text-slate-200">{{ $nodeTelemetry['v8_version'] }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500 dark:text-slate-400">System Architecture:</span>
                        <strong class="font-mono text-slate-800 dark:text-slate-200">{{ $nodeTelemetry['arch'] }} (64-bit)</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500 dark:text-slate-400">Node Binary Location:</span>
                        <span class="font-mono text-[11px] text-slate-500 truncate max-w-xs">{{ $nodeTelemetry['node_path'] }}</span>
                    </div>
                </div>
            </div>

        </div>

    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 dark:border-slate-800 py-4 text-center text-xs text-slate-500 bg-white dark:bg-slate-950">
        <p>PHP Laravel 12 Node.js Upgrade & Vite 5 Diagnostics Dashboard</p>
    </footer>

    {{-- Scripts for Theme Switcher & Icons --}}
    <script>
        // Initialize Theme from LocalStorage
        function initTheme() {
            const savedTheme = localStorage.getItem('tailwind_theme') || 'dark';
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            updateThemeIcon();
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('tailwind_theme', isDark ? 'dark' : 'light');
            updateThemeIcon();
        }

        function updateThemeIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            const icon = document.getElementById('themeIcon');
            if (icon) {
                icon.setAttribute('data-lucide', isDark ? 'sun' : 'moon');
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            initTheme();
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>