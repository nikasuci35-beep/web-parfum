<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Exclusive Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboarduser.css') }}">
</head>
<body class="bg-light">
    @if(session('success'))
        <div style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: #1a1a1a; color: #fff; padding: 15px 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); animation: slideIn 0.5s ease-out;">
            <i class="fa-solid fa-check-circle" style="color: #c5a059; margin-right: 10px;"></i>
            {{ session('success') }}
        </div>
        <style>
            @keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }
        </style>
        <script>
            setTimeout(() => {
                const el = document.querySelector('[style*="position: fixed"]');
                if (el) el.style.opacity = '0';
                setTimeout(() => el?.remove(), 500);
            }, 3000);
        </script>
    @endif

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
                            <span>LOGOUT</span>
                        </a></li>
            </ul>
            <div class="nav-right">
                <div class="search-wrapper" style="background: #FFF; border: 1px solid #EEE; border-radius: 30px; padding: 8px 15px; display: flex; align-items: center;">
                    <form action="{{ route('user.produk') }}" method="GET" style="margin: 0; padding: 0; display: flex; align-items: center; gap: 10px; width: 100%;">
                        <i class="fa-solid fa-magnifying-glass" style="color: #888;"></i>
                        <input type="text" name="query" placeholder="Cari parfum..." value="{{ request('query') }}" oninput="if(this.value === '') { window.location.href = '{{ route('user.produk') }}'; }" style="border: none; background: transparent; outline: none; width: 180px; font-size: 13px;">
                    </form>
                </div>
                <div class="action-icons" style="align-items: center;">
                    <a href="https://wa.me/6285385739017" target="_blank" style="text-decoration: none;">
                        <div class="icon-badge"><img src="{{ asset('image/logo_wa.png') }}" alt="WA" style="width: 20px; height: 20px; object-fit: contain;"></div>
                    </a>
                    <a href="{{ route('user.keranjang') }}" style="text-decoration: none; color: inherit;">
                        <div class="icon-badge">
                            <img src="{{ asset('image/keranjang.png') }}" alt="Keranjang" style="width: 20px; height: 20px; object-fit: contain;">
                            @if($cartCount > 0)
                                <span style="position: absolute; top: -5px; right: -8px; background: #000; color: #fff; font-size: 9px; padding: 1px 4px; border-radius: 50%;">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
                            @endif
                        </div>
                    </a>
                </div>
                <div class="user-pill" style="display: flex; align-items: center; gap: 10px; padding-left: 15px; border-left: 1px solid #eee;">
                    <div class="user-meta" style="text-align: right; line-height: 1.2;">
                        <strong style="display: block; font-size: 13px;">{{ Auth::user()->name }}</strong>
                        <small style="font-size: 10px; color: #888;">{{ ucfirst(Auth::user()->role ?? 'User') }}</small>
                    </div>
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Photo" class="sidebar-avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=C5A059&color=fff" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%;">
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <header class="hero-card">
            <div class="hero-inner">
                <div class="hero-left">
                    <h1 class="welcome-text">SELAMAT DATANG, {{ strtoupper(auth()->user()->name) }}</h1>
                    <p class="hero-subtext">Bebas pilih produk Adda dan konnel setelek bervard. Terikukan sorma khae Baru Anda hari ini.</p>

                </div>
                <div class="hero-right">
                    <div class="perfume-frame">
                        <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?q=80&w=400" alt="Perfume">
                    </div>
                </div>
            </div>
        </header>

        <section class="sec-wrap">
            <div class="sec-header">
                <h2 class="playfair">PILIH KATEGORI</h2>
                <a href="{{ route('user.kategori') }}" class="gold-link">JELAJAHI SEMUANYA</a>
            </div>
            <div class="category-flex">
                @foreach($categories->where('type', '!=', 'collection')->take(5) as $cat)
                <a href="{{ route('user.produk', ['category' => $cat->id]) }}" class="cat-link" style="text-decoration: none;">
                    <div class="cat-box" style="background-image: url('{{ $cat->image ? asset('storage/'.$cat->image) : 'https://images.unsplash.com/photo-1502736842968-bcaab72d0700?q=80&w=300' }}')">
                        <span>{{ $cat->name }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        <section class="sec-wrap" id="rekomendasi-produk" style="scroll-margin-top: 100px;">
            <h2 class="playfair mb-30">
                REKOMENDASI UNTUKMU
                @if(request('query'))
                    <span style="font-size:16px; font-weight:normal; color:#888; text-transform:none;">- Hasil pencarian untuk: "{{ request('query') }}"</span>
                @endif
            </h2>
            <div class="product-grid">
                @forelse($products as $p)
                <div class="item-card" onclick="window.location.href='{{ route('user.detailproduk', $p->id) }}'" style="cursor: pointer;">
                    <div class="item-img">
                        <img src="{{ $p->image ? asset('storage/'.$p->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}" alt="{{ $p->name }}">
                    </div>
                    <div class="item-info">
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($p->rating))★@else☆@endif
                            @endfor
                            <small>{{ number_format($p->rating, 1) }}</small>
                        </div>
                        <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $p->name }}">{{ $p->name }}</h3>
                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $p->description ?? 'Deskripsi parfum elegan ELIXIRE...' }}</p>
                        <div class="card-bottom">
                            <span class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                            <form action="{{ route('user.keranjang.add') }}" method="POST" onclick="event.stopPropagation();">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                <button type="submit" class="btn-add">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                    <p style="grid-column: span 4; text-align: center; color: #888; padding: 50px;">Belum ada produk untuk ditampilkan.</p>
                @endforelse
            </div>
        </section>

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
        // Auto scroll ke bagian produk setelah pencarian (seperti fitur admin dashboard)
        @if(request('query'))
            document.addEventListener("DOMContentLoaded", function() {
                var el = document.getElementById('rekomendasi-produk');
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            });
        @endif
    </script>
</body>
</html>