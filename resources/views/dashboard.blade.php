<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LengStore - Top Up Cepat & Aman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #020617;
        }

        [x-cloak] {
            display: none !important;
        }

        .logo-hover {
            transition: all 0.3s ease;
        }

        .logo-hover:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.5));
        }

        .card-img-container {
            aspect-ratio: 1 / 1.3;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="text-white font-sans antialiased" x-data="{ mobileMenu: false }">

    <nav class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-[1600px] mx-auto px-3 md:px-6">
            <div class="flex justify-between h-14 md:h-16 items-center">
                <a href="/dashboard" class="logo-hover flex items-center group">
                    <div class="bg-blue-600 p-1.5 rounded-lg shadow-lg shadow-blue-600/30 mr-2 md:mr-3">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="text-lg md:text-2xl font-black tracking-tighter italic leading-none">
                        <span class="text-blue-500 uppercase">LENG</span><span class="text-white uppercase">STORE</span>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('transactions.index') }}"
                            class="text-[10px] font-black tracking-widest text-blue-400 bg-blue-500/10 border border-blue-500/20 px-3 py-1.5 rounded-lg hover:bg-blue-500/20 transition-all uppercase">
                            Cek Pesanan
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="text-[10px] font-black tracking-widest text-red-400 hover:text-red-300 uppercase">Log
                                Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] text-slate-400 font-bold uppercase">Log in</a>
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 px-4 py-2 rounded-lg text-[10px] font-black uppercase">Daftar</a>
                    @endauth
                </div>

                <div class="md:hidden">
                    <button @click="mobileMenu = !mobileMenu"
                        class="text-slate-400 p-2 transition-colors hover:text-white">
                        <i class="fa-solid" :class="mobileMenu ? 'fa-xmark text-2xl' : 'fa-bars-staggered text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenu" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden bg-slate-900 border-b border-slate-800 absolute w-full left-0 z-40 shadow-2xl">
            <div class="px-4 py-6 space-y-4">
                @auth
                    <div class="border-b border-slate-800 pb-4 mb-4">
                        <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Akun Saya</p>
                        <p class="font-bold text-blue-400">{{ Auth::user()->name }}</p>
                    </div>
                    <a href="{{ route('transactions.index') }}"
                        class="block w-full text-center bg-blue-500/10 border border-blue-500/20 text-blue-400 py-3 rounded-xl font-bold uppercase text-xs">
                        <i class="fa-solid fa-receipt mr-2"></i> Cek Pesanan
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="block w-full text-center bg-red-500/10 border border-red-500/20 text-red-400 py-3 rounded-xl font-bold uppercase text-xs">
                            <i class="fa-solid fa-power-off mr-2"></i> Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full text-center text-slate-400 font-bold uppercase text-xs py-3 border border-slate-800 rounded-xl">Log
                        In</a>
                    <a href="{{ route('register') }}"
                        class="block w-full text-center bg-blue-600 text-white py-3 rounded-xl font-bold uppercase text-xs shadow-lg shadow-blue-600/20">Daftar
                        Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    <header class="py-6 md:py-12 px-4 text-center">
        <h1 class="text-xl md:text-4xl font-black tracking-tight uppercase">
            Top Up <span class="text-blue-500 italic">Game</span>
        </h1>
    </header>

    <main class="max-w-[1600px] mx-auto px-2 md:px-6 pb-20">
        <div class="flex items-center space-x-2 mb-4 md:mb-6 px-1">
            <div class="h-5 w-1 bg-blue-600 rounded-full shadow-[0_0_10px_rgba(37,99,235,0.5)]"></div>
            <h2 class="text-sm md:text-xl font-black uppercase tracking-wide">Daftar Game</h2>
        </div>

        <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-8 gap-1.5 md:gap-4">
            @forelse ($categories as $item)
                <a href="{{ route('order', $item->id) }}"
                    class="group relative bg-slate-900 rounded-lg md:rounded-2xl overflow-hidden border border-slate-800 transition-all duration-300 hover:border-blue-500/50 shadow-sm">

                    <div class="card-img-container overflow-hidden relative bg-gray-400 p-1 rounded-lg">
                        <img src="{{ asset('uploads/categories/' . $item->image) }}" alt="{{ $item->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <div
                            class="absolute top-0.5 right-0.5 bg-blue-600 text-[6px] md:text-[9px] font-black px-1 py-0.5 rounded shadow-lg backdrop-blur-md">
                            INSTAN
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80">
                        </div>
                    </div>

                    <div class="p-1.5 md:p-3 text-center">
                        <h3
                            class="font-bold text-[8px] md:text-xs text-slate-200 group-hover:text-blue-400 transition-colors uppercase truncate leading-tight">
                            {{ $item->name }}
                        </h3>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-10 opacity-50 text-xs italic font-medium">Belum ada game
                    tersedia.</div>
            @endforelse
        </div>
    </main>

    <footer class="py-8 text-center border-t border-slate-900 opacity-60">
        <div class="text-xs font-black text-blue-500 uppercase tracking-tighter">LENGSTORE</div>
        <p class="text-[7px] font-bold tracking-[0.3em] mt-1 uppercase">&copy; 2025 LENGSTORE OFFICIAL</p>
    </footer>

</body>

</html>
