<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - ÉLIXIRÉ</title>
    <meta name="description" content="{{ Str::limit($product->description, 160) }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/detailproduk.css') }}">
    <style>
        /* ===== Guest CTA Box ===== */
        .guest-cta-box {
            background: linear-gradient(135deg, #f9f5ef, #fff8ee);
            border: 1px solid #e8d9c0;
            border-radius: 12px;
            padding: 28px 24px;
            text-align: center;
            margin-top: 10px;
        }
        .guest-cta-box .cta-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #c5a059, #a8864a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }
        .guest-cta-box .cta-icon i {
            color: #fff;
            font-size: 20px;
        }
        .guest-cta-box h4 {
            font-size: 14px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .guest-cta-box p {
            color: #777;
            font-size: 12.5px;
            margin-bottom: 20px;
            line-height: 1.7;
        }
        .guest-cta-box .cta-row {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn-cta-login {
            flex: 1;
            max-width: 160px;
            padding: 13px 0;
            background: #1a1a1a;
            color: #fff;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            letter-spacing: 1px;
            transition: all 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .btn-cta-login:hover { background: #333; color: #fff; transform: translateY(-1px); }
        .btn-cta-register {
            flex: 1;
            max-width: 160px;
            padding: 13px 0;
            background: linear-gradient(135deg, #c5a059, #a8864a);
            color: #fff;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            letter-spacing: 1px;
            transition: all 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .btn-cta-register:hover { background: linear-gradient(135deg, #a8864a, #8a6d3b); color: #fff; transform: translateY(-1px); }

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

        /* ===== Guest Banner Strip ===== */
        .guest-banner-strip {
            background: linear-gradient(90deg, #1a1a1a, #2d2d2d);
            color: #c5a059;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-align: center;
            padding: 10px;
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .guest-banner-strip a { color: #fff; text-decoration: underline; transition: 0.3s; }
        .guest-banner-strip a:hover { color: #c5a059; }

        .lux-card { cursor: pointer; }
    </style>
</head>
<body>

    <div class="guest-banner-strip">
        <i class="fa-solid fa-lock" style="font-size:10px;"></i>
        ANDA BELUM LOGIN &mdash; <a href="{{ route('login') }}">Masuk</a> atau <a href="{{ route('register') }}">Daftar</a> untuk berbelanja
    </div>

    <nav class="navbar-elixire">
        <div class="nav-content">
            <a href="{{ route('home') }}" class="nav-logo" style="text-decoration:none; color:#1a1a1a;">ÉLIXIRÉ</a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}">BERANDA</a></li>
                <li><a href="{{ route('produk.publik') }}">PRODUK</a></li>
            </ul>

            <div style="display:flex; align-items:center; gap:14px;">
                <div class="search-wrapper">
                    <form action="{{ route('produk.publik') }}" method="GET" style="display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="query" placeholder="Cari parfum..." value="{{ request('query') }}" oninput="if(this.value === '') { window.location.href = '{{ route('produk.publik') }}'; }">
                    </form>
                </div>
                <div style="display:flex; gap:10px;">
                    <a href="{{ route('login') }}" class="btn-nav-login">LOGIN</a>
                    <a href="{{ route('register') }}" class="btn-nav-register">REGISTER</a>
                </div>
            </div>
        </div>
    </nav>

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

                    <div class="guest-cta-box">
                        <div class="cta-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                        <h4>TAMBAHKAN KE KERANJANG</h4>
                        <p>Login atau daftar akun untuk menambahkan produk ini ke keranjang<br>dan melanjutkan pembelian Anda.</p>
                        <div class="cta-row">
                            <a href="{{ route('login') }}" class="btn-cta-login"><i class="fa-solid fa-arrow-right-to-bracket"></i> LOGIN</a>
                            <a href="{{ route('register') }}" class="btn-cta-register"><i class="fa-solid fa-user-plus"></i> DAFTAR</a>
                        </div>
                    </div>

                    <div class="guarantee" style="margin-top:20px;">
                        <span><i class="fa-solid fa-truck"></i> GRATIS ONGKIR</span>
                        <span><i class="fa-solid fa-shield"></i> 100% ORIGINAL</span>
                    </div>
                </div>
            </section>

            <section class="info-tabs">
                <div class="tab-header"><span class="tab-item active">ULASAN</span></div>
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

            @if($relatedProducts->isNotEmpty())
            <section class="related-products">
                <h2 class="playfair">Rekomendasi Lainnya</h2>
                <div class="item-grid-lux">
                    @foreach($relatedProducts as $rp)
                    <div class="lux-card" onclick="window.location.href='{{ route('detail.publik', $rp->id) }}'">
                        <div class="lux-img-box"><img src="{{ $rp->image ? asset('storage/'.$rp->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}" alt="{{ $rp->name }}"></div>
                        <div class="lux-details"><small>{{ $rp->categories->first()->name ?? 'Essence' }}</small><h4>{{ $rp->name }}</h4><span class="lux-price">Rp {{ number_format($rp->price, 0, ',', '.') }}</span></div>
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
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Cara Order</a></li>
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
