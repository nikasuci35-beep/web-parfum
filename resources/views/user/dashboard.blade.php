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
                <li><form method="POST" action="{{ route('logout') }}">@csrf<a href="beranda.blade.php" onclick="event.preventDefault(); this.closest('form').submit();">LOG OUT</a></form></li>
                <li><a href="#">JUAL</a></li>
                <li><a href="#">KATEGORI</a></li>
                <li><a href="#">TENTANG</a></li>
                <li><a href="{{ route('profile.index') }}">PROFIL</a></li>
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

    <div class="container-main">
        <header class="hero-card">
            <div class="hero-inner">
                <div class="hero-left">
                    <h1 class="welcome-text">SELAMAT DATANG, {{ strtoupper(auth()->user()->name) }}</h1>
                    <p class="hero-subtext">Bebas pilih produk Adda dan konnel setelek bervard. Terikukan sorma khae Baru Anda hari ini.</p>
                    <div class="hero-btns">
                        <button class="btn-gold-fill">Belanja</button>
                        <button class="btn-outline-gray">Lihat Keranjang</button>
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
                <div class="cat-box" style="background-image: url('https://images.unsplash.com/photo-1502736842968-bcaab72d0700?q=80&w=300')"><span>Floral</span></div>
                <div class="cat-box" style="background-image: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=300')"><span>Forest</span></div>
                <div class="cat-box" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=300')"><span>Water</span></div>
                <div class="cat-box" style="background-image: url('https://images.unsplash.com/photo-1595128484402-45a7698e66cb?q=80&w=300')"><span>Oud</span></div>
                <div class="cat-luxury-card">
                    <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=300" alt="">
                    <div class="lux-label">
                        <small>Parfume</small>
                        <strong>Luxury Collection</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="sec-wrap">
            <h2 class="playfair mb-30">REKOMENDASI UNTUKMU</h2>
            <div class="product-grid">
                @php
                    $items = [
                        ['n' => "Nuit d'Or", 'p' => '210.00', 'd' => 'The finest Perfum, Inforineous'],
                        ['n' => 'Saye Elhever', 'p' => '185.00', 'd' => 'Product Rose, H & Hagan, Mkan'],
                        ['n' => 'Oud Blanc', 'p' => '346.00', 'd' => 'White Oud, Vanila, Vamuer'],
                        ['n' => 'L’Amber Prex', 'p' => '195.00', 'd' => 'Lauer Amber, Gartienary, Teravura']
                    ];
                @endphp
                @foreach($items as $i)
                <div class="item-card">
                    <div class="item-img">
                        <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400" alt="">
                        <div class="heart-icon">♡</div>
                    </div>
                    <div class="item-info">
                        <div class="rating">★★★★★ <small>1100</small></div>
                        <h3>{{ $i['n'] }}</h3>
                        <p>{{ $i['d'] }}</p>
                        <div class="card-bottom">
                            <span class="price">${{ $i['p'] }}</span>
                            <button class="btn-add">ADD</button>
                        </div>
                    </div>
                </div>
                @endforeach
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

</body>
</html>