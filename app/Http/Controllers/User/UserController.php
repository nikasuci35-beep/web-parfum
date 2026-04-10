<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function keranjang()
{
    // Mengarahkan ke file resources/views/user/keranjang.blade.php
    return view('user.keranjang'); 
}

public function pesanan()
{
    // Nantinya di sini ambil data dari database MySQL kamu
    // Untuk sekarang, kita arahkan ke file yang ada di folder user tadi
    return view('user.pesanan'); 
}
}
