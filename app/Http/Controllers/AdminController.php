<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUser = User::count();

        $totalPesanan = \App\Models\Transaction::count();

        $pesananPending = \App\Models\Transaction::where('status', 'pending')->count();

        $transactions = \App\Models\Transaction::where('status', 'success')->with('product')->get();

        $totalPendapatan = $transactions->sum(function ($t) {
            return optional($t->product)->price ?? 0;
        });

        // 3. Kirim semua variabel ke view dashboard
        return view('admin.dashboard', compact('totalUser','totalPesanan', 'pesananPending', 'totalPendapatan'));
    }

    public function transactions(Request $request)
    {
        $query = Transaction::with(['user', 'product.category']);

        // Logika Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('user_id_game', 'like', "%{$search}%")
                    ->orWhere('whatsapp', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $transactions = $query->latest()->get();

        // Statistik Global agar tidak muncul 0
        $totalBerhasilGlobal = Transaction::where('status', 'success')->count();
        $totalPendingGlobal = Transaction::where('status', 'pending')->count();
        $totalTrxGlobal = Transaction::count();

        return view('admin.transactions', compact(
            'transactions',
            'totalBerhasilGlobal',
            'totalPendingGlobal',
            'totalTrxGlobal'
        ));
    }

    public function updateStatus($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 'success']);

        return back()->with('success', 'Pesanan berhasil dikonfirmasi!');
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
