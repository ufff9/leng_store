<x-app-layout>
    <div class="py-6 md:py-12 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-8">
                <div class="bg-slate-900 border border-slate-800 p-5 md:p-6 rounded-3xl shadow-xl">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Total Sukses</p>
                    <h3 class="text-3xl md:text-4xl font-black text-emerald-500">{{ $totalBerhasilGlobal }}</h3>
                </div>
                <div class="bg-slate-900 border border-slate-800 p-5 md:p-6 rounded-3xl shadow-xl">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Antrean Pending</p>
                    <h3 class="text-3xl md:text-4xl font-black text-amber-500">{{ $totalPendingGlobal }}</h3>
                </div>
                <div
                    class="bg-slate-900 border border-slate-800 p-5 md:p-6 rounded-3xl shadow-xl sm:col-span-2 md:col-span-1">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Total Riwayat</p>
                    <h3 class="text-3xl md:text-4xl font-black text-blue-500">{{ $totalTrxGlobal }}</h3>
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 shadow-2xl rounded-3xl overflow-hidden">
                <div class="p-6 md:p-8 border-b border-slate-800 bg-slate-900/50">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight uppercase italic">
                                Konfirmasi <span class="text-blue-500">Pesanan</span>
                            </h2>
                            <p class="text-slate-400 mt-1 text-sm italic">Manajemen antrean transaksi masuk.</p>
                        </div>

                        <form action="{{ route('admin.transactions') }}" method="GET"
                            class="relative w-full md:w-auto">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Game ID / WA..."
                                class="bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-4 py-3 w-full md:w-72 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none">
                            <button type="submit"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px] md:min-w-full">
                        <thead>
                            <tr
                                class="bg-slate-950/50 text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-slate-800">
                                <th class="px-6 py-5 font-black">Transaksi</th>
                                <th class="px-6 py-5 font-black">Produk & Game</th>
                                <th class="px-6 py-5 font-black">Detail Akun</th>
                                <th class="px-6 py-5 font-black text-center">Status</th>
                                <th class="px-6 py-5 font-black text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse ($transactions as $trx)
                                <tr class="hover:bg-blue-500/[0.02] transition-all group">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span
                                            class="text-blue-500 font-mono text-[10px] font-bold block mb-1">#TRX-{{ $trx->id }}</span>
                                        <span
                                            class="text-white font-bold text-sm block">{{ $trx->user->name ?? 'Guest' }}</span>
                                    </td>

                                    <td class="px-6 py-6">
                                        <div class="flex flex-col">
                                            <h3 class="text-white font-bold text-sm tracking-tight">
                                                {{ $trx->product->amount ?? 'N/A' }}
                                            </h3>
                                            <span
                                                class="text-[9px] text-blue-400 font-black mt-1 bg-blue-500/10 px-2 py-0.5 rounded-full inline-block uppercase w-fit border border-blue-500/20">
                                                {{ $trx->product->category->name ?? 'Game' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="flex items-center text-white text-xs mb-1.5">
                                            <span class="text-slate-600 font-bold mr-2 uppercase text-[9px]">ID:</span>
                                            <span
                                                class="font-mono text-emerald-400 font-bold">{{ $trx->user_id_game }}</span>
                                        </div>
                                        <div class="flex items-center text-xs">
                                            <span class="text-slate-600 font-bold mr-2 uppercase text-[9px]">WA:</span>
                                            <a href="https://wa.me/{{ $trx->whatsapp }}" target="_blank"
                                                class="text-slate-300 hover:text-green-400 transition-colors underline decoration-slate-700 decoration-dotted underline-offset-4">
                                                {{ $trx->whatsapp }}
                                            </a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-6 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-[9px] font-black uppercase border 
                                            {{ $trx->status == 'success' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20' }}">
                                            {{ $trx->status }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-6">
                                        <div class="flex justify-end items-center gap-3">
                                            @if ($trx->status == 'pending')
                                                <form action="{{ route('admin.transactions.updateStatus', $trx->id) }}"
                                                    method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit"
                                                        class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all shadow-lg shadow-emerald-500/20">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.transactions.destroy', $trx->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus data transaksi ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-slate-600 hover:text-red-500 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-24 text-center">
                                        <div class="flex flex-col items-center opacity-20">
                                            <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="text-sm font-bold uppercase tracking-widest">Belum ada transaksi
                                                masuk</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
