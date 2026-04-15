<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Collection - ÉLIXIRÉ</title>
    <meta name="description" content="Jelajahi koleksi parfum eksklusif ÉLIXIRÉ. Temukan wewangian kerajinan tangan terbaik di dunia.">
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <style>
        /* ===== Guest Navbar Buttons ===== */
        .btn-nav-login {
            padding: 8px 22px;
            border: 1.5px solid #1a1a1a;
            border-radius: 5px;
            color: #1a1a1a;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: 0.3s;
        }
        .btn-nav-login:hover { background: #1a1a1a; color: #fff; }
        .btn-nav-register {
            padding: 8px 22px;
            border-radius: 5px;
            background: #c5a059;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: 0.3s;
        }
        .btn-nav-register:hover { background: #a8864a; }

        /* ===== Guest "LIHAT" button — same size/feel as "ADD" ===== */
        .btn-lihat-card {
            background: #1a1a1a;
            color: #fff;
            border: none;
            padding: 6px 15px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-block;
        }
        .btn-lihat-card:hover { background: #c5a059; color: #fff; }

        /* Card hover — keep identical to user produk */
        .item-card { cursor: pointer; }
        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        /* Nav links active */
        .nav-links a.active { color: #c5a059; }

        /* Search wrapper for guest */
        .search-wrapper { background: #FFF; border: 1px solid #EEE; border-radius: 30px; padding: 8px 15px; display: flex; align-items: center; }
        .search-wrapper form { margin: 0; padding: 0; display: flex; align-items: center; gap: 10px; width: 100%; }
        .search-wrapper input { border: none; background: transparent; outline: none; width: 180px; font-size: 13px; }

        /* Active filter */
        .btn-filter.active { background: #1a1a1a; color: white; border-color: #1a1a1a; }
    </style>
</head>
<body>

    {{-- ===== NAVBAR GUEST ===== --}}
    <nav class="navbar-elixire">
        <div class="nav-content">
            <a href="{{ route('home') }}" class="nav-logo" style="text-decoration:none; color:#1a1a1a;">ÉLIXIRÉ</a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}">BERANDA</a></li>
                <li><a href="{{ route('produk.publik') }}" class="active">PRODUK</a></li>
            </ul>

            <div class="nav-right">
                <div class="search-wrapper">
                    <form action="{{ route('produk.publik') }}" method="GET">
                        <i class="fa-solid fa-magnifying-glass" style="color:#888;"></i>
                        <input type="text" name="query" placeholder="Cari parfum..."
                            value="{{ request('query') }}"
                            oninput="if(this.value === '') { window.location.href = '{{ route('produk.publik') }}'; }">
                    </form>
                </div>
                <div class="action-icons" style="align-items:center;">
                    <a href="{{ route('login') }}" class="btn-nav-login">LOGIN</a>
                    <a href="{{ route('register') }}" class="btn-nav-register">REGISTER</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="container">
        <div class="header-section">
            <h1>Our Collection</h1>
            @if(request('query'))
                <p>Menampilkan hasil pencarian untuk: <strong>"{{ request('query') }}"</strong></p>
            @else
                <p>Choose your perfect perfume</p>
            @endif
        </div>

        {{-- ===== Filter Kategori ===== --}}
        @if($categories->isNotEmpty())
        <div class="filter-group" style="flex-wrap:wrap;">
            <a href="{{ route('produk.publik') }}"
               class="btn-filter {{ !request('category') ? 'active' : '' }}"
               style="text-decoration:none;">SEMUA</a>
            @foreach($categories as $cat)
                <a href="{{ route('produk.publik', ['category' => $cat->id]) }}"
                   class="btn-filter {{ request('category') == $cat->id ? 'active' : '' }}"
                   style="text-decoration:none;">{{ strtoupper($cat->name) }}</a>
            @endforeach
        </div>
        @endif

        {{-- ===== Product Grid ===== --}}
        <div class="product-grid">
            @forelse($products as $product)
            <div class="item-card"
                 onclick="window.location.href='{{ route('detail.publik', $product->id) }}'"
                 style="cursor:pointer;">
                <div class="item-img">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}"
                         alt="{{ $product->name }}">
                </div>
                <div class="item-info">
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($product->rating ?? 4))★@else☆@endif
                        @endfor
                        <small>{{ number_format($product->rating ?? 4.0, 1) }}</small>
                    </div>
                    <h3 style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"
                        title="{{ $product->name }}">{{ $product->name }}</h3>
                    <p style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"
                       title="{{ $product->description }}">
                        {{ $product->description ?? 'Deskripsi parfum elegan ELIXIRE...' }}
                    </p>
                    <div class="card-bottom">
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a href="{{ route('detail.publik', $product->id) }}"
                           class="btn-lihat-card"
                           onclick="event.stopPropagation();">LIHAT</a>
                    </div>
                </div>
            </div>
            @empty
                <p style="grid-column: span 4; text-align:center; color:#888; padding:60px;">
                    Belum ada produk yang tersedia.
                </p>
            @endforelse
        </div>
    </div>

    {{-- ===== FOOTER (identik dengan user/produk.blade.php) ===== --}}
    <footer class="footer-luxury">
        <div class="footer-navbar">
            <!-- Branding -->
            <div class="footer-brand-side">
                <span class="footer-logo">ÉLIXIRÉ</span>
            </div>
            
            <!-- Quick Links -->
            <div class="footer-links-side">
                <ul class="horizontal-nav">
                    <li><a href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('cara-order') }}">Cara Order</a></li>
                </ul>
            </div>

            <!-- Socials & Copyright -->
            <div class="footer-right-side">
                <div class="footer-socials">
                    <a href="https://www.instagram.com/zelyn.09" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@lynnn.079" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Contact Info Bar -->
        <div class="footer-contact-wrapper">
            <div class="footer-contact-bar">
                <ul>
                    <li>
                        <a href="https://wa.me/6285385739017" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>0853-8573-9017</span>
                        </a>
                    </li>
                    <li>
                        <i class="fa-regular fa-envelope"></i>
                        <span>hello@elixire.com</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Jl. Wangi No. 12, Senayan, Jakarta Selatan.</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-copyright-bar">
            <p>&copy; 2026 ELIXIRÉ. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
