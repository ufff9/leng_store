<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12 bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('admin.products.index') }}"
                    class="inline-flex items-center text-slate-400 hover:text-blue-500 transition-colors group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-sm font-bold uppercase tracking-widest">Kembali</span>
                </a>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-6 md:p-8 border-b border-slate-800 bg-slate-800/30">
                    <h2 class="text-2xl md:text-3xl font-black text-white uppercase italic tracking-tight">
                        Edit <span class="text-blue-500">Layanan</span>
                    </h2>
                </div>

                <div class="p-6 md:p-8">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Kategori Game --}}
                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">
                                Kategori Game
                            </label>
                            <div class="relative">
                                <select name="category_id" required
                                    class="w-full bg-slate-800 border-slate-700 rounded-2xl text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent py-4 px-5 appearance-none transition-all">
                                    <option value="" disabled
                                        {{ is_null($product->category_id) ? 'selected' : '' }}>
                                        -- Pilih Kategori Game --
                                    </option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ ($product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Nama Produk --}}
                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">
                                Nama Produk (Diamonds/Item)
                            </label>
                            <input type="text" name="amount" value="{{ old('amount', $product->amount ?? '') }}"
                                required
                                class="w-full bg-slate-800 border-slate-700 rounded-2xl text-white placeholder:text-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent py-4 px-5 transition-all"
                                placeholder="Contoh: 50 Diamonds atau Weekly Pass">
                        </div>

                        {{-- Harga Jual --}}
                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">
                                Harga Jual
                            </label>
                            <div class="relative group">
                                <span
                                    class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 font-bold group-focus-within:text-blue-500 transition-colors">
                                    Rp
                                </span>
                                <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}"
                                    required
                                    class="w-full bg-slate-800 border-slate-700 rounded-2xl text-white pl-14 pr-5 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="0">
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="submit"
                                class="flex-1 bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-blue-600/20 active:scale-95 uppercase text-xs tracking-widest">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.products.index') }}"
                                class="flex-1 bg-slate-800 hover:bg-slate-700 text-slate-300 font-black py-4 rounded-2xl transition-all text-center uppercase text-xs tracking-widest">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
