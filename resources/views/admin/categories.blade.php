<x-app-layout>
    <div class="py-6 md:py-12 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 text-center lg:text-left">
                <h2 class="text-2xl md:text-3xl font-black text-white italic uppercase tracking-tighter">
                    Kelola <span class="text-blue-500">Kategori Game</span>
                </h2>
                <p class="text-slate-400 text-sm mt-1">Tambahkan logo dan nama game untuk mempercantik tampilan toko
                    Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1 order-2 lg:order-1">
                    <div class="bg-slate-900 border border-slate-800 p-6 rounded-3xl shadow-2xl lg:sticky lg:top-24">
                        <h3 class="text-white font-bold mb-6 flex items-center gap-2 text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tambah Game Baru
                        </h3>

                        <form action="{{ route('admin.categories.store') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            <div>
                                <label
                                    class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block">Nama
                                    Game</label>
                                <input type="text" name="name" required placeholder="Contoh: Valorant"
                                    class="w-full bg-slate-800 border-slate-700 text-white rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none">
                                @error('name')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block">Logo
                                    Game</label>
                                <input type="file" name="image" required
                                    class="w-full bg-slate-800 border-slate-700 text-slate-400 rounded-2xl px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer text-sm">
                                <p class="text-[10px] text-slate-500 mt-2 italic">*Gunakan format PNG/JPG (Maks 2MB)</p>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-900/20 transition-all transform active:scale-95 uppercase italic tracking-wider">
                                Simpan Data Game
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2 order-1 lg:order-2">
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">

                        <div class="hidden md:block">
                            <table class="w-full text-left">
                                <thead>
                                    <tr
                                        class="bg-slate-800/50 border-b border-slate-800 text-slate-400 uppercase tracking-widest text-[10px] font-black">
                                        <th class="px-6 py-4">Informasi Game</th>
                                        <th class="px-6 py-4 text-center">Statistik</th>
                                        <th class="px-6 py-4 text-right">Manajemen</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800">
                                    @forelse($categories as $cat)
                                        <tr class="hover:bg-slate-800/40 transition-colors group">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-4">
                                                    <div class="h-14 w-14 flex-shrink-0">
                                                        @if ($cat->image)
                                                            <img src="{{ asset('uploads/categories/' . $cat->image) }}"
                                                                class="h-full w-full object-cover rounded-2xl border border-slate-700 shadow-lg group-hover:scale-110 transition-transform">
                                                        @else
                                                            <div
                                                                class="h-full w-full rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-500 font-black text-xl border border-blue-500/20 uppercase">
                                                                {{ substr($cat->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <span
                                                        class="text-white font-black text-lg tracking-tight">{{ $cat->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-center">
                                                <span
                                                    class="bg-emerald-500/10 text-emerald-500 text-[10px] font-black px-4 py-1.5 rounded-full border border-emerald-500/20 italic uppercase">
                                                    {{ $cat->products_count ?? 0 }} Produk
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-right">
                                                <div class="flex justify-end gap-2">
                                                    <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                                        class="p-2 text-slate-500 hover:text-blue-500 hover:bg-blue-500/10 rounded-xl transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                                                        method="POST" onsubmit="return confirm('Hapus game ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 text-slate-500 hover:text-red-500 hover:bg-red-500/10 rounded-xl transition-all">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
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
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="md:hidden divide-y divide-slate-800">
                            @forelse($categories as $cat)
                                <div class="p-4 flex items-center justify-between group">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 flex-shrink-0">
                                            @if ($cat->image)
                                                <img src="{{ asset('uploads/categories/' . $cat->image) }}"
                                                    class="h-full w-full object-cover rounded-xl border border-slate-700">
                                            @else
                                                <div
                                                    class="h-full w-full rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 font-bold uppercase text-sm border border-blue-500/20">
                                                    {{ substr($cat->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="text-white font-bold text-sm">{{ $cat->name }}</h4>
                                            <span
                                                class="text-[9px] text-emerald-500 font-bold uppercase tracking-tighter">
                                                {{ $cat->products_count ?? 0 }} Produk Ready
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex gap-1">
                                        <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                            class="p-2 text-slate-400 bg-slate-800 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                                            method="POST" onsubmit="return confirm('Hapus game ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 bg-red-500/10 rounded-lg border border-red-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-12 text-center">
                                    <p class="text-slate-500 text-xs italic">Belum ada kategori game.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
