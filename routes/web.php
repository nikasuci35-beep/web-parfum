<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Product;

// 1. Home
Route::get('/', [BerandaController::class, 'index'])->name('home');

// 2. Auth
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/search', [BerandaController::class, 'search'])->name('search');

// 3. Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // PERBAIKAN DI SINI: Membedakan URL index dan edit agar tidak bentrok
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/logout-others', [ProductController::class, 'logoutOthers'])->name('profile.logout-others');
});

// 4. Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';