<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12 bg-slate-950">

        <div class="mb-8 text-center">
            <a href="/" class="flex flex-col items-center group">
                <div
                    class="bg-blue-600 p-3 rounded-2xl shadow-xl shadow-blue-600/20 mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-black italic tracking-tighter">
                    <span class="text-blue-500 uppercase">LENG</span><span class="text-white uppercase">STORE</span>
                </h1>
                <p class="text-slate-500 text-sm font-medium mt-1">Buat akun baru untuk mulai top-up</p>
            </a>
        </div>

        <div class="w-full sm:max-w-md bg-slate-900 border border-slate-800 p-8 rounded-[2.5rem] shadow-2xl">

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name"
                        class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-[0.2em] ml-1">
                        Nama Lengkap
                    </label>
                    <div class="relative group">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            autocomplete="name"
                            class="w-full bg-slate-800/50 border-slate-700 rounded-2xl text-white pl-12 pr-4 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-600"
                            placeholder="Nama Anda">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="email"
                        class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-[0.2em] ml-1">
                        Alamat Email
                    </label>
                    <div class="relative group">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" :value="old('email')" required
                            autocomplete="username"
                            class="w-full bg-slate-800/50 border-slate-700 rounded-2xl text-white pl-12 pr-4 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-600"
                            placeholder="email@contoh.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="password"
                        class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-[0.2em] ml-1">
                        Kata Sandi
                    </label>
                    <div class="relative group">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full bg-slate-800/50 border-slate-700 rounded-2xl text-white pl-12 pr-4 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-600"
                            placeholder="Minimal 8 karakter">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-[0.2em] ml-1">
                        Konfirmasi Sandi
                    </label>
                    <div class="relative group">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fa-solid fa-shield-check"></i>
                        </span>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password"
                            class="w-full bg-slate-800/50 border-slate-700 rounded-2xl text-white pl-12 pr-4 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-600"
                            placeholder="Ulangi sandi">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-blue-600/20 active:scale-[0.98] uppercase text-sm tracking-widest">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <p class="text-center mt-8 text-sm text-slate-500 font-medium">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="text-blue-500 hover:text-blue-400 font-bold decoration-2 underline-offset-4">Masuk di
                    sini</a>
            </p>
        </div>
    </div>
</x-guest-layout>
