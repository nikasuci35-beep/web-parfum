<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/tentangkami.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Unifikasi Navbar Style */
        .navbar-elixire { 
            background: #fff; 
            border-bottom: 1px solid #f0f0f0; 
            padding: 15px 5%; 
            position: sticky; 
            top: 0; 
            z-index: 1000;
        }
        .nav-content { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            max-width: 1400px; 
            margin: 0 auto; 
        }
        .nav-logo { 
            font-family: 'Playfair Display', serif; 
            font-size: 24px; 
            font-weight: 700; 
            letter-spacing: 2px; 
            text-decoration: none;
            color: #1a1a1a;
        }
        .nav-links { 
            display: flex; 
            list-style: none; 
            gap: 25px; 
            margin: 0;
            padding: 0;
        }
        .nav-links a { 
            text-decoration: none; 
            color: #888; 
            font-size: 11px; 
            font-weight: 700; 
            transition: 0.3s; 
        }
        .nav-links a:hover { color: #c5a059; }

        .footer-luxury { background: #111112; color: #fff; padding: 60px 0 20px; }
        .footer-navbar { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; padding: 0 40px 40px; }
        .footer-logo { font-family: 'Playfair Display', serif; font-size: 24px; letter-spacing: 4px; }
        .horizontal-nav { list-style: none; display: flex; gap: 30px; padding: 0; }
        .horizontal-nav a { color: #aaa; text-decoration: none; font-size: 13px; text-transform: uppercase; }
        .footer-socials { display: flex; gap: 20px; }
        .footer-socials a { color: #fff; font-size: 18px; }
        .footer-contact-wrapper { border-top: 1px solid rgba(255,255,255,0.05); padding: 40px 0; }
        .footer-contact-bar ul { list-style: none; display: flex; justify-content: center; gap: 50px; padding: 0; }
        .footer-contact-bar li { display: flex; align-items: center; gap: 10px; color: #bbb; font-size: 13px; }
        .footer-contact-bar i { color: #c6a75e; }
        .footer-copyright-bar { text-align: center; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.05); font-size: 11px; color: #555; }
    </style>
</head>
<body>

    <nav class="navbar-elixire">
        <div class="nav-content">
            <a href="{{ route('home') }}" class="nav-logo">ÉLIXIRÉ</a>
            <ul class="nav-links">
                @auth
                    <li><a href="{{ route('user.dashboard') }}">DASHBOARD</a></li>
                    <li><a href="{{ route('user.produk') }}">PRODUK</a></li>
                    <li><a href="{{ route('user.kategori') }}">KATEGORI</a></li>
                @else
                    <li><a href="{{ route('home') }}">BERANDA</a></li>
                    <li><a href="{{ route('produk.publik') }}">PRODUK</a></li>
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                @endauth
                <li><a href="{{ route('tentang-kami') }}" style="color: #c5a059;">TENTANG KAMI</a></li>
            </ul>
        </div>
    </nav>

    <header class="about-hero" style="background-image: url('{{ asset('storage/about_us_perfume_hero_1776146058051.png') }}')">
        <div class="hero-content">
            <p>Warisan Wangi Abadi</p>
            <h1 class="playfair">Scent of Authority</h1>
        </div>
    </header>

    <section class="section-wrap">
        <div class="side-by-side">
            <div class="side-text">
                <h2 class="playfair">Filosofi Kami</h2>
                <p>ÉLIXIRÉ lahir dari keinginan untuk menghadirkan lebih dari sekadar parfum. Kami percaya bahwa setiap aroma adalah pernyataan—sebuah otoritas yang tak terucapkan namun dirasakan oleh setiap jiwa yang melintasi jejaknya.</p>
                <p>Didirikan dengan dedikasi terhadap tradisi pembuatan parfum klasik, kami menggabungkan esensi langka dari Grasse, Prancis, dengan sentuhan modern yang berani untuk menciptakan karakter yang dominan, elegan, dan tak terlupakan.</p>
            </div>
            <div class="side-img">
                <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=800" alt="Philosophy">
            </div>
        </div>

        <div class="side-by-side">
            <div class="side-text">
                <h2 class="playfair">Craftsmanship Sejati</h2>
                <p>Setiap botol ÉLIXIRÉ adalah hasil dari ribuan jam penelitian dan kolaborasi dengan perfumer ahli. Kami hanya menggunakan bahan mentah berkualitas tinggi, mulai dari Oud eksotis hingga mawar Centifolia yang dipanen saat fajar.</p>
                <p>Proses maserasi yang panjang memastikan setiap molekul aroma menyatu dengan sempurna, menghasilkan performa wangi yang tahan lama dan evolusi aroma yang kompleks di kulit Anda.</p>
            </div>
            <div class="side-img">
                <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=800" alt="Craftsmanship">
            </div>
        </div>
    </section>

    <section class="section-wrap" style="background: #fff; text-align: center;">
        <h2 class="playfair" style="font-size: 2.5rem; margin-bottom: 50px;">Nilai-Nilai Utama Kami</h2>
        <div class="values-grid">
            <div class="value-card">
                <i class="fa-solid fa-gem"></i>
                <h3 class="playfair">Eksklusivitas</h3>
                <p>Kami memproduksi koleksi kami dalam kelompok kecil untuk menjaga kualitas dan eksklusivitas setiap aroma.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-leaf"></i>
                <h3 class="playfair">Etika & Kualitas</h3>
                <p>Komitmen kami terhadap bahan organik dan proses yang ramah lingkungan tanpa mengorbankan kemewahan.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-crown"></i>
                <h3 class="playfair">Otoritas</h3>
                <p>Memberdayakan setiap individu dengan wangi yang memberikan rasa percaya diri dan kontrol penuh.</p>
            </div>
        </div>
    </section>

    <footer class="footer-luxury">
        <div class="footer-navbar">
            <div class="footer-brand-side">
                <span class="footer-logo">ÉLIXIRÉ</span>
            </div>
            <div class="footer-links-side">
                <ul class="horizontal-nav">
                    <li><a href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('cara-order') }}">Cara Order</a></li>
                </ul>
            </div>
            <div class="footer-right-side">
                <div class="footer-socials">
                    <a href="https://www.instagram.com/zelyn.09" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@lynnn.079" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-contact-wrapper">
            <div class="footer-contact-bar">
                <ul>
                    <li>
                        <a href="https://wa.me/6285385739017" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>0853-8573-9017</span>
                        </a>
                    </li>
                    <li><i class="fa-regular fa-envelope"></i><span>hello@elixire.com</span></li>
                    <li><i class="fa-solid fa-location-dot"></i><span>Jl. Wangi No. 12, Senayan, Jakarta Selatan.</span></li>
                </ul>
            </div>
        </div>

        <div class="footer-copyright-bar">
            <p>&copy; 2026 ELIXIRÉ. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
