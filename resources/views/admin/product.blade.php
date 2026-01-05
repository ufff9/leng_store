<x-app-layout>
    <div class="py-12 bg-[#020617] min-h-screen text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-black uppercase tracking-tight">
                        Kelola <span class="text-blue-500">Produk</span>
                    </h2>
                </div>
                <div class="hidden md:block">
                    <span
                        class="bg-blue-500/10 text-blue-500 border border-blue-500/20 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest">
                        Admin Mode
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-4">
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sticky top-24">
                        <h3 class="text-lg font-bold mb-6 flex items-center">
                            <span class="bg-blue-600 w-2 h-6 rounded-full mr-3"></span>
                            Tambah Item Baru
                        </h3>

                        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">Pilih
                                    Kategori Game</label>
                                <select name="category_id"
                                    class="w-full bg-slate-800 border-slate-700 rounded-xl text-sm text-white focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">Nama
                                    Produk </label>
                                <input type="text" name="name" required
                                    class="w-full bg-slate-800 border-slate-700 rounded-xl text-sm text-white placeholder:text-slate-600 focus:ring-blue-500"
                                    placeholder="Contoh: 100 Diamonds">
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">Harga
                                    Jual (Rp)</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm font-bold">Rp</span>
                                    <input type="number" name="price" required
                                        class="w-full bg-slate-800 border-slate-700 rounded-xl text-sm text-white pl-12 focus:ring-blue-500"
                                        placeholder="15000">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-blue-600/20 uppercase text-xs tracking-widest">
                                Simpan Produk
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
                        <div class="p-6 border-b border-slate-800 bg-slate-800/30">
                            <h3 class="text-sm font-bold uppercase tracking-widest text-slate-300">Daftar Produk Aktif
                            </h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[800px] md:min-w-full">
                                <thead>
                                    <tr class="bg-slate-900">
                                        <th
                                            class="px-6 py-4 text-[10px] font-black uppercase text-slate-500 tracking-widest">
                                            Game</th>
                                        <th
                                            class="px-6 py-4 text-[10px] font-black uppercase text-slate-500 tracking-widest">
                                            Produk</th>
                                        <th
                                            class="px-6 py-4 text-[10px] font-black uppercase text-slate-500 tracking-widest">
                                            Harga</th>
                                        <th
                                            class="px-6 py-4 text-[10px] font-black uppercase text-slate-500 tracking-widest text-right">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800">
                                    @forelse($products as $product)
                                        <tr class="hover:bg-blue-500/[0.02] transition-colors group">
                                            <td class="px-6 py-4">
                                                <span
                                                    class="bg-blue-500/10 text-blue-400 text-[10px] font-black px-2 py-1 rounded-md uppercase">
                                                    {{ $product->category->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-sm font-bold text-slate-200 uppercase tracking-tighter">
                                                    {{ $product->amount }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-sm font-black text-white">Rp
                                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                            </td>
                                            <td class="p-4 flex gap-2 justify-end">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="p-2 bg-blue-500/10 text-blue-500 rounded-lg hover:bg-blue-500 hover:text-white transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus produk?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-12 text-center text-slate-500 text-sm italic">Belum ada
                                                produk yang ditambahkan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
