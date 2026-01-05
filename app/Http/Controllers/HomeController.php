<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Mengambil semua data game

        return view('welcome', compact('categories'));
    }

    public function order($id)
    {
        // Mengambil kategori berdasarkan ID beserta produk di dalamnya
        $category = \App\Models\Category::with('products')->findOrFail($id);

        return view('order', compact('category'));
    }
}
