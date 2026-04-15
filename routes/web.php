<?php

use App\Http\Controllers\ResiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PaymentController;


// 1. Publik
Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/search', [BerandaController::class, 'search'])->name('search');
Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');
Route::get('/cara-order', function () {
    return view('cara-order');
})->name('cara-order');

// Halaman produk publik (tanpa perlu login)
Route::get('/produk', function (\Illuminate\Http\Request $request) {
    $categoryId = $request->input('category');
    $search = $request->input('query');

    $query = \App\Models\Product::query();

    if ($categoryId) {
        $query->whereHas('categories', function($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        });
    }

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    $products = $query->get();
    $categories = \App\Models\Category::all();

    return view('produk_publik', compact('products', 'categories'));
})->name('produk.publik');

// Detail produk publik (tanpa login) — memakai view yang sama dengan user
Route::get('/produk/{id}', function ($id) {
    $product = \App\Models\Product::with('categories')->findOrFail($id);

    $categoryIds = $product->categories->pluck('id');
    $relatedProducts = \App\Models\Product::whereHas('categories', function($q) use ($categoryIds) {
        $q->whereIn('categories.id', $categoryIds);
    })->where('id', '!=', $id)->take(4)->get();

    $cartCount = 0; // guest tidak punya keranjang

    return view('user.detailproduk', compact('product', 'relatedProducts', 'cartCount'));
})->name('detail.publik');

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

Route::get('/cek-resi', [ResiController::class, 'index'])->name('user.cekresi.index');
Route::post('/cek-resi', [ResiController::class, 'check'])->name('user.cekresi.check');

// 3. Gabungan (User & Admin)
Route::middleware(['auth'])->group(function () {
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
Route::get('/user/produk', function (\Illuminate\Http\Request $request) {
    $categoryId = $request->input('category');
    $search = $request->input('query');
    
    $query = \App\Models\Product::query();

    if ($categoryId) {
        $query->whereHas('categories', function($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        });
    }

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    $products = $query->get();
    
    $categories = \App\Models\Category::all();
    
    return view('user.produk', compact('products', 'categories'));
})->name('user.produk');

Route::get('/user/produk/detailproduk/{id}', [UserController::class, 'detail'])->name('user.detailproduk');

    // Tambahkan di routes/web.php
Route::get('/user/kategori', function () {
    $categories = \App\Models\Category::all();
    return view('user.kategori', compact('categories'));
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
Route::post('/user/keranjang/add', [UserController::class, 'addToCart'])->name('user.keranjang.add');
Route::put('/user/keranjang/update/{id}', [UserController::class, 'updateCart'])->name('user.keranjang.update');
Route::delete('/user/keranjang/remove/{id}', [UserController::class, 'removeFromCart'])->name('user.keranjang.remove');
Route::get('/user/checkout', [UserController::class, 'checkout'])->name('user.checkout');
Route::get('/user/checkout/success', [UserController::class, 'checkoutSuccess'])->name('user.checkout.success');
Route::post('/user/checkout/paylater', [UserController::class, 'payLater'])->name('user.checkout.paylater');

// Menghubungkan URL ke fungsi di Controller
Route::get('/user/pesanan', [UserController::class, 'pesanan'])->name('user.pesanan');
Route::get('/user/pesanan/{id}', [UserController::class, 'detailPesanan'])->name('user.pesanan.detail');
Route::post('/user/pesanan/{id}/cancel', [UserController::class, 'cancelOrder'])->name('user.pesanan.cancel');
Route::post('/get-snap-token', [PaymentController::class, 'getSnapToken']);

// 4. Rating & Reviews
Route::middleware(['auth'])->group(function () {
    Route::get('/user/pesanan/{order_id}/rate/{product_id}', [App\Http\Controllers\User\ReviewController::class, 'index'])->name('user.reviews.index');
    Route::post('/user/reviews', [App\Http\Controllers\User\ReviewController::class, 'store'])->name('user.reviews.store');
});

// 5. Khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard & Produk
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::get('/products-list', [ProductController::class, 'index'])->name('products.index');
    Route::resource('products', ProductController::class)->except(['index']);

    // --- BAGIAN KATEGORI ---
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::delete('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');

    // --- BAGIAN PESANAN / TRANSAKSI ---
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // --- BAGIAN NOTIFIKASI ---
    Route::get('/notifications', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}/read', [App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'destroy'])->name('notifications.destroy');
});

require __DIR__.'/auth.php';