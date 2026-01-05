<x-app-layout>
    <div class="py-6 md:py-12 bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center text-slate-400 hover:text-blue-500 transition-colors group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-sm font-bold uppercase tracking-widest">Kembali</span>
                </a>
            </div>
            <div class="bg-slate-900 border border-slate-800 p-6 md:p-8 rounded-3xl shadow-2xl">
                <h2 class="text-xl md:text-2xl font-black text-white mb-6 uppercase italic">
                    Edit <span class="text-blue-500">Game</span>
                </h2>

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf @method('PUT')

                    <div>
                        <label
                            class="text-[10px] md:text-xs font-bold text-slate-500 uppercase mb-2 block tracking-widest">Nama
                            Game</label>
                        <input type="text" name="name" value="{{ $category->name }}"
                            class="w-full bg-slate-800 border-slate-700 text-white rounded-2xl px-4 py-3 focus:border-blue-500 focus:ring-blue-500/20 transition-all outline-none">
                    </div>

                    <div>
                        <label
                            class="text-[10px] md:text-xs font-bold text-slate-500 uppercase mb-2 block tracking-widest">Logo
                            Saat Ini</label>
                        @if ($category->image)
                            <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                class="h-16 w-16 md:h-20 md:w-20 rounded-2xl mb-4 border border-slate-700 object-cover">
                        @endif
                        <input type="file" name="image"
                            class="w-full bg-slate-800 border-slate-700 text-slate-400 rounded-2xl px-4 py-2 text-sm
                            file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                            file:text-xs file:font-bold file:bg-blue-600 file:text-white
                            hover:file:bg-blue-500">
                    </div>

                    <div class="flex flex-col md:flex-row gap-3 md:gap-4 pt-2">
                        <button type="submit"
                            class="w-full md:flex-1 bg-blue-600 text-white font-black py-4 rounded-2xl uppercase italic hover:bg-blue-500 transition-all shadow-lg shadow-blue-600/20 text-sm md:text-base order-1">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.categories.index') }}"
                            class="w-full md:flex-1 bg-slate-800 text-white text-center font-black py-4 rounded-2xl uppercase italic hover:bg-slate-700 transition-all text-sm md:text-base order-2">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
