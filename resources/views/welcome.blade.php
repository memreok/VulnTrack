<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'VulnTrack') }} - Hoş Geldiniz</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased font-sans bg-gray-100 dark:bg-gray-900">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
            <div class="max-w-2xl w-full mx-auto p-6 lg:p-8">

                <div class="flex justify-center mb-8">
                    <img src="{{ asset('images/favicon.png') }}" alt="{{ config('app.name', 'VulnTrack') }} Logo" class="h-40 w-auto">
                </div>

                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-800 dark:text-white sm:text-5xl">
                        {{ config('app.name', 'VulnTrack') }}
                    </h1>
                    <p class="mt-4 text-xl text-gray-600 dark:text-gray-400">
                        Güvenlik Açığı Takip Sistemine Hoş Geldiniz.
                    </p>
                </div>

                <div class="mt-10 flex justify-center">
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center px-8 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Giriş Yap
                    </a>
                </div>

                <div class="mt-16 flex justify-center text-sm text-gray-500 dark:text-gray-400">
                   &copy; {{ date('Y') }} {{ config('app.name', 'VulnTrack') }}. Tüm hakları saklıdır.
                </div>
            </div>
        </div>
    </body>
</html>
