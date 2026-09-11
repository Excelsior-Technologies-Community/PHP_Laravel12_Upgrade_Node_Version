<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Frontend Upgrade Dashboard
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body
    class="min-h-screen bg-slate-100 text-slate-900 transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100"
>

    <!--
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    -->

    <nav
        class="border-b border-slate-200 bg-white/90 backdrop-blur dark:border-slate-800 dark:bg-slate-900/90"
    >
        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8"
        >

            <div>
<a 
    href="{{ route('home') }}" 
    class="text-xl font-bold theme-accent-text"
>
    Laravel 12
</a>

                <span class="ml-2 hidden text-sm text-slate-500 sm:inline dark:text-slate-400">
                    Frontend Upgrade Dashboard
                </span>
            </div>

            <div class="flex items-center gap-2">

                <a
                    href="{{ route('home') }}"
                    class="rounded-lg px-3 py-2 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800"
                >
                    Home
                </a>

                <button
                    type="button"
                    id="themeToggle"
                    class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium transition hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800"
                >
                    <span id="themeIcon">🌙</span>
                    <span class="hidden sm:inline">Theme</span>
                </button>

            </div>

        </div>
    </nav>


    <!--
    |--------------------------------------------------------------------------
    | Main Content
    |--------------------------------------------------------------------------
    -->

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <!-- Header -->

        <div class="mb-8">

            <div class="mb-3 flex flex-wrap items-center gap-2">

                <span
                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700 dark:bg-green-900/40 dark:text-green-300"
                >
                    ● Frontend Ready
                </span>

                <span
                    class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300"
                >
                    Vite 5
                </span>

                <span
                    class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300"
                >
                    Tailwind CSS 3
                </span>

            </div>

<h1 class="theme-accent-text text-3xl font-bold tracking-tight sm:text-4xl">
    Frontend Environment Dashboard
