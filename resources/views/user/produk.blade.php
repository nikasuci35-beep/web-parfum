<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Collection - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
</head>
<body>

    <nav class="navbar-elixire">
        <div class="nav-content">
            <div class="nav-logo">ÉLIXIRÉ</div>
            <ul class="nav-links">
                <li><a href="{{ route('user.dashboard') }}">DASHBOARD</a></li>
                <li><a href="{{ route('user.produk') }}">PRODUK</a></li>
                <li><a href="{{ route('user.kategori') }}">KATEGORI</a></li>
                <li><a href="#">PESANAN SAYA</a></li>
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
                        <strong>{{ auth()->user()->name }}</strong>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=C5A059&color=fff" alt="">
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="header-section">
            <h1>Our Collection</h1>
            <p>Choose your perfect perfume</p>
        </div>

        <div class="filter-group">
            <button class="btn-filter active">SEMUA</button>
            <button class="btn-filter">PRIA</button>
            <button class="btn-filter">WANITA</button>
            <button class="btn-filter">UNISEX</button>
        </div>

        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="image-container">
                    @if($product->label)
                        <div class="badge">{{ $product->label }}</div>
                    @endif
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p class="product-type">{{ $product->category->name ?? 'Fragrance' }} - {{ $product->size ?? '50' }}ML</p>
                    <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <footer>
        <div class="footer-logo">ÉLIXIRÉ PARFUMS</div>
        <div class="footer-grid">
            <div class="footer-col">
                <h4>BOUTIQUE</h4>
                <ul>
                    <li><a href="#">ALL FRAGRANCES</a></li>
                    <li><a href="#">GIFT SETS</a></li>
                    <li><a href="#">DISCOVERY KIT</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>HOUSE OF ÉLIXIRÉ</h4>
                <ul>
                    <li><a href="#">OUR STORY</a></li>
                    <li><a href="#">THE ART OF PERFUME</a></li>
                    <li><a href="#">JOURNAL</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>SUPPORT</h4>
                <ul>
                    <li><a href="#">SUSTAINABILITY</a></li>
                    <li><a href="#">CONTACT</a></li>
                    <li><a href="#">SHIPPING & RETURNS</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>LEGAL</h4>
                <ul>
                    <li><a href="#">PRIVACY POLICY</a></li>
                    <li><a href="#">TERMS OF USE</a></li>
                    <li><a href="#">LEGAL NOTICE</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 ÉLIXIRÉ PARFUMS. ALL RIGHTS RESERVED.
        </div>
    </footer>

</body>
</html>