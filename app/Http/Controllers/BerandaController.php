<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BerandaController extends Controller
{
    // UNTUK PENGUNJUNG (127.0.0.1:8000)
    public function index() 
    {
        $products = Product::all(); 
        return view('berandautama', compact('products')); // Pastikan ada file beranda.blade.php
    }

    // UNTUK ADMIN (Dashboard)
    public function adminDashboard()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products')); // Pastikan ada file admin/dashboard.blade.php
    }

    // UNTUK PENCARIAN
    public function search(Request $request)
    {
        $keyword = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->get();

        return view('beranda', compact('products'));
    }
}