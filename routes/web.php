<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController; // Tambahkan ini agar tidak panjang di bawah
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// --- 1. RUTE PUBLIK ---
Route::get('/', [TransactionController::class, 'welcome'])->name('welcome');
Route::get('/order/{id}', [TransactionController::class, 'showOrder'])->name('order');

// --- 2. RUTE USER TERAUTENTIKASI (General) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Logic Dashboard: Menghindari Loop
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        $categories = Category::all();

        return view('dashboard', compact('categories'));
    })->name('dashboard');

    // Transaksi User
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions', 'index')->name('transactions.index');
        Route::get('/transactions/{id}/download', 'downloadPDF')->name('transactions.download');
        Route::post('/order/store', 'store')->name('order.store');
        Route::get('/invoice/{id}', 'showInvoice')->name('invoice.show');
    });

    // Profil User
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// --- 3. RUTE KHUSUS ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Transaksi Admin
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/transactions', 'transactions')->name('transactions');
        Route::patch('/transactions/{id}/status', 'updateStatus')->name('transactions.updateStatus');
        Route::delete('/transactions/{id}', 'destroy')->name('transactions.destroy');
    });

    // Produk Admin
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{id}/edit', 'edit')->name('products.edit');
        Route::put('/products/{id}', 'update')->name('products.update');
        Route::delete('/products/{id}', 'destroy')->name('products.destroy');
    });

    // Kategori Admin
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::post('/categories', 'store')->name('categories.store');
        Route::get('/categories/{id}/edit', 'edit')->name('categories.edit');
        Route::put('/categories/{id}', 'update')->name('categories.update');
        Route::delete('/categories/{id}', 'destroy')->name('categories.destroy');
    });
});

require __DIR__.'/auth.php';
