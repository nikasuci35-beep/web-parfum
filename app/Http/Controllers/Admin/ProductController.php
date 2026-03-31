<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // Setelah TAMBAH produk, kembali ke DASHBOARD
        return redirect()->route('admin.dashboard')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
         $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Logika update gambar jika ada file baru
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        // Update data text (name, price, description)
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image // Memastikan image terbaru ikut tersimpan
        ]);

        // --- PERBAIKAN DI SINI ---
        // Setelah UPDATE produk, diarahkan kembali ke DASHBOARD ADMIN
        return redirect()->route('admin.dashboard')
            ->with('success', 'Produk berhasil diupdate');
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