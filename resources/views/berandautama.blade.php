<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ÉLIXIRÉ - Koleksi Wewangian</title>
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
                <i class="fa-solid fa-magnifying-glass" style="cursor:pointer"></i>
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
            <a href="#" style="text-decoration:none; color:#1a1a1a; font-weight:700; font-size:12px; border-bottom:1px solid #ddd; padding-bottom:5px;">
                JELAJAHI SEMUANYA <i class="fa-solid fa-chevron-down"></i>
            </a>
        </div>

        <div class="product-grid">
            {{-- Mengambil hanya 3 produk pertama dari database --}}
            @foreach($products->take(3) as $product)
            <div class="product-card">
                <div class="image-box">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x500" alt="Sample">
                    @endif
                </div>
                <h4>{{ $product->name }}</h4>
                <p class="meta">SPRING / SUMMER</p>
                <p style="font-weight:700; color:#c6a75e; margin-top:5px;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-item">
                <p style="font-size:10px; color:#c6a75e; letter-spacing:2px;">HARUM MENAWAN</p>
                <h3>50+</h3>
                <div class="gold-divider"></div>
            </div>
            <div class="stat-item">
                <p style="font-size:10px; color:#c6a75e; letter-spacing:2px;">BOTOL KLASIK</p>
                <h3>12</h3>
                <div class="gold-divider"></div>
            </div>
            <div class="stat-item">
                <p style="font-size:10px; color:#c6a75e; letter-spacing:2px;">WARISAN BERNAGA</p>
                <h3>25+</h3>
                <div class="gold-divider"></div>
            </div>
        </div>
    </section>

</body>
</html>