</h1>

            <p class="mt-2 max-w-3xl text-slate-600 dark:text-slate-400">
                Monitor the Laravel, PHP, Node.js, npm, Vite and Tailwind CSS
                environment used by this Laravel 12 frontend.
            </p>

        </div>


        <!--
        |--------------------------------------------------------------------------
        | Environment Cards
        |--------------------------------------------------------------------------
        -->

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

            <!-- Laravel -->

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


            <!-- PHP -->

            <div class="dashboard-card">

                <div class="version-icon bg-indigo-100 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-300">
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


            <!-- Node -->

            <div class="dashboard-card">

                <div class="version-icon bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-300">
                    N
                </div>

                <div>
                    <p class="card-label">
                        Node.js
                    </p>

                    <p class="version-value">
                        {{ $nodeVersion }}
                    </p>

                    <p class="status-text">
                        JavaScript Runtime
                    </p>
                </div>

            </div>


            <!-- npm -->

            <div class="dashboard-card">

                <div class="version-icon bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300">
                    npm
                </div>

                <div>
                    <p class="card-label">
                        npm
                    </p>

                    <p class="version-value">
                        {{ $npmVersion }}
                    </p>

                    <p class="status-text">
                        Package Manager
                    </p>
                </div>

            </div>

        </div>


        <!--
        |--------------------------------------------------------------------------
        | Frontend Packages
        |--------------------------------------------------------------------------
        -->

        <section class="mt-8">

            <div class="mb-4">

                <h2 class="section-title">
                    Frontend Stack
                </h2>

                <p class="section-description">
                    Installed frontend build and styling technologies.
                </p>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <div class="package-card">

                    <div class="package-top">
                        <span class="package-name">
                            Vite
                        </span>

                        <span class="package-badge bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300">
                            Build Tool
                        </span>
                    </div>

                    <p class="package-version">
                        {{ $viteVersion }}
                    </p>

                </div>


                <div class="package-card">

                    <div class="package-top">
                        <span class="package-name">
                            Tailwind CSS
                        </span>

                        <span class="package-badge bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300">
                            CSS
                        </span>
                    </div>

                    <p class="package-version">
                        {{ $tailwindVersion }}
                    </p>

                </div>


                <div class="package-card">

                    <div class="package-top">
                        <span class="package-name">
                            PostCSS
                        </span>

                        <span class="package-badge bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-300">
                            Processor
                        </span>
                    </div>

                    <p class="package-version">
                        {{ $postcssVersion }}
                    </p>

                </div>


                <div class="package-card">

                    <div class="package-top">
                        <span class="package-name">
                            Autoprefixer
                        </span>

                        <span class="package-badge bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                            CSS
                        </span>
                    </div>

                    <p class="package-version">
                        {{ $autoprefixerVersion }}
                    </p>

                </div>

            </div>

        </section>


        <!--
        |--------------------------------------------------------------------------
        | Build Status
        |--------------------------------------------------------------------------
        -->

        <section class="mt-8">

            <div class="mb-4">

                <h2 class="section-title">
                    Build Status
                </h2>

                <p class="section-description">
                    Check whether a production Vite build is currently available.
                </p>

            </div>


            <div
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900"
            >

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        @if($buildStatus)

                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-xl text-green-600 dark:bg-green-900/40 dark:text-green-300">
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

                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-100 text-xl text-amber-600 dark:bg-amber-900/40 dark:text-amber-300">
                                !
                            </div>

                            <div>

                                <h3 class="font-semibold">
                                    Development build active
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    No production manifest detected. Run npm run build when required.
                                </p>

                            </div>

                        @endif

                    </div>


                    <div class="flex flex-wrap gap-2">

                        <code class="rounded-lg bg-slate-100 px-3 py-2 text-sm dark:bg-slate-800">
                            npm run dev
                        </code>

                        <code class="rounded-lg bg-slate-100 px-3 py-2 text-sm dark:bg-slate-800">
                            npm run build
                        </code>

                    </div>

                </div>

            </div>

        </section>


        <!--
        |--------------------------------------------------------------------------
        | Vite Workflow
        |--------------------------------------------------------------------------
        -->

        <section class="mt-8">

            <div class="mb-4">

                <h2 class="section-title">
                    Vite Frontend Workflow
                </h2>

                <p class="section-description">
                    Development and production commands used by the project.
                </p>

            </div>


            <div class="grid gap-5 md:grid-cols-2">

                <!-- Development -->

                <div class="workflow-card">

                    <div class="mb-4 flex items-center justify-between">

                        <div>

                            <h3 class="workflow-title">
                                Development Mode
                            </h3>

                            <p class="workflow-description">
                                Enables Vite development server and HMR.
                            </p>

                        </div>

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700 dark:bg-green-900/40 dark:text-green-300">
                            DEV
                        </span>

                    </div>


                    <div class="command-box">
                        npm run dev
                    </div>


                    <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-400">

                        <li>✓ Hot Module Replacement</li>

                        <li>✓ Fast frontend development</li>

                        <li>✓ Automatic browser refresh</li>

                    </ul>

                </div>


                <!-- Production -->

                <div class="workflow-card">

                    <div class="mb-4 flex items-center justify-between">

                        <div>

                            <h3 class="workflow-title">
                                Production Mode
                            </h3>

                            <p class="workflow-description">
                                Compiles optimized frontend assets.
                            </p>

                        </div>

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                            BUILD
                        </span>

                    </div>


                    <div class="command-box">
                        npm run build
                    </div>


                    <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-400">

                        <li>✓ Minified CSS</li>

                        <li>✓ Optimized JavaScript</li>

                        <li>✓ Production asset manifest</li>

                    </ul>

                </div>

            </div>

        </section>


        <!--
        |--------------------------------------------------------------------------
        | Theme Manager
        |--------------------------------------------------------------------------
        -->

        <section class="mt-8">

            <div class="mb-4">

                <h2 class="section-title">
                    Tailwind Theme Manager
                </h2>

                <p class="section-description">
                    Change the interface theme instantly. Your selection is saved
                    in browser local storage.
                </p>

            </div>


            <div class="theme-manager">

                <div>

                    <h3 class="font-semibold">
                        Color Theme
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Select an accent color.
                    </p>

                </div>


                <div class="mt-5 flex flex-wrap gap-3">

                    <button
                        type="button"
                        class="theme-option theme-red"
                        data-theme="red"
                    >
                        Red
                    </button>

                    <button
                        type="button"
                        class="theme-option theme-blue"
                        data-theme="blue"
                    >
                        Blue
                    </button>

                    <button
                        type="button"
                        class="theme-option theme-green"
                        data-theme="green"
                    >
                        Green
                    </button>

                    <button
                        type="button"
                        class="theme-option theme-purple"
                        data-theme="purple"
                    >
                        Purple
                    </button>

                </div>

            </div>

        </section>


        <!--
        |--------------------------------------------------------------------------
        | Package Information
        |--------------------------------------------------------------------------
        -->

        <section class="mt-8">

            <div class="mb-4">

                <h2 class="section-title">
                    Project Information
                </h2>

            </div>


            <div class="grid gap-5 md:grid-cols-2">

                <div class="info-card">

                    <p class="info-label">
                        Package Name
                    </p>

                    <p class="info-value">
                        {{ $packageName }}
                    </p>

                </div>


                <div class="info-card">

                    <p class="info-label">
                        Laravel Vite Plugin
                    </p>

                    <p class="info-value">
                        {{ $laravelViteVersion }}
                    </p>

                </div>

            </div>

        </section>


        <!-- Footer -->

        <footer
            class="mt-12 border-t border-slate-200 py-6 text-center text-sm text-slate-500 dark:border-slate-800 dark:text-slate-400"
        >
            Laravel 12 · Node.js · Vite 5 · Tailwind CSS 3
        </footer>

    </main>

</body>
</html>