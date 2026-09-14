<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Laravel 12 Frontend Upgrade
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body
    class="min-h-screen bg-slate-100 text-slate-900 dark:bg-slate-950 dark:text-white"
>


<main
    class="flex min-h-screen items-center justify-center px-4 py-10"
>


<div
    class="w-full max-w-4xl rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-xl sm:p-12 dark:border-slate-800 dark:bg-slate-900"
>


<!-- Badge -->

<div class="mb-6">

    <span
        class="inline-flex rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700 dark:bg-green-900/40 dark:text-green-300"
    >
        ✓ Frontend Upgrade Successful
    </span>

</div>



<!-- Heading -->

<h1
    class="theme-accent-text text-4xl font-black tracking-tight sm:text-6xl"
>
    Laravel 12
</h1>


<h2
    class="mt-4 text-2xl font-bold sm:text-3xl"
>
    Modern Frontend Stack
</h2>


<p
    class="mx-auto mt-5 max-w-2xl text-slate-600 dark:text-slate-400"
>
    Laravel 12 with Node.js, Vite and Tailwind CSS,
    enhanced with a complete frontend environment monitoring dashboard.
</p>



<!-- Technology Cards -->

<div
    class="mt-8 grid gap-4 sm:grid-cols-4"
>


<div class="rounded-2xl bg-red-50 p-5 dark:bg-red-950/30">

    <div class="text-2xl">
        🚀
    </div>

    <h3 class="mt-2 font-bold">
        Vite
    </h3>

    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        Fast build tool
    </p>

</div>



<div class="rounded-2xl bg-cyan-50 p-5 dark:bg-cyan-950/30">

    <div class="text-2xl">
        🎨
    </div>

    <h3 class="mt-2 font-bold">
        Tailwind
    </h3>

    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        Utility CSS
    </p>

</div>



<div class="rounded-2xl bg-green-50 p-5 dark:bg-green-950/30">

    <div class="text-2xl">
        ⚡
    </div>

    <h3 class="mt-2 font-bold">
        Node.js
    </h3>

    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        Runtime
    </p>

</div>



<div class="rounded-2xl bg-purple-50 p-5 dark:bg-purple-950/30">

    <div class="text-2xl">
        📊
    </div>

    <h3 class="mt-2 font-bold">
        Dashboard
    </h3>

    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        Environment monitor
    </p>

</div>


</div>



<!-- Buttons -->

<div
    class="mt-8 flex flex-col justify-center gap-3 sm:flex-row"
>


<a
    href="{{ route('frontend.dashboard') }}"
    class="theme-accent-bg rounded-xl px-6 py-3 font-semibold text-white shadow-lg transition hover:opacity-90 hover:shadow-xl"
>
    📊 Open Frontend Dashboard
</a>


<a
    href="{{ route('frontend.dashboard.export') }}"
    class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white transition hover:bg-green-700"
>
    📥 Export Report
</a>


<a
    href="https://laravel.com/docs"
    target="_blank"
    rel="noopener noreferrer"
    class="rounded-xl bg-slate-800 px-6 py-3 font-semibold text-white transition hover:bg-slate-900"
>
    Laravel Documentation
</a>


</div>



<!-- Theme Button -->

<div class="mt-6">

    <button
        type="button"
        id="themeToggle"
        class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold transition hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800"
    >

        <span id="themeIcon">
            🌙
        </span>

        Toggle Dark Mode

    </button>

</div>



<p
    class="mt-8 text-xs text-slate-400"
>
    Laravel 12 · Vite · Tailwind CSS · Node.js
</p>


</div>

</main>


</body>

</html>