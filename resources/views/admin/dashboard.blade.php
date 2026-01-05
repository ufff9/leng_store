<x-app-layout>
    <style>
        body { background-color: #020617 !important; }
        nav { background-color: #0f172a !important; border-bottom: 1px solid #1e293b !important; }
    </style>

    <div class="py-6 md:py-12 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 text-center md:text-left">
                <h2 class="text-2xl md:text-3xl font-black text-white tracking-tight italic uppercase">
                    Admin <span class="text-blue-500">Dashboard</span>
                </h2>
                <p class="text-slate-400 text-sm md:text-base">Ringkasan performa toko Anda hari ini.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">

                <div class="bg-slate-900 border border-slate-800 p-5 md:p-6 rounded-3xl shadow-xl hover:border-blue-500/30 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-600/10 rounded-2xl">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-widest">Total Pendapatan</p>
                    <h3 class="text-xl md:text-2xl font-black text-white mt-1 leading-none">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-slate-900 border border-slate-800 p-5 md:p-6 rounded-3xl shadow-xl hover:border-purple-500/30 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-600/10 rounded-2xl">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-widest">Total Pesanan</p>
                    <h3 class="text-xl md:text-2xl font-black text-white mt-1">{{ $totalPesanan }}</h3>
                </div>

                <div class="bg-slate-900 border border-slate-800 p-5 md:p-6 rounded-3xl shadow-xl hover:border-amber-500/30 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-amber-600/10 rounded-2xl">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        @if($pesananPending > 0)
                            <span class="flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                            </span>
                        @endif
                    </div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-widest">Butuh Konfirmasi</p>
                    <h3 class="text-xl md:text-2xl font-black text-white mt-1">{{ $pesananPending }}</h3>
                </div>

                <div class="bg-slate-900 border border-slate-800 p-5 md:p-6 rounded-3xl shadow-xl hover:border-emerald-500/30 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-600/10 rounded-2xl">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-widest">Total Pelanggan</p>
                    <h3 class="text-xl md:text-2xl font-black text-white mt-1">{{ $totalUser }}</h3>
                </div>
            </div>

            <div class="bg-blue-600 rounded-3xl p-6 md:p-8 flex flex-col md:flex-row items-center justify-between shadow-2xl shadow-blue-600/20 gap-6">
                <div class="text-center md:text-left">
                    <h3 class="text-white text-lg md:text-xl font-bold">Siap memproses pesanan?</h3>
                    <p class="text-blue-100 opacity-80 text-sm">
                        Ada <span class="font-bold underline">{{ $pesananPending }} pesanan</span> baru yang menunggu konfirmasi Anda.
                    </p>
                </div>
                <a href="{{ route('admin.transactions') }}"
                    class="w-full md:w-auto bg-white text-blue-600 px-8 py-3 rounded-2xl font-bold hover:bg-blue-50 transition-all shadow-lg text-center active:scale-95">
                    Kelola Transaksi
                </a>
            </div>

        </div>
    </div>
</x-app-layout>