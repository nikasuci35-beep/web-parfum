<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::latest();
        
        if ($request->has('query') && $request->get('query') != '') {
            $searchTerm = $request->get('query');
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
        }

        $products = $query->get();
        // Mengambil kategori dengan hitungan produk
        $categories = Category::all();
        
        // MENGARAH KE FILE BARU KAMU: dashboard_admin.blade.php
        return view('admin.dashboard', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'stock' => $request->stock,
        ]);

        $product->categories()->sync($request->categories);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        $product->categories()->sync($request->categories);
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {  
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus');
    }
}