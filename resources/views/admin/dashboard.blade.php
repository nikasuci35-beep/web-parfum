<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardadmin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Menambahkan fitur scroll halus ke seluruh halaman */
        html {
            scroll-behavior: smooth;
        }

        /* Memberikan jarak agar saat di-scroll judul tidak tertutup header */
        #status-pesanan, #produk-anda {
            scroll-margin-top: 100px;
        }
    </style>
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
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-house-chimney"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#produk-anda">
                            <i class="fa-solid fa-box-open"></i> Produk Anda
                        </a>
                    </li>
                    <li><a href="#"><i class="fa-solid fa-tags"></i> Jenis Kategori</a></li>
                    <li><a href="#"><i class="fa-solid fa-file-invoice-dollar"></i> Daftar Transaksi</a></li>
                    <li>
                        <a href="#status-pesanan">
                            <i class="fa-solid fa-truck-fast"></i> Status Pesanan
                        </a>
                    </li>
                </ul>
                <div class="divider" style="margin: 20px 0; border-top: 1px solid #eee;"></div>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i> Profile Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form-final" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" class="nav-link" 
                           onclick="event.preventDefault(); document.getElementById('logout-form-final').submit();" 
                           style="color: #e74c3c; text-decoration: none; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <h2>Admin Dashboard</h2>
                <div class="header-right" style="display: flex; gap: 20px; align-items: center;">
                    <form action="{{ route('search') }}" method="GET" class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="query" placeholder="Cari produk anda..." value="{{ request('query') }}">
                    </form>
                    <div class="profile-section" style="display: flex; align-items: center; gap: 12px;">
    <div class="profile-text" style="text-align: right;">
        <span class="p-name" style="display: block; font-weight: 700; color: #1a1a1a;">
            {{ Auth::user()->name ?? 'admin' }}
        </span>
        <span class="p-role" style="display: block; font-size: 12px; color: #888;">
            Administrator
        </span>
    </div>
    
    <div class="profile-image">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'admin') }}&background=C5A059&color=fff" 
             alt="Avatar" 
             style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
    </div>
</div>
                </div>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-box"></i></div>
                    <div class="stat-content"><p>Total Produk</p><h3>{{ $products->count() }}</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div class="stat-content"><p>Total Pesanan</p><h3>0</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-content"><p>Total Pembeli</p><h3>0</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                    <div class="stat-content"><p>Total Penjualan</p><h3>Rp 0</h3></div>
                </div>
            </div>

            <div class="sales-chart-container" style="background: #fff; padding: 25px; border-radius: 15px; margin-top: 30px;">
                <div class="chart-header" style="margin-bottom: 20px;">
                    <h3 style="font-size: 18px; font-weight: 600;">Data Penjualan</h3>
                    <p style="font-size: 12px; color: #888;">Belum ada data transaksi untuk ditampilkan.</p>
                </div>
                <div style="height: 150px; border: 1px dashed #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #ccc;">
                    <p><i class="fa-solid fa-chart-simple"></i> Grafik akan muncul otomatis</p>
                </div>
            </div>

            <div id="status-pesanan" class="recent-orders" style="background: #fff; padding: 25px; border-radius: 15px; margin-top: 30px;">
                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 20px;">Pesanan Terbaru</h3>
                <div style="text-align: center; padding: 30px 0; color: #bbb;">
                    <p>Tidak ada pesanan masuk saat ini.</p>
                </div>
            </div>

            <div id="produk-anda" class="product-header" style="display: flex; justify-content: space-between; align-items: center; margin: 40px 0 20px;">
                <h3 style="font-weight: 600;">Produk Anda</h3>
                <a href="{{ route('admin.products.create') }}" class="btn-add-product" style="text-decoration: none;">
                    <i class="fa-solid fa-plus"></i> Tambah Produk Baru
                </a>
            </div>

            <div class="product-grid">
                @forelse($products as $product)
                <div class="product-item">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div style="width: 80px; height: 80px; background: #eee; border-radius:10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-image" style="color: #ccc;"></i>
                        </div>
                    @endif
                    <div class="p-details" style="flex: 1;">
                        <h4 style="font-size: 15px; margin-bottom: 2px;">{{ $product->name }}</h4>
                        <span style="font-size: 12px; color: #aaa;">Perfume Collection</span>
                        <div class="p-stock" style="font-size: 12px; margin: 5px 0;">Stock: <strong>{{ $product->stock ?? '0' }}</strong></div>
                        <div class="p-price" style="font-weight: 700; color: #C5A059;">Rp {{ number_format($product->price) }}</div>
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
                @empty
                <div style="grid-column: span 3; text-align: center; padding: 50px; color: #888; background: #fff; border-radius: 15px;">
                    <p>Produk tidak ditemukan.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>