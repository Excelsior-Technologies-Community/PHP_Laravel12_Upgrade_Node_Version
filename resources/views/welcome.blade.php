<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Load compiled CSS & JS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <!-- Main card -->
    <div class="bg-white shadow-lg rounded-lg p-10 text-center max-w-md w-full">

        <!-- Heading -->
        <h1 class="text-4xl font-bold text-red-600 mb-4">
            Laravel 12
        </h1>

        <!-- Description -->
        <p class="text-gray-600 mb-6">
            Laravel 12 + Vite 5 + Tailwind CSS 3 successfully running 🚀
        </p>

        <!-- Buttons -->
        <div class="flex justify-center gap-4">
            <a href="https://laravel.com/docs"
               class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                Documentation
            </a>

            <a href="https://laracasts.com"
               class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition">
                Laracasts
            </a>
        </div>

    </div>

</body>
</html>
