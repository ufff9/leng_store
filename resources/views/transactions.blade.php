{{-- <x-admin-layout>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">Kelola Transaksi</h2>
            <p class="text-slate-500 text-sm md:text-base">Daftar semua pesanan masuk.</p>
        </div>

        @if (auth()->user()->is_admin)
            <form action="{{ route('transactions.reset') }}" method="POST"
                onsubmit="return confirm('PERINGATAN: Kosongkan semua data transaksi?')">
                @csrf
                <button type="submit"
                    class="text-[10px] text-red-500 border border-red-500/30 px-4 py-2 rounded-full hover:bg-red-500 hover:text-white transition uppercase font-bold w-full sm:w-auto text-center">
                    Reset Semua Data
                </button>
            </form>
        @endif
    </div>

    <form action="{{ route('admin.transactions') }}" method="GET" class="mb-6 flex flex-col sm:flex-row gap-3">
        <div class="relative flex-grow">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">
                <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </span>
            <input type="text" name="search" placeholder="Cari Pelanggan atau ID Game..."
                value="{{ request('search') }}"
                class="bg-slate-900 border border-slate-800 rounded-xl pl-10 pr-4 py-3 w-full text-sm text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
        </div>
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-900/20 active:scale-95">
            Cari
        </button>
    </form>

    <div class="bg-slate-900 border border-slate-800 rounded-[2rem] overflow-hidden shadow-2xl">
        <div class="overflow-x-auto overflow-y-hidden">
            <table class="w-full text-left border-collapse">
                <thead
                    class="bg-slate-800/50 text-slate-500 text-[10px] uppercase font-bold tracking-widest border-b border-slate-800">
                    <tr>
                        <th class="p-4 md:p-6 text-center w-12 hidden md:table-cell">#</th>
                        <th class="p-4 md:p-6">Detail Pelanggan</th>
                        <th class="p-4 md:p-6 hidden sm:table-cell">Produk</th>
                        <th class="p-4 md:p-6">Status</th>
                        <th class="p-4 md:p-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @forelse ($transactions as $trx)
                        <tr class="hover:bg-slate-800/30 transition group">
                            <td class="p-4 md:p-6 text-center text-slate-600 text-xs hidden md:table-cell">
                                {{ $loop->iteration }}
                            </td>

                            <td class="p-4 md:p-6">
                                <div class="flex flex-col">
                                    <span
                                        class="font-bold text-white text-sm md:text-base mb-0.5">{{ $trx->user->name ?? 'Guest' }}</span>
                                    <div class="flex items-center gap-1.5">
                                        <span
                                            class="text-[10px] bg-blue-500/10 text-blue-400 px-2 py-0.5 rounded-md font-mono">
                                            ID: {{ $trx->user_id_game }}
                                        </span>
                                    </div>
                                    <div class="sm:hidden mt-2">
                                        <p class="text-xs text-slate-400">{{ $trx->product->category->name }}
                                            ({{ $trx->product->amount }})</p>
                                    </div>
                                </div>
                            </td>

                            <td class="p-4 md:p-6 hidden sm:table-cell">
                                <div class="text-sm font-semibold text-slate-200">{{ $trx->product->category->name }}
                                </div>
                                <div class="text-[10px] text-slate-500 mt-0.5 tracking-wider uppercase font-medium">
                                    {{ $trx->product->amount }}</div>
                            </td>

                            <td class="p-4 md:p-6">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter italic {{ $trx->status == 'success' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full mr-1.5 animate-pulse {{ $trx->status == 'success' ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
                                    {{ $trx->status }}
                                </span>
                            </td>

                            <td class="p-4 md:p-6 text-right">
                                @if (auth()->user()->is_admin)
                                    @if ($trx->status == 'pending')
                                        <form action="{{ route('transactions.updateStatus', $trx->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-500 text-white px-3 md:px-5 py-2 rounded-xl text-[10px] font-black uppercase transition-all shadow-lg shadow-blue-900/40 active:scale-90 flex items-center gap-2">
                                                <i class="fa-solid fa-check-double"></i>
                                                <span class="hidden md:inline">Konfirmasi</span>
                                            </button>
                                        </form>
                                    @else
                                        <span
                                            class="inline-flex items-center text-slate-500 text-[10px] font-bold border border-slate-800 px-3 py-1.5 rounded-lg bg-slate-800/50">
                                            <i class="fa-solid fa-circle-check mr-2 text-green-500"></i> TERKIRIM
                                        </span>
                                    @endif
                                @else
                                    <span class="text-slate-500 text-[10px] italic">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-16 text-center">
                                <div class="flex flex-col items-center justify-center opacity-30">
                                    <i class="fa-solid fa-inbox text-5xl mb-4 text-slate-500"></i>
                                    <p class="text-slate-500 italic font-medium">Belum ada transaksi masuk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>  --}}
