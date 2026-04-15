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

    <div class="container">
        <header class="category-header">
            <h1>Category</h1>
            <p>Find your perfect scent</p>
        </header>

        <div class="category-grid">
            @forelse($categories as $cat)
            <div class="category-card" onclick="window.location.href='{{ route('user.produk', ['category' => $cat->id]) }}'" style="cursor:pointer">
                <img src="{{ $cat->image ? asset('storage/'.$cat->image) : 'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?q=80&w=400' }}" alt="{{ $cat->name }}">
                <div class="category-overlay">
                    <h2>{{ $cat->name }}</h2>
                    <span>JELAJAHI &rarr;</span>
                </div>
            </div>
            @empty
                <div style="grid-column: 1/-1; text-align:center; padding: 40px; color: #888;">Belum ada kategori yang tersedia.</div>
            @endforelse
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
</body>
</html>