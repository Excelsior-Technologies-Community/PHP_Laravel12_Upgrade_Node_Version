# PHP_Laravel12_Upgrade_Node_Version


<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/Node.js-20_LTS-339933?style=for-the-badge&logo=node.js&logoColor=white" />
  <img src="https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" />
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
  <img src="https://img.shields.io/badge/Platform-Windows_PowerShell-0078D6?style=for-the-badge&logo=windows&logoColor=white" />
  <img src="https://img.shields.io/badge/Status-Node_Upgraded_&_Working-success?style=for-the-badge" />
</p>

##  Overview


It focuses on upgrading to **Node.js 18/20 (LTS)** and configuring a modern frontend stack using **Vite 5** and **Tailwind CSS 3**, ensuring better performance, compatibility, and long-term maintainability.

---

##  Features

* Laravel **12.x** compatible frontend setup
* Node.js **18 / 20 (LTS)** support
* Vite **5** for fast builds and hot module replacement (HMR)
* Tailwind CSS **3** integration
* Clean removal of old Node dependencies
* Modern `package.json` configuration
* Windows CMD / PowerShell friendly
* Production-ready frontend workflow

---

## Folder Structure

```text
laravel12/
├── app/
├── bootstrap/
├── config/
├── public/
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       └── welcome.blade.php
├── routes/
├── storage/
├── node_modules/
├── tailwind.config.js
├── postcss.config.js
├── vite.config.js
├── package.json
└── .env
```

---

---

## Step 1: System Requirements

Make sure the following are installed on your system:

* PHP 8.2+
* Composer
* Node.js 18 or 20 (LTS)
* npm 9+

Check versions:

```bash
php -v
node -v
npm -v
composer -V
```

---

## Step 2: Create New Laravel 12 Project

```bash
composer create-project laravel/laravel laravel12
```

---

## Step 3: Start Laravel Development Server

```bash
php artisan serve
```

➡️ Open browser:

```
http://127.0.0.1:8000
```

---

## Step 4: Remove Old Dependencies (IMPORTANT)

Old dependencies can cause version conflicts after upgrading Node.

**PowerShell (Windows):**

```powershell
Remove-Item node_modules -Recurse -Force
Remove-Item package-lock.json -Force
```

---

## Step 5: Update Frontend Dependencies for Laravel 12

Laravel 12 works best with Vite 5 and modern packages.

**package.json**

```json
{
    "private": true,
    "type": "module",
    "scripts": {
        "dev": "vite",
        "build": "vite build"
    },
    "devDependencies": {
        "autoprefixer": "^10.4.23",
        "axios": "^1.11.0",
        "laravel-vite-plugin": "^2.0.0",
        "postcss": "^8.5.6",
        "tailwindcss": "^3.4.19",
        "vite": "^5.4.0"
    }
}
```

---

## Step 6: Install Frontend Dependencies

```bash
npm install
```

---

## Step 7: Install Tailwind CSS (Required for CLI)

```bash
npm install -D tailwindcss postcss autoprefixer
```

---

## Step 8: Generate Tailwind & PostCSS Config

```bash
npx tailwindcss init -p
```

Creates:

* tailwind.config.js
* postcss.config.js

---

## Step 9: Configure Tailwind

tailwind.config.js
```js
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}
```

---

## Step 10: Configure PostCSS

postcss.config.js
```js
export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
}
```

---

## Step 11: Add Tailwind Directives

resources/css/app.css
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

---

## Step 12: Configure Vite

vite.config.js
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
```

---

## Step 13: JavaScript Entry File

resources/js/app.js
```js
import './bootstrap';
```

---

## Step 14: Update Welcome Page

resources/views/welcome.blade.php
```blade
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

```

---

## Step 15: Clear Cache

```bash
php artisan optimize:clear
```

---

## Step 16: Run Development Servers

**Terminal 1 (Vite)**

```bash
npm run dev
```

**Terminal 2 (Laravel)**

```bash
php artisan serve
```

---

## OUTPUT

<img width="1919" height="996" alt="Screenshot 2026-01-05 115558" src="https://github.com/user-attachments/assets/3a7023c6-66b7-48d1-955c-004ea49a0fd8" />

