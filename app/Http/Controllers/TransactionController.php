<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login agar pesanan tersimpan di riwayat.');
        }

        // 2. Validasi
        $request->validate([
            'user_id_game' => 'required',
            'whatsapp' => 'required',
            'product_id' => 'required',
            'payment_method' => 'required',
        ]);

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'user_id_game' => $request->user_id_game,
            'whatsapp' => $request->whatsapp,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // 4. Sekarang $transaction->id sudah bisa terbaca
        return redirect()->route('invoice.show', $transaction->id);
    }

    public function welcome()
    {
        $categories = \App\Models\Category::all();

        return view('welcome', compact('categories'));
    }

    public function showInvoice($id)
    {
        $transaction = Transaction::with('product')->findOrFail($id);

        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke nota ini.');
        }

        return view('invoice', compact('transaction'));
    }

    public function index()
    {
        // Hanya ambil transaksi milik user yang sedang login (untuk keamanan)
        $transactions = Transaction::with('product.category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // Hitung total pesanan sukses milik user tersebut
        $totalBerhasil = Transaction::where('user_id', auth()->id())
            ->where('status', 'success')
            ->count();

        // Arahkan ke folder transactions (file index.blade.php yang Anda kirim tadi)
        return view('transactions.index', compact('transactions', 'totalBerhasil'));
    }

    public function adminTransactions()
    {
        // Admin melihat semua transaksi dari semua user
        $transactions = Transaction::with('product.category', 'user')->latest()->get();

        $totalBerhasilGlobal = Transaction::where('status', 'success')->count();
        $totalPendingGlobal = Transaction::where('status', 'pending')->count();
        $totalTrxGlobal = Transaction::count();

        // Arahkan ke folder admin
        return view('admin.transactions', compact('transactions', 'totalTrxGlobal', 'totalBerhasilGlobal', 'totalPendingGlobal'));
    }

    public function updateStatus($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 'success']);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dikonfirmasi!');
    }

    public function adminDashboard(Request $request)
    {
        // 1. Mulai Query
        $query = Transaction::with('product.category', 'user');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('user_id_game', 'like', "%{$search}%")
                    ->orWhere('whatsapp', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $transactions = $query->latest()->get();

        $totalTransaksi = $transactions->count();

        $pesananPending = Transaction::where('status', 'pending')->count();

        $totalPendapatan = Transaction::where('status', 'success')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->sum('products.price');

        return view('admin.dashboard', compact(
            'transactions',
            'totalPendapatan',
            'totalTransaksi',
            'pesananPending'
        ));
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus!');
    }

    public function reset()
    {
        Transaction::truncate(); // Ini akan menghapus SEMUA isi tabel transactions

        return back()->with('success', 'Semua riwayat transaksi telah dibersihkan!');
    }

    public function showOrder($id)
    {
        // Mengambil kategori berdasarkan ID beserta produknya
        $category = Category::with('products')->findOrFail($id);

        return view('order', compact('category'));
    }

    public function downloadPDF($id)
    {
        // Cari transaksi
        $transaction = Transaction::findOrFail($id);

        // CEK: Jika user yang login bukan pemilik transaksi ini, TOLAK (Error 403)
        // Kecuali jika yang login adalah Admin
        if ($transaction->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke struk ini.');
        }

        $pdf = Pdf::loadView('pdf.invoice', compact('transaction'));

        return $pdf->stream('Struk-TopUp.pdf');
    }
}
