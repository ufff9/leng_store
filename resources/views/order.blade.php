<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #0f172a;
        }

        /* Kustom Scrollbar untuk estetika */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1e293b;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
    </style>
</head>

<body class="text-white antialiased">
    <div class="max-w-6xl mx-auto px-4 py-8">

        <div class="mb-8">
            <a href="/dashboard"
                class="text-blue-400 hover:text-blue-300 mb-4 inline-flex items-center transition-all group">
                <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Kembali
            </a>
            <div class="flex items-center gap-4 mt-2">
                <div class="h-12 w-1.5 bg-blue-600 rounded-full"></div>
                <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tight">Top Up <span
                        class="text-blue-500">{{ $category->name }}</span></h1>
            </div>
        </div>

        <form action="{{ route('order.store') }}" method="POST" id="paymentForm">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-600 rounded-full text-sm font-bold">1</span>
                            <h2 class="text-xl font-bold">Lengkapi Data Akun</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-400 mb-2 ml-1">ID
                                    Pemain</label>
                                <input type="text" name="user_id_game" placeholder="Masukkan ID Game"
                                    class="w-full p-3.5 bg-slate-900/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"
                                    required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-400 mb-2 ml-1">Nomor
                                    WhatsApp</label>
                                <input type="text" name="whatsapp" placeholder="628xxxxxx"
                                    class="w-full p-3.5 bg-slate-900/50 border border-slate-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-600 rounded-full text-sm font-bold">2</span>
                            <h2 class="text-xl font-bold">Pilih Nominal Layanan</h2>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach ($category->products as $product)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="product_id" value="{{ $product->id }}"
                                        class="hidden peer" required>
                                    <div
                                        class="h-full p-4 bg-slate-900 border border-slate-700 rounded-xl flex flex-col justify-center text-center transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-600/10 peer-checked:ring-1 peer-checked:ring-blue-500 group-hover:border-slate-500">
                                        <div class="text-sm font-bold mb-1 peer-checked:text-blue-400">
                                            {{ $product->amount }}</div>
                                        <div class="text-xs text-slate-400 group-hover:text-blue-400 transition-colors">
                                            Rp {{ number_format($product->price) }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-xl sticky top-6">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-600 rounded-full text-sm font-bold">3</span>
                            <h2 class="text-xl font-bold">Metode Pembayaran</h2>
                        </div>

                        <div class="space-y-3">
                            <label class="cursor-pointer block group">
                                <input type="radio" name="payment_method" value="DANA" class="hidden peer" required>
                                <div
                                    class="p-3 bg-slate-900 border border-slate-700 rounded-xl flex items-center justify-between transition-all peer-checked:border-blue-500 peer-checked:bg-blue-600/10">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-white p-1 rounded-lg">
                                            <img src="{{ asset('images/dana.png') }}" alt="DANA"
                                                class="h-5 w-auto object-contain">
                                        </div>
                                        <span class="text-sm font-bold">DANA</span>
                                    </div>
                                    <div
                                        class="w-4 h-4 border-2 border-slate-600 rounded-full flex items-center justify-center peer-checked:border-blue-500">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer block group">
                                <input type="radio" name="payment_method" value="QRIS" class="hidden peer">
                                <div
                                    class="p-3 bg-slate-900 border border-slate-700 rounded-xl flex items-center justify-between transition-all peer-checked:border-blue-500 peer-checked:bg-blue-600/10">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-white p-1 rounded-lg">
                                            <img src="{{ asset('images/qris.png') }}" alt="QRIS"
                                                class="h-5 w-auto object-contain">
                                        </div>
                                        <span class="text-sm font-bold">QRIS</span>
                                    </div>
                                    <div
                                        class="w-4 h-4 border-2 border-slate-600 rounded-full flex items-center justify-center peer-checked:border-blue-500">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer block group">
                                <input type="radio" name="payment_method" value="QRIS" class="hidden peer">
                                <div
                                    class="p-3 bg-slate-900 border border-slate-700 rounded-xl flex items-center justify-between transition-all peer-checked:border-blue-500 peer-checked:bg-blue-600/10">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-white p-1 rounded-lg">
                                            <img src="{{ asset('images/ovo.png') }}" alt="QRIS"
                                                class="h-5 w-auto object-contain">
                                        </div>
                                        <span class="text-sm font-bold">OVO</span>
                                    </div>
                                    <div
                                        class="w-4 h-4 border-2 border-slate-600 rounded-full flex items-center justify-center peer-checked:border-blue-500">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer block group">
                                <input type="radio" name="payment_method" value="QRIS" class="hidden peer">
                                <div
                                    class="p-3 bg-slate-900 border border-slate-700 rounded-xl flex items-center justify-between transition-all peer-checked:border-blue-500 peer-checked:bg-blue-600/10">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-white p-1 rounded-lg">
                                            <img src="{{ asset('images/spay.png') }}" alt="QRIS"
                                                class="h-5 w-auto object-contain">
                                        </div>
                                        <span class="text-sm font-bold">SPAY</span>
                                    </div>
                                    <div
                                        class="w-4 h-4 border-2 border-slate-600 rounded-full flex items-center justify-center peer-checked:border-blue-500">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>
                            
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-700">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-500 py-4 rounded-xl font-black uppercase tracking-widest shadow-lg shadow-blue-600/20 transform active:scale-[0.98] transition-all">
                                Bayar Sekarang
                            </button>
                            <p class="text-[10px] text-center text-slate-500 mt-4 italic">
                                Layanan aktif 24 jam. Proses otomatis 1-5 menit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const userId = document.getElementsByName('user_id_game')[0].value;
            const wa = document.getElementsByName('whatsapp')[0].value;
            const payment = document.querySelector('input[name="payment_method"]:checked')?.value;
            const selectedProduct = document.querySelector('input[name="product_id"]:checked');

            if (!payment || !selectedProduct) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap pilih nominal dan metode pembayaran!',
                    background: '#1e293b',
                    color: '#fff'
                });
                return;
            }

            const nominalText = selectedProduct.parentElement.querySelector('.text-sm').innerText;

            Swal.fire({
                title: 'Konfirmasi Pesanan',
                html: `
                <div class="text-left bg-slate-900/50 p-4 rounded-xl border border-slate-700 text-sm">
                    <div class="flex justify-between mb-2"> <span class="text-slate-400">ID Game:</span> <span class="text-blue-400 font-bold">${userId}</span> </div>
                    <div class="flex justify-between mb-2"> <span class="text-slate-400">Produk:</span> <span class="font-bold">${nominalText}</span> </div>
                    <div class="flex justify-between mb-2"> <span class="text-slate-400">WhatsApp:</span> <span class="font-bold">${wa}</span> </div>
                    <div class="flex justify-between"> <span class="text-slate-400">Metode:</span> <span class="bg-blue-600 px-2 rounded text-[10px] font-bold">${payment}</span> </div>
                </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Bayar Sekarang',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#ef4444',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: '#1e293b',
                        color: '#fff',
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    this.submit();
                }
            });
        });
    </script>
</body>

</html>
