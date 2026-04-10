<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Exclusive Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboarduser.css') }}">
</head>
<body class="bg-light">

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
                    <form action="{{ route('user.dashboard') }}" method="GET" style="margin: 0; padding: 0;">
                        <input type="text" name="query" placeholder="Cari parfum..." value="{{ request('query') }}" oninput="if(this.value === '') { window.location.href = '{{ route('user.dashboard') }}'; }">
                    </form>
                </div>
                <div class="action-icons">
                    <div class="icon-badge">💬<span>0</span></div>
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

    <div class="container-main">
        <header class="hero-card">
            <div class="hero-inner">
                <div class="hero-left">
                    <h1 class="welcome-text">SELAMAT DATANG, {{ strtoupper(auth()->user()->name) }}</h1>
                    <p class="hero-subtext">Bebas pilih produk Adda dan konnel setelek bervard. Terikukan sorma khae Baru Anda hari ini.</p>
                    <div class="hero-btns">
                        <button class="btn-gold-fill">Belanja</button>
                        <a href="{{ route('user.keranjang') }}">
    <button class="btn-outline-gray">Lihat Keranjang</button>
</a>
                    </div>
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
                <a href="#" class="gold-link">JELAJAHI SEMUANYA</a>
            </div>
            <div class="category-flex">
                @foreach($categories->where('type', 'aroma')->take(4) as $cat)
                <div class="cat-box" style="background-image: url('{{ $cat->image ? asset('storage/'.$cat->image) : 'https://images.unsplash.com/photo-1502736842968-bcaab72d0700?q=80&w=300' }}')"><span>{{ $cat->name }}</span></div>
                @endforeach
                
                @if($luxuryCat = $categories->where('type', 'collection')->first())
                <div class="cat-luxury-card">
                    <img src="{{ $luxuryCat->image ? asset('storage/'.$luxuryCat->image) : 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=300' }}" alt="">
                    <div class="lux-label">
                        <small>Collection</small>
                        <strong>{{ $luxuryCat->name }}</strong>
                    </div>
                </div>
                @else
                <div class="cat-luxury-card">
                    <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=300" alt="">
                    <div class="lux-label">
                        <small>Parfume</small>
                        <strong>Luxury Collection</strong>
                    </div>
                </div>
                @endif
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
                <div class="item-card">
                    <div class="item-img">
                        <img src="{{ $p->image ? asset('storage/'.$p->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}" alt="{{ $p->name }}">
                        <div class="heart-icon">♡</div>
                    </div>
                    <div class="item-info">
                        <div class="rating">★★★★★ <small>{{ rand(500, 2500) }}</small></div>
                        <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $p->name }}">{{ $p->name }}</h3>
                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $p->description ?? 'Deskripsi parfum elegan ELIXIRE...' }}</p>
                        <div class="card-bottom">
                            <span class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                            <button class="btn-add">ADD</button>
                        </div>
                    </div>
                </div>
                @empty
                    <p style="grid-column: span 4; text-align: center; color: #888; padding: 50px;">Belum ada produk untuk ditampilkan.</p>
                @endforelse
            </div>
        </section>

        <section class="sec-wrap">
            <div class="sec-header">
                <h2 class="playfair">PEROLEHAN TERBARU</h2>
                <a href="#" class="dark-link">VIEW ALL DETAILS</a>
            </div>
            <div class="table-responsive">
                <table class="table-elix">
                    <thead>
                        <tr><th>DETAIL NMANE</th><th>FANLAYS</th><th>STATUS</th><th>STATUS</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="tbl-perfume">
                                    <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?q=80&w=50" alt="">
                                    <div><strong>Nuit d'Or samel</strong><br><small>DOSP1NOR N250</small></div>
                                </div>
                            </td>
                            <td>24-05-2023</td>
                            <td><span class="dot-gold"></span> Pailsat</td>
                            <td><a href="#" class="btn-retail">VIEW RETAIL</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <footer class="footer-black">
        <div class="footer-grid">
            <div class="f-col-logo">
                <h2 class="nav-logo">ÉLIXIRÉ</h2>
                <p>Kining kermitapan humous. nerine andi Kanton Deget. Tanra Barun pari yang Blu.</p>
                <div class="f-social">🐦 📸</div>
            </div>
            <div class="f-col">
                <h4>KONTAK</h4>
                <a href="#">Centa Kuut</a><a href="#">Cokak Wangi</a><a href="#">Ksialdan Katanari</a>
            </div>
            <div class="f-col">
                <h4>LAYANAN PELANGGAN</h4>
                <a href="#">Pengimam & Penganggaan</a><a href="#">Kather Kantus</a><a href="#">Laver Calemina</a>
            </div>
            <div class="f-col">
                <h4>DAFTAR MENJADI PENJUAL</h4>
                <p>Hlight meniyadi panjuails? Hotail mootbud yar pitome?</p>
                <div class="subscribe-box">
                    <input type="email" placeholder="E-mail">
                    <button>SENTAR</button>
                </div>
            </div>
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