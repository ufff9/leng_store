<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { background-color: white !important; p: 0; }
            .no-print { display: none !important; }
            .print-shadow-none { shadow: none !important; border: 1px solid #e2e8f0; }
        }
        /* Efek dekorasi struk */
        .receipt-edge::before, .receipt-edge::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            height: 10px;
            background-size: 20px 20px;
        }
    </style>
</head>

<body class="bg-slate-900 text-white p-4 md:p-10 font-sans">
    
    <div class="max-w-md mx-auto bg-white text-slate-900 p-6 md:p-8 rounded-2xl shadow-2xl relative overflow-hidden print-shadow-none">
        
        <div class="absolute top-0 right-0 bg-blue-600 text-white px-5 py-1.5 text-[10px] font-black uppercase tracking-widest rounded-bl-xl shadow-lg">
            {{ $transaction->status }}
        </div>

        <div class="mt-4">
            <h2 class="text-2xl font-black mb-1 text-blue-600 tracking-tighter">INVOICE TOPUP</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">
                No. Transaksi: #TRX-{{ $transaction->id }}{{ date('Ymd') }}
            </p>
        </div>

        <div class="my-6 border-t border-b border-dashed border-gray-300 py-6 space-y-3">
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500 uppercase font-bold text-[11px]">Nama Game</span>
                <span class="font-black text-slate-800 uppercase">{{ $transaction->product->category->name }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500 uppercase font-bold text-[11px]">Item</span>
                <span class="font-black text-slate-800">{{ $transaction->product->amount }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500 uppercase font-bold text-[11px]">ID Pemain</span>
                <span class="font-mono font-black text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $transaction->user_id_game }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500 uppercase font-bold text-[11px]">Metode</span>
                <span class="font-black text-slate-800 uppercase">{{ $transaction->payment_method ?? 'Transfer' }}</span>
            </div>
        </div>

        <div class="flex justify-between items-center mb-8 bg-slate-50 p-4 rounded-xl border border-slate-100">
            <span class="text-gray-500 font-bold text-xs uppercase tracking-tight">Total Tagihan</span>
            <span class="text-2xl font-black text-slate-900">Rp {{ number_format($transaction->product->price) }}</span>
        </div>

        <div class="bg-blue-600 p-4 rounded-xl mb-8 text-white shadow-md shadow-blue-200">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-[10px] font-black uppercase tracking-widest">Informasi Pembayaran</p>
            </div>
            <p class="text-xs leading-relaxed opacity-90 mb-2">Silahkan selesaikan pembayaran sesuai metode yang dipilih. Konfirmasi otomatis akan diproses dalam 1-5 menit.</p>
            <div class="text-[11px] font-mono bg-blue-700/50 p-2 rounded border border-blue-400/30">
                WA Konfirmasi: {{ $transaction->whatsapp }}
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 no-print">
            <a href="/" class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-600 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all">
                Ke Beranda
            </a>
            <button onclick="window.print()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-200">
                Cetak PDF
            </button>
        </div>

        <div class="mt-8 text-center">
            <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">Terima kasih telah berbelanja</p>
            <div class="flex justify-center gap-1 mt-2">
                <div class="w-1 h-1 bg-gray-200 rounded-full"></div>
                <div class="w-1 h-1 bg-gray-200 rounded-full"></div>
                <div class="w-1 h-1 bg-gray-200 rounded-full"></div>
            </div>
        </div>
    </div>

    <div class="max-w-md mx-auto mt-6 text-center no-print">
        <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Butuh bantuan? Hubungi CS kami</p>
    </div>

</body>
</html>