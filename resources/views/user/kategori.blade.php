<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
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
        <header class="category-header">
            <h1>Category</h1>
            <p>Find your perfect scent</p>
        </header>

        <div class="category-grid">
            <div class="category-card">
                <img src="{{ asset('images/cat-pria.jpg') }}" alt="Pria">
                <div class="category-overlay">
                    <h2>Pria</h2>
                    <span>EXPLORE &rarr;</span>
                </div>
            </div>
            <div class="category-card">
                <img src="{{ asset('images/cat-wanita.jpg') }}" alt="Wanita">
                <div class="category-overlay">
                    <h2>Wanita</h2>
                    <span>EXPLORE &rarr;</span>
                </div>
            </div>
            <div class="category-card">
                <img src="{{ asset('images/cat-unisex.jpg') }}" alt="Unisex">
                <div class="category-overlay">
                    <h2>Unisex</h2>
                    <span>EXPLORE &rarr;</span>
                </div>
            </div>
            <div class="category-card">
                <img src="{{ asset('images/cat-floral.jpg') }}" alt="Floral">
                <div class="category-overlay">
                    <h2>Floral</h2>
                    <span>EXPLORE &rarr;</span>
                </div>
            </div>
            <div class="category-card">
                <img src="{{ asset('images/cat-woody.jpg') }}" alt="Woody">
                <div class="category-overlay">
                    <h2>Woody</h2>
                    <span>EXPLORE &rarr;</span>
                </div>
            </div>
            <div class="category-card">
                <img src="{{ asset('images/cat-fresh.jpg') }}" alt="Fresh">
                <div class="category-overlay">
                    <h2>Fresh</h2>
                    <span>EXPLORE &rarr;</span>
                </div>
            </div>
        </div>

        <div class="scent-families">
            <span class="scent-label">SCENT FAMILIES</span>
            <button class="tag">FLORAL</button>
            <button class="tag">CITRUS</button>
            <button class="tag active">WOODY</button>
            <button class="tag">ORIENTAL</button>
            <button class="tag">GOURMAND</button>
        </div>

        <section class="luxury-banner">
            <div class="banner-text">
                <h2>Luxury Collection</h2>
                <p>Discover our most prestigious fragrances, crafted with the rarest essences from Grasse. A sensory journey of pure elegance and timeless distinction.</p>
                <a href="#" class="btn-gold">VIEW COLLECTION</a>
            </div>
            <div class="banner-img">
                <img src="{{ asset('images/luxury-banner.jpg') }}" alt="Luxury Collection">
            </div>
        </section>
    </div>

</body>
</html>