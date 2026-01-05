<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - LENGSTORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-950 text-white" x-data="{ open: false }">
    <aside
        class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0 bg-slate-900 border-r border-slate-800"
        :class="open ? 'translate-x-0' : '-translate-x-full'">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-blue-500 italic">LENG<span class="text-white">STORE</span></h1>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="block p-3 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 font-bold' : 'text-slate-400 hover:text-white' }}">
                Dashboard Stats
            </a>
            <a href="{{ route('admin.products.index') }}"
                class="block p-3 rounded-lg text-sm {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 font-bold' : 'text-slate-400 hover:text-white' }}">
                Kelola Produk
            </a>
            <hr class="border-slate-800 my-4">
            <a href="/" class="block p-3 text-slate-400 hover:text-white text-sm">Kembali ke Web</a>
        </nav>
    </aside>

    <div class="lg:ml-64">
        <header class="p-4 bg-slate-900 border-b border-slate-800 flex items-center lg:hidden">
            <button @click="open = true" class="p-2 bg-slate-800 rounded">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </header>
        <main class="p-8">
            @yield('content')
        </main>
    </div>
</body>

</html>
