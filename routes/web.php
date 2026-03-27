<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BerandaController;
use App\Models\Product; // Pastikan ini ada di paling atas file

Route::get('/', function () {
    $products = Product::all(); // Mengambil data
    return view('beranda', compact('products')); // Mengirim ke file beranda.blade.php
});

Route::get('/login', function () {
    return view('auth.login'); // Sesuaikan jika file login ada di folder resources/views/auth/login.blade.php
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class,'store']);

Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

//web index
Route::get('/', [BerandaController::class,'index']);

// TAMBAHKAN INI DI BARIS 16
Route::get('/search', [BerandaController::class, 'search'])->name('search');

//user routes
Route::middleware(['auth', 'verified'])->group(function () {

//Dasboard User
Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin'){
        return redirect('/admin/dashboard');
    }
    return view('user.dashboard');
})->name('dashboard');

//Profil User (default Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');
});

//admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
    return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::resource('products', ProductController::class);
});

//auth routes
require __DIR__.'/auth.php';
