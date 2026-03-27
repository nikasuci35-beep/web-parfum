<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class BerandaController extends Controller
{
    public function index() {
    // 1. Fetch the data from your Model
    $products = Product::all(); 
    // 2. Pass it to the view using compact() or an array
    return view('beranda', compact('products'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('query');

        // Mengambil produk yang namanya atau kategorinya mirip dengan kata kunci
        $products = Product::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('category', 'LIKE', "%$keyword%")
                    ->get();

        // Mengembalikan ke tampilan yang sama (beranda) dengan hasil filter
        return view('beranda', compact('products'));
    }
}
