<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Order - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/caraorder.css') }}">
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
                <li><a href="{{ route('tentang-kami') }}">TENTANG KAMI</a></li>
                <li><a href="{{ route('cara-order') }}" style="color: #c5a059;">CARA ORDER</a></li>
            </ul>
        </div>
    </nav>

    <header class="page-header">
        <h1 class="playfair">Cara Order</h1>
        <p>Panduan langkah demi langkah untuk mendapatkan koleksi ÉLIXIRÉ Anda.</p>
    </header>

    <div class="steps-container">
        <!-- Step 1 -->
        <div class="step-item">
            <span class="step-number">01</span>
            <div class="step-icon">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <div class="step-content">
                <h2 class="playfair">Daftar atau Login</h2>
                <p>Mulai perjalanan Anda dengan membuat akun baru atau masuk ke akun yang sudah ada. Memiliki akun memudahkan Anda melacak status pesanan dan menyimpan alamat pengiriman.</p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step-item">
            <span class="step-number">02</span>
            <div class="step-icon">
                <i class="fa-solid fa-bottle-droplet"></i>
            </div>
            <div class="step-content">
                <h2 class="playfair">Pilih Parfum Anda</h2>
                <p>Jelajahi koleksi eksklusif kami. Pilih aroma yang mewakili karakter Anda, tentukan jumlahnya, dan tambahkan ke keranjang belanja.</p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="step-item">
            <span class="step-number">03</span>
            <div class="step-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="step-content">
                <h2 class="playfair">Checkout & Alamat</h2>
                <p>Periksa kembali isi keranjang Anda. Lanjutkan ke halaman checkout dan lengkapi detail alamat pengiriman serta pilih layanan ekspedisi yang tersedia.</p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="step-item">
            <span class="step-number">04</span>
            <div class="step-icon">
                <i class="fa-solid fa-credit-card"></i>
            </div>
            <div class="step-content">
                <h2 class="playfair">Pembayaran Aman</h2>
                <p>Selesaikan pembayaran melalui sistem Midtrans yang terpercaya. Kami mendukung berbagai metode mulai dari Transfer Bank, E-Wallet (Gopay/ShopeePay), hingga Kartu Kredit.</p>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="step-item">
            <span class="step-number">05</span>
            <div class="step-icon">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="step-content">
                <h2 class="playfair">Terima & Beri Ulasan</h2>
                <p>Setelah paket sampai, pastikan produk dalam kondisi baik. Jangan lupa untuk memberikan ulasan dan rating di halaman pesanan Anda untuk membantu pencinta parfum lainnya.</p>
            </div>
        </div>
    </div>

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
