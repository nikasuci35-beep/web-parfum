<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardadmin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h1>ÉLIXIRÉ</h1>
                <p>LUXURY PERFUMES</p>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-house-chimney"></i> Dashboard</a>
                    </li>
                    <li><a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-box-open"></i> Produk Anda</a></li>
                    <li><a href="#"><i class="fa-solid fa-tags"></i> Jenis Kategori</a></li>
                    <li><a href="#"><i class="fa-solid fa-file-invoice-dollar"></i> Daftar Transaksi</a></li>
                    <li><a href="#"><i class="fa-solid fa-truck-fast"></i> Status Pesanan</a></li>
                </ul>
                <div class="divider" style="margin: 20px 0; border-top: 1px solid #eee;"></div>
                <ul>
                    <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
                    <li class="logout-link">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="color: #e74c3c;">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <h2>Admin Dashboard</h2>
                <div class="header-right" style="display: flex; gap: 20px; align-items: center;">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Cari Pesanan atau produk">
                    </div>
                    <div class="profile-section">
                        <div class="profile-text" style="text-align: right;">
                            <span class="p-name" style="display: block; font-weight: 600;">{{ Auth::user()->name ?? 'Guest' }}</span>
                            <span class="p-role" style="font-size: 12px; color: #888;">Administrator</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=C5A059&color=fff" alt="Avatar">
                    </div>
                </div>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-box"></i></div>
                    <div class="stat-content"><p style="font-size: 13px; color: #888;">Total Produk</p><h3>{{ $products->count() }}</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div class="stat-content"><p style="font-size: 13px; color: #888;">Total Pesanan</p><h3>1,240</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                    <div class="stat-content"><p style="font-size: 13px; color: #888;">Total Penjualan</p><h3>$142.5k</h3></div>
                </div>
            </div>

            <div class="product-header" style="display: flex; justify-content: space-between; align-items: center; margin: 40px 0 20px;">
                <h3 style="font-weight: 600;">Produk Anda</h3>
                <a href="{{ route('admin.products.create') }}" class="btn-add-product" style="text-decoration: none;">
                    <i class="fa-solid fa-plus"></i> Tambah Produk Baru
                </a>
            </div>

            <div class="product-grid">
                @foreach($products as $product)
                <div class="product-item">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div style="width: 80px; height: 80px; background: #eee; border-radius:10px;"></div>
                    @endif
                    <div class="p-details" style="flex: 1;">
                        <h4 style="font-size: 15px; margin-bottom: 2px;">{{ $product->name }}</h4>
                        <span style="font-size: 12px; color: #aaa;">Perfume Collection</span>
                        <div class="p-stock" style="font-size: 12px; margin: 5px 0;">Stock: <strong>{{ $product->stock ?? '0' }}</strong></div>
                        <div class="p-price" style="font-weight: 700; color: var(--primary-gold);">Rp {{ number_format($product->price) }}</div>
                    </div>
                    <div class="p-actions" style="display: flex; flex-direction: column; gap: 10px; color: #ccc;">
                        <a href="{{ route('admin.products.edit', $product) }}" style="color: inherit;"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus produk?')" style="background: none; border: none; color: #e74c3c; cursor: pointer;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</body>
</html>