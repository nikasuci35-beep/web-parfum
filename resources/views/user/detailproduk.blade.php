<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - ÉLIXIRÉ</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/detailproduk.css') }}">
    <style>
        /* Guest CTA Box */
        .guest-cta-box {
            background: linear-gradient(135deg, #f9f5ef, #fff8ee);
            border: 1px solid #e8d9c0;
            border-radius: 12px;
            padding: 22px 24px;
            text-align: center;
            margin-top: 10px;
        }
        .guest-cta-box p {
            color: #666;
            font-size: 13px;
            margin-bottom: 16px;
            line-height: 1.6;
        }
        .guest-cta-box .cta-row {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn-cta-login {
            flex: 1;
            max-width: 160px;
            padding: 12px 0;
            background: #1a1a1a;
            color: #fff;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            letter-spacing: 0.5px;
            transition: 0.3s;
        }
        .btn-cta-login:hover { background: #333; color: #fff; }
        .btn-cta-register {
            flex: 1;
            max-width: 160px;
            padding: 12px 0;
            background: #c5a059;
            color: #fff;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            letter-spacing: 0.5px;
            transition: 0.3s;
        }
        .btn-cta-register:hover { background: #a8864a; color: #fff; }

        /* Guest navbar additions */
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
    </style>
</head>
<body>

    @if(session('success'))
        <div class="flash-notif" id="flash-msg">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar-elixire">
        <div class="nav-content">
            <div class="nav-logo">ÉLIXIRÉ</div>

            @auth
                {{-- Navbar untuk user yang sudah login --}}
                <ul class="nav-links">
                    <li><a href="{{ route('user.dashboard') }}">DASHBOARD</a></li>
                    <li><a href="{{ route('user.produk') }}">PRODUK</a></li>
                    <li><a href="{{ route('user.kategori') }}">KATEGORI</a></li>
                    <li><a href="{{ route('user.pesanan') }}">PESANAN SAYA</a></li>
                    <li><a href="{{ route('profile.index') }}">PROFIL</a></li>
                    <li>
                        <form id="logout-form-detail" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-detail').submit();">LOGOUT</a>
                    </li>
                </ul>
                <div class="nav-right">
                    <div class="search-wrapper">
                        <form action="{{ route('user.produk') }}" method="GET">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" name="query" placeholder="Cari parfum..." value="{{ request('query') }}">
                        </form>
                    </div>
                    <div class="action-icons">
                        <a href="https://wa.me/6285385739017" target="_blank" style="text-decoration: none;">
                            <div class="icon-badge"><img src="{{ asset('image/logo_wa.png') }}" alt="WA" style="width: 20px; height: 20px; object-fit: contain;"></div>
                        </a>
                        <div class="icon-badge">
                            <a href="{{ route('user.keranjang') }}">
                                <img src="{{ asset('image/keranjang.png') }}" style="width:20px;">
                                @if(isset($cartCount) && $cartCount > 0)
                                    <span>{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="user-pill">
                        <div class="user-meta">
                            <strong>{{ Auth::user()->name }}</strong>
                            <small>{{ ucfirst(Auth::user()->role) }}</small>
                        </div>
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=C5A059&color=fff" alt="User">
                        @endif
                    </div>
                </div>
            @else
                {{-- Navbar untuk guest (belum login) --}}
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">BERANDA</a></li>
                    <li><a href="{{ route('produk.publik') }}">PRODUK</a></li>
                </ul>
                <div style="display:flex; align-items:center; gap:12px;">
                    <a href="{{ route('login') }}" class="btn-nav-login">LOGIN</a>
                    <a href="{{ route('register') }}" class="btn-nav-register">REGISTER</a>
                </div>
            @endauth
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="main-wrapper">
        <div class="content-container">

            <section class="product-top-row">
                <div class="product-gallery">
                    <div class="main-frame">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400" alt="{{ $product->name }}">
                        @endif
                    </div>
                </div>

                <div class="product-info-panel">
                    <h1 class="playfair">{{ $product->name }}</h1>
                    <div class="price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

                    <div class="size-display" style="font-size:13px; font-weight:700; color:#888; margin-bottom:25px; letter-spacing:1px;">
                        UKURAN: <span style="color:#1a1a1a;">{{ $product->size ?? 'N/A' }}</span>
                    </div>

                    <p class="summary-text">{{ $product->description }}</p>

                    <div class="detail-box">
                        <label>DETAIL PRODUK</label>
                        <div class="cat-labels">
                            @foreach($product->categories as $cat)
                                <div class="cat-pill">
                                    <small>{{ strtoupper($cat->type) }}</small>
                                    <span>{{ $cat->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- ===== AKSI BELI: berbeda antara auth dan guest ===== --}}
                    @auth
                        <div class="buy-actions">
                            <form action="{{ route('user.keranjang.add') }}" method="POST" class="add-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn-buy-now">
                                    <i class="fa-solid fa-cart-shopping"></i> TAMBAHKAN KE KERANJANG
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="guest-cta-box">
                            <p>
                                <i class="fa-solid fa-cart-shopping" style="color:#c5a059; margin-right:6px;"></i>
                                Login atau daftar untuk menambahkan produk ini ke keranjang dan melanjutkan pembelian.
                            </p>
                            <div class="cta-row">
                                <a href="{{ route('login') }}" class="btn-cta-login">
                                    <i class="fa-solid fa-arrow-right-to-bracket" style="margin-right:5px;"></i> LOGIN
                                </a>
                                <a href="{{ route('register') }}" class="btn-cta-register">
                                    <i class="fa-solid fa-user-plus" style="margin-right:5px;"></i> DAFTAR SEKARANG
                                </a>
                            </div>
                        </div>
                    @endauth

                    <div class="guarantee" style="margin-top:20px;">
                        <span><i class="fa-solid fa-truck"></i> GRATIS ONGKIR</span>
                        <span><i class="fa-solid fa-shield"></i> 100% ORIGINAL</span>
                    </div>
                </div>
            </section>

            {{-- Tabs --}}
            <section class="info-tabs">
                <div class="tab-header">
                    <span class="tab-item active">ULASAN</span>
                </div>
                <div class="tab-body" style="padding: 30px; background: #fff; border-radius: 12px; border: 1px solid #eef0f2; margin-top: 15px;">
                    <div class="review-summary" style="text-align: center; margin-bottom: 30px;">
                        <h2 style="font-size: 3rem; margin: 0; color: #1a1a1a;">{{ number_format($product->rating, 1) }}</h2>
                        <div class="stars" style="color: #c5a059; font-size: 1.2rem; margin: 5px 0;">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($product->rating))
                                    <i class="fa-solid fa-star"></i>
                                @elseif ($i == ceil($product->rating) && $product->rating - floor($product->rating) > 0)
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p style="color: #777; font-size: 14px;">Rating Produk</p>
                    </div>
                    
                    <div class="review-list" style="text-align: center; color: #999; padding: 20px 0;">
                        <i class="fa-regular fa-comment-dots" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                        <p style="font-size: 14px;">Belum ada ulasan tertulis untuk produk ini.</p>
                    </div>
                </div>
            </section>

            {{-- Related Products --}}
            @if($relatedProducts->isNotEmpty())
            <section class="related-products">
                <h2 class="playfair">Rekomendasi Lainnya</h2>
                <div class="item-grid-lux">
                    @foreach($relatedProducts as $rp)
                    <div class="lux-card" onclick="window.location.href='{{ route('detail.publik', $rp->id) }}'">
                        <div class="lux-img-box">
                            <img src="{{ $rp->image ? asset('storage/'.$rp->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}" alt="{{ $rp->name }}">
                        </div>
                        <div class="lux-details">
                            <small>{{ $rp->categories->first()->name ?? 'Essence' }}</small>
                            <h4>{{ $rp->name }}</h4>
                            <span class="lux-price">Rp {{ number_format($rp->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

        </div>
    </div>

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

    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-msg');
            if (msg) msg.style.display = 'none';
        }, 3000);
    </script>
</body>
</html>
