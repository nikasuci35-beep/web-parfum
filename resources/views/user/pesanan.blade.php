<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/pesanan.css') }}">
</head>
<body>

    <nav class="navbar-elixire">
        <div class="nav-content">
            <div class="nav-logo">ÉLIXIRÉ</div>
            <ul class="nav-links">
                <li><a href="{{ route('user.dashboard') }}">DASHBOARD</a></li>
                <li><a href="{{ route('user.produk') }}">PRODUK</a></li>
                <li><a href="{{ route('user.kategori') }}">KATEGORI</a></li>
                <li><a href="{{ route('user.pesanan') }}">PESANAN SAYA</a></li>
                <li><a href="{{ route('profile.index') }}">PROFIL</a></li>
                <li><form id="logout-form-final" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-final').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i><span>LOGOUT</span>
                        </a></li>
            </ul>
            <div class="nav-right">
                <div class="search-wrapper">
                    <input type="text" placeholder="Cari parfum...">
                </div>
                <div class="action-icons">
                    <div class="icon-badge">❤️<span>0</span></div>
                    <div class="icon-badge">🛒<span>0</span></div>
                </div>
                <div class="user-pill">
                    <div class="user-meta">
                        <small>SELAMAT DATANG</small>
                        <strong>{{ auth()->user()?->name ?? 'Guest' }}</strong>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()?->name ?? 'Guest') }}&background=C5A059&color=fff" alt="">
                </div>
            </div>
        </div>
    </nav>

<div class="container">
    <header>
        <h1>Pesanan Saya</h1>
        <p>Kelola semua pesanan Anda dengan mudah dalam satu ruang kurasi.</p>
    </header>

    <nav class="filter-tabs">
        <button class="active">SEMUA</button>
        <button>MENUNGGU</button>
        <button>DIPROSES</button>
        <button>DIKIRIM</button>
        <button>SELESAI</button>
        <button>DIBATALKAN</button>
    </nav>

    <div class="order-list">
        <!-- Card 1 -->
        <div class="order-card">
            <div class="card-content">
                <div class="product-img">
                    <img src="https://i.pinimg.com/736x/8f/33/c0/8f33c0bd40e0dd4b8da1c4decdccfa9f.jpg" alt="Élixire Noir">
                </div>
                <div class="product-details">
                    <div class="badge-row">
                        <span class="order-id">#ELX-591244</span>
                        <span class="status-badge status-selesai">SELESAI</span>
                    </div>
                    <h3>Élixire Noir</h3>
                    <div class="desc">Woody • 50ml • Intense<br>Eau De Parfum</div>
                    <div class="price-row">
                        <span class="qty">QTY: 1</span>
                        <span class="price">Rp 3.450.000</span>
                    </div>
                </div>
            </div>
            <div class="card-actions">
                <div class="info-date">
                    <label>SELESAI PADA</label>
                    <span>12 Oktober 2023</span>
                </div>
                <div class="button-group">
                    <button class="btn-secondary">DETAIL</button>
                    <button class="btn-primary">BELI LAGI</button>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="order-card">
            <div class="card-content">
                <div class="product-img">
                    <img src="https://i.pinimg.com/736x/c8/cd/e1/c8cde1d8de63d41e7fec74720914c1bf.jpg" alt="Oud d'Or">
                </div>
                <div class="product-details">
                    <div class="badge-row">
                        <span class="order-id">#ELX-591245</span>
                        <span class="status-badge status-proses">DIPROSES</span>
                    </div>
                    <h3>Oud d'Or</h3>
                    <div class="desc">Oriental • 100ml •<br>Signature Collection</div>
                    <div class="price-row">
                        <span class="qty">QTY: 1</span>
                        <span class="price">Rp 5.200.000</span>
                    </div>
                </div>
            </div>
            <div class="card-actions">
                <div class="info-date">
                    <label>ESTIMASI TIBA</label>
                    <span>16 Oktober 2023</span>
                </div>
                <div class="button-group">
                    <button class="btn-secondary">DETAIL</button>
                    <button class="btn-dark">LACAK</button>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="order-card">
            <div class="card-content">
                <div class="product-img">
                    <img src="https://i.pinimg.com/736x/cb/50/bf/cb50bfc6d6d7fe7e6c9a3b64db8d0354.jpg" alt="L'Atelier Blanc">
                </div>
                <div class="product-details">
                    <div class="badge-row">
                        <span class="order-id">#ELX-592188</span>
                        <span class="status-badge status-menunggu">MENUNGGU PEMBAYARAN</span>
                    </div>
                    <h3>L'Atelier Blanc</h3>
                    <div class="desc">Floral • 50ml • Pure<br>Essence</div>
                    <div class="price-row">
                        <span class="qty">QTY: 2</span>
                        <span class="price">Rp 4.900.000</span>
                    </div>
                </div>
            </div>
            <div class="card-actions">
                <div class="info-date" style="text-align: right;">
                    <label>MENUNGGU PEMBAYARAN</label>
                    <span style="color: #d32f2f;">23:45:12</span>
                </div>
                <div class="button-group">
                    <button class="btn-secondary">DETAIL</button>
                    <button class="btn-primary">BAYAR SEKARANG</button>
                </div>
            </div>
        </div>
    </div>

    <div class="loyalty-banner">
        <div class="banner-text">
            <span class="label">THE LOYALTY CLUB</span>
            <h2>Keistimewaan dalam Setiap Semprotan.</h2>
            <p>Dapatkan akses eksklusif ke koleksi Atelier kami dan undangan pre-order untuk rilisan terbatas.</p>
            <button class="btn-banner">PELAJARI LEBIH LANJUT</button>
        </div>
        <div class="banner-graphic">
            <div class="text-overlay">PRAMO</div>
        </div>
    </div>
</div>

<footer>
    <h3>ÉLIXIRÉ PARFUMERIE</h3>
    <div class="footer-links">
        <a href="#">PRIVACY POLICY</a>
        <a href="#">TERMS OF SERVICE</a>
        <a href="#">SHIPPING & RETURNS</a>
        <a href="#">CONTACT</a>
    </div>
    <p>© 2023 ÉLIXIRÉ PARFUMERIE. ALL RIGHTS RESERVED.</p>
</footer>

</body>
</html>