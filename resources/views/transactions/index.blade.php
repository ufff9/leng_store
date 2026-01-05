<x-app-layout>
    <div class="py-6 md:py-12 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight uppercase">
                        Riwayat <span class="text-blue-500">Belanja</span>
                    </h2>
                    <p class="text-slate-400 mt-1 text-xs md:text-sm">Pantau status pengiriman diamond dan pesanan Anda.
                    </p>
                </div>

                <div
                    class="bg-slate-900 border border-slate-800 px-5 py-3 rounded-2xl shadow-xl flex items-center justify-between md:block">
                    <div>
                        <p class="text-[9px] md:text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">
                            Total Berhasil</p>
                        <p class="text-xl md:text-2xl font-black text-emerald-500">
                            {{ $totalBerhasil }}
                            <span class="text-[10px] md:text-sm text-slate-400 font-medium lowercase">Pesanan</span>
                        </p>
                    </div>
                    <div class="md:hidden">
                        <div class="p-2 bg-emerald-500/10 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 overflow-hidden shadow-2xl rounded-2xl md:rounded-3xl">

                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-800/50 text-slate-500 text-[11px] uppercase font-black tracking-[0.2em] border-b border-slate-800">
                                <th class="px-6 py-5">Detail Akun</th>
                                <th class="px-6 py-5">Produk</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($transactions as $trx)
                                <tr class="hover:bg-blue-500/[0.02] transition-all group">
                                    <td class="px-6 py-6">
                                        <div
                                            class="font-black text-blue-400 font-mono tracking-tighter text-sm uppercase">
                                            ID: {{ $trx->user_id_game }}</div>
                                        <div class="text-[10px] text-slate-500 mt-1 font-medium italic">WA:
                                            {{ $trx->whatsapp }}</div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight">
                                            {{ $trx->product->category->name ?? 'N/A' }}</div>
                                        <div class="text-[11px] text-blue-300/80 font-bold mt-0.5">
                                            {{ $trx->product->amount ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <span
                                            class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider border {{ $trx->status == 'success' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($trx->status == 'failed' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20') }}">
                                            {{ $trx->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <form action="{{ route('admin.transactions.destroy', $trx->id) }}"
                                            method="POST" onsubmit="return confirm('Hapus riwayat?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-rose-500 hover:text-white border border-rose-500/30 hover:bg-rose-500 px-4 py-2 rounded-xl text-[10px] font-black uppercase transition-all">Hapus</button>
                                        </form>
                                        <div class="text-[9px] text-slate-600 mt-2 uppercase tracking-tighter">
                                            {{ $trx->created_at->format('d/m/Y H:i') }}</div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden divide-y divide-slate-800">
                    @forelse($transactions as $trx)
                        <div class="p-5 space-y-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">
                                        {{ $trx->product->category->name ?? 'Game' }}</p>
                                    <h3 class="text-white font-bold text-base uppercase leading-tight">
                                        {{ $trx->product->amount ?? 'Item' }}</h3>
                                </div>
                                <span
                                    class="px-2.5 py-1 rounded-md text-[9px] font-black uppercase border {{ $trx->status == 'success' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($trx->status == 'failed' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20') }}">
                                    {{ $trx->status }}
                                </span>
                            </div>

                            <div
                                class="bg-slate-950/50 rounded-xl p-3 border border-slate-800 flex justify-between items-center">
                                <div>
                                    <p class="text-[8px] text-slate-500 uppercase font-bold mb-0.5">ID Game</p>
                                    <p class="text-xs font-mono text-slate-200 font-bold">{{ $trx->user_id_game }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[8px] text-slate-500 uppercase font-bold mb-0.5">Tanggal</p>
                                    <p class="text-[10px] text-slate-400">{{ $trx->created_at->format('d M, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <form action="{{ route('admin.transactions.destroy', $trx->id) }}" method="POST"
                                    class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-full py-2.5 bg-rose-500/10 hover:bg-rose-500 text-rose-500 hover:text-white border border-rose-500/20 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                        Hapus Log
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-20 text-center">
                            <div class="inline-flex p-4 rounded-full bg-slate-800/50 mb-4">
                                <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Kosong</p>
                            <a href="/dashboard"
                                class="mt-4 inline-block text-blue-500 text-[10px] font-black uppercase hover:underline">Mulai
                                Belanja &rarr;</a>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
