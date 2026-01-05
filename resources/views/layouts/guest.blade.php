<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
        style="background-color: #020617 !important;">

        <div class="mb-6">
            <a href="/">
                @if (file_exists(public_path('storage/logo.png')))
                    <img src="{{ asset('images/dana.png') }}" alt="Logo" class="w-24 h-24 object-contain">
                @else
                    <h1 class="text-4xl font-black tracking-tighter text-blue-500 uppercase">
                        LENG<span class="text-white">STORE</span>
                    </h1>
                @endif
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-8 bg-[#0f172a] shadow-2xl border border-slate-800 overflow-hidden sm:rounded-xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
