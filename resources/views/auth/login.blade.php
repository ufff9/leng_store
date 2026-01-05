<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 bg-slate-950">

        <div class="mb-6 md:mb-8 text-center w-full max-w-sm md:max-w-md">
            <a href="/" class="flex flex-col items-center group">
                <div
                    class="bg-blue-600 p-3 rounded-2xl shadow-xl shadow-blue-600/20 mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-black italic tracking-tighter">
                    <span class="text-blue-500 uppercase">LENG</span><span class="text-white uppercase">STORE</span>
                </h1>
                <p class="text-slate-500 text-xs md:text-sm font-medium mt-1">Silakan masuk ke akun Anda</p>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md bg-slate-900 border border-slate-800 p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl">

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5 md:space-y-6">
                @csrf

                <div>
                    <label for="email"
                        class="block text-[9px] md:text-[10px] font-black uppercase text-slate-500 mb-2 tracking-[0.2em] ml-1">
                        Alamat Email
                    </label>
                    <div class="relative group">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="w-full bg-slate-800/50 border-slate-700 rounded-xl md:rounded-2xl text-white pl-12 pr-4 py-3.5 md:py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-600 text-sm md:text-base"
                            placeholder="nama@email.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label for="password"
                            class="text-[9px] md:text-[10px] font-black uppercase text-slate-500 tracking-[0.2em]">
                            Kata Sandi
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-[9px] md:text-[10px] font-bold text-blue-500 hover:text-blue-400 uppercase tracking-wider transition-colors"
                                href="{{ route('password.request') }}">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative group">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full bg-slate-800/50 border-slate-700 rounded-xl md:rounded-2xl text-white pl-12 pr-4 py-3.5 md:py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-600 text-sm md:text-base"
                            placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-700 bg-slate-800 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-slate-900 transition-all">
                        <span
                            class="ms-2 text-xs md:text-sm text-slate-400 group-hover:text-slate-200 transition-colors">Ingat
                            saya</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-3.5 md:py-4 rounded-xl md:rounded-2xl transition-all shadow-lg shadow-blue-600/20 active:scale-[0.98] uppercase text-xs md:text-sm tracking-widest">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <p class="text-center mt-6 md:mt-8 text-xs md:text-sm text-slate-500 font-medium">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="text-blue-500 hover:text-blue-400 font-bold decoration-2 underline-offset-4 border-b border-transparent hover:border-blue-400 transition-all">Daftar
                    Gratis</a>
            </p>
        </div>
    </div>
</x-guest-layout>
