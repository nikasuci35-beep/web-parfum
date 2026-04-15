<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ÉLIXIRÉ - Koleksi Wewangian</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header class="hero-section">
        <nav class="top-navigation">
            <div class="nav-left"></div>
            <div class="nav-center">
                <span class="logo-text">ÉLIXIRÉ</span>
            </div>
            <div class="nav-right">
                <form action="{{ route('search') }}" method="GET" style="background: rgba(255, 255, 255, 0.9); border: 1px solid #EEE; border-radius: 30px; padding: 8px 15px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-magnifying-glass" style="color: #888;"></i>
                    <input type="text" name="query" placeholder="Cari parfum..." value="{{ request('query') }}" oninput="if(this.value === '') { window.location.href = '{{ route('home') }}'; }" style="border: none; background: transparent; outline: none; width: 180px; font-size: 13px; color: #333;">
                </form>
            </div>
        </nav>

        <div class="hero-content" style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100vh; text-align:center;">
            <h1 style="font-size: 60px; font-family: 'Playfair Display';">Scent of Authority</h1>
            <h2 style="font-size: 45px; font-family: 'Playfair Display'; font-style: italic; font-weight: 400;">Unspoken Influence</h2>
            <p style="max-width: 600px; margin: 20px 0; font-weight: 300;">Racikan dari esensi pilihan dunia, ELIXIRÉ menghadirkan jejak yang terang, peresitat ELIXIRÉ, madah dijubakan.</p>
            
            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="button btn-gold">LOGIN</a>
                <a href="{{ route('register') }}" class="button btn-register">REGISTER</a>
            </div>
        </div>
    </header>

    <section class="collection-preview-section">
        <div class="collection-header">
            <div>
                <h2 style="font-family: 'Playfair Display'; font-size: 32px;">Koleksi</h2>
                <p style="color: #666; max-width: 500px;">Setiap botol tersimpan warisan craftsmanship sejati, disempurnakan oleh waktu.</p>
            </div>
            <a href="{{ route('produk.publik') }}" style="text-decoration:none; color:#1a1a1a; font-weight:700; font-size:12px; border-bottom:1px solid #ddd; padding-bottom:5px;">
                JELAJAHI SEMUANYA <i class="fa-solid fa-chevron-down"></i>
            </a>
        </div>

        <div class="product-grid-home">
            {{-- Mengambil hanya 3 produk pertama dari database --}}
            @foreach($products->take(3) as $product)
            <div class="item-card-home" onclick="window.location.href='{{ route('detail.publik', $product->id) }}'" style="cursor: pointer;">
                <div class="item-img-home">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400" alt="{{ $product->name }}">
                    @endif
                </div>
                <div class="item-info-home">
                    <div class="rating-home">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($product->rating ?? 4))★@else☆@endif
                        @endfor
                        <small>{{ number_format($product->rating ?? 4.0, 1) }}</small>
                    </div>
                    <h3 title="{{ $product->name }}">{{ $product->name }}</h3>
                    <p>{{ $product->description ?? 'Wewangian eksklusif ÉLIXIRÉ, racikan esensi terbaik dunia.' }}</p>
                    <div class="card-bottom-home">
                        <span class="price-home">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a href="{{ route('detail.publik', $product->id) }}" class="btn-lihat-home" onclick="event.stopPropagation();">LIHAT</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

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
        @if(request('header') || request('query'))
            document.addEventListener("DOMContentLoaded", function() {
                var el = document.querySelector('.collection-preview-section');
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            });
        @endif
    </script>
</body>
</html>