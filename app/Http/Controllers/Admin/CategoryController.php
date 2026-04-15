<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Simpan kategori baru + upload gambar (opsional)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'type'  => 'required|in:product,aroma,collection',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name'   => $request->name,
            'type'   => $request->type,
            'image'  => $imagePath,
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Update kategori (nama, tipe, atau ganti gambar)
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'type'  => 'required|in:product,aroma,collection',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $category->image; // tetap gunakan gambar lama jika tidak ada upload baru

        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        // Jika checkbox "hapus gambar" dicentang
        if ($request->has('remove_image') && !$request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = null;
        }

        $category->update([
            'name'  => $request->name,
            'type'  => $request->type,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus satu kategori beserta gambarnya
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }

    /**
     * Hapus banyak kategori sekaligus
     */
    public function bulkDelete(Request $request)
    {
        $ids = json_decode($request->category_ids);
        if ($ids) {
            $categoriesToDelete = Category::whereIn('id', $ids)->get();
            foreach ($categoriesToDelete as $cat) {
                if ($cat->image) {
                    Storage::disk('public')->delete($cat->image);
                }
            }
            Category::whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('success', 'Kategori terpilih berhasil dihapus!');
    }
}