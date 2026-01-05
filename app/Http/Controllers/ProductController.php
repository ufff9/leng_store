<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->latest()->get();

        return view('admin.product', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255', // Input dari form tambah bernama 'name'
            'price' => 'required|numeric',
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'amount' => $request->name, // Disimpan ke kolom 'amount' di database
            'price' => $request->price,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products-edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'amount' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount, 
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success', 'Produk berhasil dihapus!');
    }
}
