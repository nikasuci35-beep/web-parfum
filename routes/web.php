<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\UserController;

// 1. Publik
Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/search', [BerandaController::class, 'search'])->name('search');

// 2. Auth Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::delete('/profile/delete', [ProfileController::class, 'destory'])->name('profile.destory');

// 3. Gabungan (User & Admin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    Route::get('/user/dashboard', function (Illuminate\Http\Request $request) {
        $search = $request->input('query');
        if ($search) {
            $products = \App\Models\Product::where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")->get();
        } else {
            $products = \App\Models\Product::inRandomOrder()->take(4)->get();
        }
        $categories = \App\Models\Category::all();
        return view('user.dashboard', compact('products', 'categories'));
    })->name('user.dashboard');

    // Route untuk halaman daftar produk di sisi User
Route::get('/user/produk', function () {
    // Mengambil semua data produk untuk ditampilkan di halaman produk
    $products = \App\Models\Product::all();
    $categories = \App\Models\Category::all();
    
    return view('user.produk', compact('products', 'categories'));
})->name('user.produk');

    // Tambahkan di routes/web.php
Route::get('/user/kategori', function () {
    return view('user.kategori'); // Mengarah ke resources/views/user/kategori.blade.php
})->name('user.kategori');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Menampilkan halaman form ubah password
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');

// Proses update passwordnya
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});

Route::delete('/profile/session/{id}', [ProfileController::class, 'logoutSession'])->name('profile.logout-session');
Route::post('/profile/logout-all', [ProfileController::class, 'logoutAllSessions'])->name('profile.logout-all-sessions');

Route::get('/user/keranjang', [UserController::class, 'keranjang'])->name('user.keranjang');

// Menghubungkan URL ke fungsi di Controller
Route::get('/user/pesanan', [UserController::class, 'pesanan'])->name('user.pesanan');
// 4. Khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard & Produk
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::get('/products-list', [ProductController::class, 'index'])->name('products.index');
    Route::resource('products', ProductController::class)->except(['index']);

    // --- BAGIAN KATEGORI (SUDAH DIPERBAIKI) ---
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');
});

require __DIR__.'/auth.php';