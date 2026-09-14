<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        Frontend Environment Dashboard
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>


<body
    class="min-h-screen bg-slate-100 text-slate-900 transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100">


    <nav
        class="border-b border-slate-200 bg-white/90 backdrop-blur dark:border-slate-800 dark:bg-slate-900/90">

        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

            <div>

                <a
                    href="{{ route('home') }}"
                    class="text-xl font-bold theme-accent-text">
                    Laravel 12
                </a>

                <span
                    class="ml-2 hidden text-sm text-slate-500 sm:inline dark:text-slate-400">
                    Frontend Environment Dashboard
                </span>

            </div>


            <div class="flex items-center gap-2">

                <a
                    href="{{ route('home') }}"
                    class="rounded-lg px-3 py-2 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    Home
                </a>


                <button
                    type="button"
                    id="refreshDashboard"
                    class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium transition hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800">
                    🔄
                    <span class="hidden sm:inline">
                        Refresh
                    </span>
                </button>


                <a
                    href="{{ route('frontend.dashboard.export') }}"
                    class="rounded-lg bg-green-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-green-700">
                    📥
                    <span class="hidden sm:inline">
                        Export
                    </span>
                </a>


                <button
                    type="button"
                    id="themeToggle"
                    class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium transition hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800">

                    <span id="themeIcon">
                        🌙
                    </span>

                    <span class="hidden sm:inline">
                        Theme
                    </span>

                </button>

            </div>

        </div>

    </nav>



    <main
        class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">


        <!-- Header -->

        <div class="mb-8">

            <div class="mb-3 flex flex-wrap items-center gap-2">

                <span
                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700 dark:bg-green-900/40 dark:text-green-300">
                    ● Frontend Ready
                </span>


                <span
                    class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                    Vite
                    {{ $viteVersion }}
                </span>


                <span
                    class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300">
                    Tailwind
                    {{ $tailwindVersion }}
                </span>

            </div>


            <h1
                class="theme-accent-text text-3xl font-bold tracking-tight sm:text-4xl">
                Frontend Environment Dashboard
            </h1>


            <p
                class="mt-2 max-w-3xl text-slate-600 dark:text-slate-400">
                Monitor Laravel, PHP, Node.js, npm, Vite, Tailwind CSS
                and the complete frontend development environment.
            </p>


            <!-- Search -->

            <div class="mt-6 max-w-xl">

                <div class="relative">

                    <input
                        type="text"
                        id="dashboardSearch"
                        placeholder="Search dashboard..."
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pl-11 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-slate-700 dark:bg-slate-900">

                    <span
                        class="absolute left-4 top-1/2 -translate-y-1/2">
                        🔍
                    </span>

                </div>

            </div>

        </div>



        <!-- Health -->

        <section
            class="dashboard-section"
            data-search="health environment status system">

            <div
                class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h2 class="section-title">
                        Environment Health
                    </h2>

                    <p class="section-description">
                        Overall frontend environment health.
                    </p>

                </div>


                <div class="text-right">

                    <p class="text-3xl font-black theme-accent-text">
                        {{ $healthPercentage }}%
                    </p>

                    <p class="text-xs text-slate-500">
                        {{ $healthyCount }}
                        / {{ $totalChecks }}
                        checks healthy
                    </p>

                </div>

            </div>


            <div
                class="mb-6 h-3 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">

                <div
                    class="health-bar h-full rounded-full"
                    style="width: {{ $healthPercentage }}%"></div>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                @foreach($environmentChecks as $name => $healthy)

                <div class="dashboard-card">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl
                    {{ $healthy
                        ? 'bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-300'
                        : 'bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300'
                    }}">
                        {{ $healthy ? '✓' : '!' }}
                    </div>


                    <div>

                        <p class="card-label">
                            {{ $name }}
                        </p>

                        <p
                            class="mt-1 text-sm font-semibold
                        {{ $healthy
                            ? 'text-green-600 dark:text-green-400'
                            : 'text-red-600 dark:text-red-400'
                        }}">
                            {{ $healthy ? 'Healthy' : 'Not Available' }}
                        </p>

                    </div>

                </div>

                @endforeach

            </div>

        </section>



        <!-- Environment -->

        <section
            class="mt-8 dashboard-section"
            data-search="laravel php node npm runtime environment versions">

            <div class="mb-4">

                <h2 class="section-title">
                    Environment Versions
                </h2>

                <p class="section-description">
                    Runtime versions currently detected by Laravel.
                </p>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <div class="dashboard-card">

                    <div class="version-icon theme-accent-bg">
                        L
                    </div>

                    <div>

                        <p class="card-label">
                            Laravel
                        </p>

                        <p class="version-value">
                            {{ $laravelVersion }}
                        </p>

                        <p class="status-text">
                            Framework
                        </p>

                    </div>

                </div>


                <div class="dashboard-card">

                    <div
                        class="version-icon bg-indigo-100 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-300">
                        P
                    </div>

                    <div>

                        <p class="card-label">
                            PHP
                        </p>

                        <p class="version-value">
                            {{ $phpVersion }}
                        </p>

                        <p class="status-text">
                            Runtime
                        </p>

                    </div>

                </div>


                <div class="dashboard-card">

                    <div
                        class="version-icon bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-300">
                        N
                    </div>

                    <div>

                        <p class="card-label">
                            Node.js
                        </p>

                        <p class="version-value">
                            {{ $nodeVersion }}

                            <button
                                type="button"
                                class="copy-btn ml-1"
                                data-copy="{{ $nodeVersion }}">
                                📋
                            </button>

                        </p>

                        <p class="status-text">
                            JavaScript Runtime
                        </p>

                    </div>

                </div>


                <div class="dashboard-card">

                    <div
                        class="version-icon bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300">
                        npm
                    </div>

                    <div>

                        <p class="card-label">
                            npm
                        </p>

                        <p class="version-value">
                            {{ $npmVersion }}

                            <button
                                type="button"
                                class="copy-btn"
                                data-copy="{{ $npmVersion }}">
                                📋
                            </button>

                        </p>

                        <p class="status-text">
                            Package Manager
                        </p>

                    </div>

                </div>

            </div>

        </section>



        <!-- Frontend Packages -->

        <section
            class="mt-8 dashboard-section"
            data-search="vite tailwind postcss autoprefixer frontend packages">

            <div class="mb-4">

                <h2 class="section-title">
                    Frontend Stack
                </h2>

                <p class="section-description">
                    Installed frontend build and styling technologies.
                </p>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                @php

                $frontendPackages = [

                [
                'name' => 'Vite',
                'version' => $viteVersion,
                'type' => 'Build Tool',
                'color' => 'purple'
                ],

                [
                'name' => 'Tailwind CSS',
                'version' => $tailwindVersion,
                'type' => 'CSS',
                'color' => 'cyan'
                ],

                [
                'name' => 'PostCSS',
                'version' => $postcssVersion,
                'type' => 'Processor',
                'color' => 'orange'
                ],

                [
                'name' => 'Autoprefixer',
                'version' => $autoprefixerVersion,
                'type' => 'CSS',
                'color' => 'blue'
                ],

                ];

                @endphp


                @foreach($frontendPackages as $package)

                <div class="package-card">

                    <div class="package-top">

                        <span class="package-name">
                            {{ $package['name'] }}
                        </span>

                        <span
                            class="package-badge
                        bg-{{ $package['color'] }}-100
                        text-{{ $package['color'] }}-700
                        dark:bg-{{ $package['color'] }}-900/40
                        dark:text-{{ $package['color'] }}-300">
                            {{ $package['type'] }}
                        </span>

                    </div>


                    <div
                        class="mt-4 flex items-center justify-between gap-2">

                        <p class="package-version">
                            {{ $package['version'] }}
                        </p>


                        <button
                            type="button"
                            class="copy-btn"
                            data-copy="{{ $package['name'] }} {{ $package['version'] }}">
                            📋 Copy
                        </button>

                    </div>

                </div>

                @endforeach

            </div>

        </section>



        <!-- Build Status -->

        <section
            class="mt-8 dashboard-section"
            data-search="build vite production manifest npm dev build">

            <div class="mb-4">

                <h2 class="section-title">
                    Build Status
                </h2>

                <p class="section-description">
                    Check whether a production Vite build is currently available.
                </p>

            </div>


            <div
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div
                    class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        @if($buildStatus)

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-xl text-green-600 dark:bg-green-900/40 dark:text-green-300">
                            ✓
                        </div>

                        <div>

                            <h3 class="font-semibold">
                                Production build detected
                            </h3>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                public/build/manifest.json is available.
                            </p>

                        </div>

                        @else

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-100 text-xl text-amber-600 dark:bg-amber-900/40 dark:text-amber-300">
                            !
                        </div>

                        <div>

                            <h3 class="font-semibold">
                                Development build active
                            </h3>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                No production manifest detected.
                            </p>

                        </div>

                        @endif

                    </div>


                    <div class="flex flex-wrap gap-2">

                        <code class="command-copy command-box">
                            npm run dev
                        </code>

                        <code class="command-copy command-box">
                            npm run build
                        </code>

                    </div>

                </div>

            </div>

        </section>



        <!-- Project Statistics -->

        <section
            class="mt-8 dashboard-section"
            data-search="statistics files controllers blade javascript css migrations routes project">

            <div class="mb-4">

                <h2 class="section-title">
                    Project Statistics
                </h2>

                <p class="section-description">
                    Basic statistics collected from the project structure.
                </p>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($projectStatistics as $name => $count)

                <div class="stat-card">

                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        {{ ucfirst($name) }}
                    </p>

                    <p class="mt-2 text-3xl font-black theme-accent-text">
                        {{ $count }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Files
                    </p>

                </div>

                @endforeach

            </div>

        </section>



        <!-- Dependencies -->

        <section
            class="mt-8 dashboard-section"
            data-search="dependencies package json npm packages">

            <div class="mb-4">

                <h2 class="section-title">
                    NPM Dependencies
                </h2>

                <p class="section-description">
                    All dependencies configured in package.json.
                </p>

            </div>


            <div
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead
                            class="bg-slate-100 dark:bg-slate-800">

                            <tr>

                                <th class="px-5 py-4">
                                    Package
                                </th>

                                <th class="px-5 py-4">
                                    Version
                                </th>

                                <th class="px-5 py-4">
                                    Type
                                </th>

                                <th class="px-5 py-4 text-right">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($allDependencies as $dependency)

                            <tr
                                class="border-t border-slate-200 dark:border-slate-800">

                                <td class="px-5 py-4 font-semibold">
                                    {{ $dependency['name'] }}
                                </td>

                                <td
                                    class="px-5 py-4 font-mono text-slate-500">
                                    {{ $dependency['version'] }}
                                </td>

                                <td class="px-5 py-4">

                                    <span
                                        class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                        {{ $dependency['type'] }}
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-right">

                                    <button
                                        type="button"
                                        class="copy-btn"
                                        data-copy="{{ $dependency['name'] }}@{{ $dependency['version'] }}">
                                        📋 Copy
                                    </button>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="px-5 py-8 text-center text-slate-500">
                                    No NPM dependencies found.
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>



        <!-- NPM Scripts -->

        <section
            class="mt-8 dashboard-section"
            data-search="npm scripts package commands dev build script">

            <div class="mb-4">

                <h2 class="section-title">
                    NPM Scripts
                </h2>

                <p class="section-description">
                    Commands configured inside package.json.
                </p>

            </div>


            <div class="grid gap-4 md:grid-cols-2">

                @forelse($scripts as $name => $command)

                <div class="workflow-card">

                    <div class="flex items-center justify-between gap-3">

                        <div>

                            <p class="font-bold">
                                npm run {{ $name }}
                            </p>

                            <p
                                class="mt-1 font-mono text-xs text-slate-500 dark:text-slate-400">
                                {{ $command }}
                            </p>

                        </div>


                        <button
                            type="button"
                            class="copy-btn"
                            data-copy="npm run {{ $name }}">
                            📋
                        </button>

                    </div>

                </div>

                @empty

                <div class="info-card">
                    No npm scripts configured.
                </div>

                @endforelse

            </div>

        </section>



        <!-- Environment Information -->

        <section
            class="mt-8 dashboard-section"
            data-search="environment app debug url server operating system">

            <div class="mb-4">

                <h2 class="section-title">
                    Laravel Environment
                </h2>

                <p class="section-description">
                    Current application environment information.
                </p>

            </div>


            <div class="grid gap-5 md:grid-cols-2">

                @foreach($environment as $key => $value)

                <div class="info-card">

                    <p class="info-label">
                        {{ $key }}
                    </p>

                    <p class="info-value">
                        {{ $value }}
                    </p>

                </div>

                @endforeach

            </div>

        </section>



        <!-- Theme Manager -->

        <section
            class="mt-8 dashboard-section"
            data-search="theme color red blue green purple dark mode">

            <div class="mb-4">

                <h2 class="section-title">
                    Tailwind Theme Manager
                </h2>

                <p class="section-description">
                    Change the interface accent color and dark mode.
                </p>

            </div>


            <div class="theme-manager">

                <h3 class="font-semibold">
                    Accent Color
                </h3>


                <div class="mt-5 flex flex-wrap gap-3">

                    <button
                        type="button"
                        class="theme-option theme-red"
                        data-theme="red">
                        Red
                    </button>


                    <button
                        type="button"
                        class="theme-option theme-blue"
                        data-theme="blue">
                        Blue
                    </button>


                    <button
                        type="button"
                        class="theme-option theme-green"
                        data-theme="green">
                        Green
                    </button>


                    <button
                        type="button"
                        class="theme-option theme-purple"
                        data-theme="purple">
                        Purple
                    </button>

                </div>

            </div>

        </section>



        <!-- Last Checked -->

        <div
            class="mt-8 rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm dark:border-slate-800 dark:bg-slate-900">

            <p class="text-sm text-slate-500 dark:text-slate-400">
                Last dashboard check
            </p>

            <p class="mt-1 font-semibold">
                {{ $lastChecked }}
            </p>

        </div>



        <footer
            class="mt-12 border-t border-slate-200 py-6 text-center text-sm text-slate-500 dark:border-slate-800 dark:text-slate-400">

            Laravel 12 · Node.js · Vite · Tailwind CSS

        </footer>


    </main>


    <!-- Toast -->

    <div
        id="toast"
        class="fixed bottom-5 right-5 z-50 hidden rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-xl">
        Copied!
    </div>


</body>

</html>