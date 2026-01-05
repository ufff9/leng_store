<nav x-data="{ open: false }" @click.outside="open = false"
    class="bg-slate-900 backdrop-blur-xl border-b border-slate-800 sticky top-0 z-50 shadow-2xl shadow-blue-500/5">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->check() ? route('dashboard') : url('/') }}"
                        class="logo-hover flex items-center group">
                        <div class="bg-blue-600 p-2 rounded-lg shadow-lg shadow-blue-600/30 mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <div class="text-xl md:text-2xl font-black tracking-tighter italic">
                            <span class="text-blue-500 uppercase">LENG</span><span
                                class="text-white uppercase">STORE</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                            class="text-blue-400 font-bold hover:text-blue-300">
                            <span
                                class="flex items-center px-3 py-1 bg-blue-500/10 rounded-full border border-blue-500/20 shadow-inner">
                                <span class="relative flex h-2 w-2 mr-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                {{ __('Dashboard Admin') }}
                            </span>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.transactions')" :active="request()->routeIs('admin.transactions')" class="text-slate-400 hover:text-white">
                            <i class="fa-solid fa-list-check mr-2"></i> {{ __('Kelola Pesanan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="text-slate-400 hover:text-white">
                            <i class="fa-solid fa-box mr-2"></i> {{ __('Kelola Produk') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="text-slate-400 hover:text-white">
                            <i class="fa-solid fa-gamepad mr-2"></i> {{ __('Kelola Game') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-4 py-2 border border-slate-700/50 text-sm font-medium rounded-xl text-slate-300 bg-slate-800/40 hover:bg-slate-800 hover:text-white hover:border-blue-500/50 focus:outline-none transition-all duration-300 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-7 h-7 rounded-lg bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center text-white text-[10px] font-bold shadow-lg shadow-blue-500/20">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold">{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ms-2 h-4 w-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-1 bg-slate-900 border border-slate-800 rounded-md">
                            @if (Auth::user()->role === 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')"
                                    class="rounded-lg text-slate-400 hover:bg-blue-500/10">
                                    <i class="fa-solid fa-gauge-high mr-2"></i> {{ __('Admin Panel') }}
                                </x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-lg text-slate-400 hover:bg-slate-800">
                                <i class="fa-solid fa-user-gear mr-2"></i> {{ __('Profile Settings') }}
                            </x-dropdown-link>
                            <div class="border-t border-slate-800 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="rounded-lg text-red-400 hover:bg-red-500/10"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa-solid fa-power-off mr-2"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-colors focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" d="M6 18L18 6M6 6l12 12"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="sm:hidden bg-slate-900 border-t border-slate-800 shadow-2xl overflow-hidden">

        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                    class="text-blue-400 font-bold bg-blue-500/5">
                    <i class="fa-solid fa-gauge-high mr-2"></i> {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.transactions')" :active="request()->routeIs('admin.transactions')" class="text-slate-300">
                    <i class="fa-solid fa-list-check mr-2"></i> {{ __('Kelola Pesanan') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="text-slate-300">
                    <i class="fa-solid fa-box mr-2"></i> {{ __('Kelola Produk') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="text-slate-300">
                    <i class="fa-solid fa-gamepad mr-2"></i> {{ __('Kelola Game') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1 border-t border-slate-800">

                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-300">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')" class="text-slate-300">
                    {{ __('Riwayat Belanja') }}
                </x-responsive-nav-link>

                @if (Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.transactions')" :active="request()->routeIs('admin.transactions')" class="text-blue-400 font-bold">
                        {{ __('Kelola Pesanan (Admin)') }}
                    </x-responsive-nav-link>
                @endif

            </div>

            <div class="pt-4 pb-1 border-t border-slate-800">
                <div class="px-4">
                    <div class="font-medium text-base text-slate-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();"
                            class="text-rose-500">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
