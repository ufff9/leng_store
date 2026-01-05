{{-- <x-admin-layout>
    <div class="py-6 md:py-12 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 text-center md:text-left">
                <h2 class="text-3xl font-extrabold text-white tracking-tight uppercase italic">
                    Dashboard <span class="text-blue-500">Stats</span>
                </h2>
                <p class="text-slate-500 text-sm">Ringkasan performa penjualan Anda secara real-time.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <div
                    class="bg-slate-900 border border-slate-800 p-6 rounded-3xl shadow-xl transition-transform hover:scale-[1.02]">
                    <div class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Total Pendapatan</div>
                    <div class="text-2xl md:text-3xl font-black text-emerald-500 italic">Rp
                        {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>

                <div
                    class="bg-slate-900 border border-slate-800 p-6 rounded-3xl shadow-xl transition-transform hover:scale-[1.02]">
                    <div class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Total Transaksi</div>
                    <div class="text-2xl md:text-3xl font-black text-blue-500 italic">{{ $totalTransaksi }}</div>
                </div>

                <div
                    class="bg-slate-900 border border-slate-800 p-6 rounded-3xl shadow-xl transition-transform hover:scale-[1.02] sm:col-span-2 lg:col-span-1">
                    <div class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Menunggu Konfirmasi
                    </div>
                    <div class="text-2xl md:text-3xl font-black text-yellow-500 italic">{{ $pendingCount }}</div>
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 p-6 rounded-3xl shadow-xl">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white font-bold text-lg italic uppercase">Tren Penjualan <span
                            class="text-blue-500 text-xs">(7 Hari Terakhir)</span></h3>
                </div>
                <div class="relative w-full h-[300px] md:h-[400px]">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [1200000, 1900000, 1500000, 2500000, 2200000, 3000000, 3500000],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBackgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#1e293b'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    </script>
</x-admin-layout> --}}
