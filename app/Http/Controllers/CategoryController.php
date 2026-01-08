<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('admin.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            // Simpan ke public/uploads/categories
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        \App\Models\Category::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);

        return back()->with('success', 'Game berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Game berhasil dihapus!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('uploads/categories/'.$category->image))) {
                unlink(public_path('uploads/categories/'.$category->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }
}
