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
                    <li class="active"><a href="#"><i class="fa-solid fa-house-chimney"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fa-solid fa-box-open"></i> Produk Anda</a></li>
                    <li><a href="#"><i class="fa-solid fa-tags"></i> Jenis Kategori</a></li>
                    <li><a href="#"><i class="fa-solid fa-file-invoice-dollar"></i> Daftar Transaksi</a></li>
                    <li><a href="#"><i class="fa-solid fa-truck-fast"></i> Status Pesanan</a></li>
                </ul>
                <div class="divider"></div>
                <ul>
                    <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
                   <form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</form>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <h2>Admin Dashboard</h2>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Cari Pesanan atau produk">
                    </div>
                    <button class="header-icon-btn">
                        <i class="fa-solid fa-arrow-up-wide-short"></i>
                    </button>
                    <div class="profile-section">
                        <div class="profile-text">
                            <span class="p-name">Julianne Moore <i class="fa-solid fa-chevron-down"></i></span>
                            <span class="p-role">Penjual</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Julianne+Moore&background=C5A059&color=fff" alt="Avatar">
                    </div>
                </div>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-box"></i></div>
                    <div class="stat-content"><p>Total Produk</p><h3>124</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div class="stat-content"><p>Total Pesanan</p><h3>1,240</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-content"><p>Total Pembeli</p><h3>850</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                    <div class="stat-content"><p>Total Penjualan</p><h3>$142.5k</h3></div>
                </div>
            </div>

            <div class="content-card chart-container">
                <div class="card-header">
                    <div class="title-group">
                        <h3>Data Penjualan</h3>
                        <p>Lihat data penjualan anda selama 6 Bulan Terakhir.</p>
                    </div>
                    <div class="btn-group">
                        <button class="btn-outline">Download Report</button>
                        <button class="btn-dark">Last 6 Months <i class="fa-solid fa-chevron-down"></i></button>
                    </div>
                </div>
                <div class="chart-visual">
                    <div class="bar-col"><div class="bar" style="height: 40%"></div><span>JANUARI</span></div>
                    <div class="bar-col"><div class="bar" style="height: 55%"></div><span>FEBRUARI</span></div>
                    <div class="bar-col"><div class="bar" style="height: 45%"></div><span>MARET</span></div>
                    <div class="bar-col"><div class="bar" style="height: 70%"></div><span>APRIL</span></div>
                    <div class="bar-col active"><div class="bar" style="height: 90%"></div><span>MEI</span></div>
                    <div class="bar-col"><div class="bar" style="height: 65%"></div><span>JUNI</span></div>
                </div>
            </div>

            <div class="content-card table-container">
                <div class="card-header">
                    <h3>Pesanan Terbaru</h3>
                    <a href="#" class="view-all">Lihat Semua Pesanan</a>
                </div>
                <table class="table-elixire">
                    <thead>
                        <tr>
                            <th>ORDER ID</th>
                            <th>NAMA PEMBELI</th>
                            <th>PRODUK</th>
                            <th>TOTAL</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#9912</td>
                            <td>Julianne Moore</td>
                            <td>Oud Nocturne (100ml)</td>
                            <td><strong>$240.00</strong></td>
                            <td><span class="badge shipped">SHIPPED</span></td>
                            <td class="action-icons"><i class="fa-regular fa-eye"></i> <i class="fa-regular fa-trash-can"></i></td>
                        </tr>
                        </tbody>
                </table>
            </div>

            <div class="product-header">
                <h3>Produk Anda</h3>
                <button class="btn-add-product"><i class="fa-solid fa-plus"></i> Tambah Produk Baru</button>
            </div>
            <div class="product-grid">
                <div class="product-item">
                    <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?w=100" alt="Perfume">
                    <div class="p-details">
                        <h4>Oud Nocturne</h4>
                        <span>Woody, Oriental</span>
                        <div class="p-stock">Stock: <strong>42</strong></div>
                        <div class="p-price">$240.00</div>
                    </div>
                    <div class="p-actions">
                        <i class="fa-solid fa-pen"></i>
                        <i class="fa-solid fa-trash-can text-red"></i>
                    </div>
                </div>
                </div>

        </main>
    </div>

</body>
</html>