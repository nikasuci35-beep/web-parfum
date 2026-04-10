<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/keranjang.css') }}">
</head>
<body>

<div class="container">
    <div class="breadcrumb">BERANDA > KERANJANG BELANJA</div>
    
    <h1 class="cart-title">Keranjang Belanja</h1>
    <p class="cart-subtitle">Lihat pilihan belanja mu sebelum checkout.</p>

    <div class="cart-wrapper">
        <div class="cart-items">
            <div class="cart-item">
                <img src="{{ asset('images/product1.jpg') }}" class="item-img">
                <div class="item-details">
                    <h3>Oud Nocturne</h3>
                    <p>Eau de Parfum • 100ml</p>
                    <div class="qty-btn">
                        <button>-</button>
                        <span>1</span>
                        <button>+</button>
                    </div>
                </div>
                <div class="item-price">$285.00</div>
                <div class="delete-btn">🗑</div>
            </div>

            <div class="cart-item">
                <img src="{{ asset('images/product2.jpg') }}" class="item-img">
                <div class="item-details">
                    <h3>Rose Solaire</h3>
                    <p>Extrait de Parfum • 50ml</p>
                    <div class="qty-btn">
                        <button>-</button>
                        <span>1</span>
                        <button>+</button>
                    </div>
                </div>
                <div class="item-price">$195.00</div>
                <div class="delete-btn">🗑</div>
            </div>
        </div>

        <div class="order-summary">
            <h2>Rincian Pesanan</h2>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>$480.00</span>
            </div>
            <div class="summary-row">
                <span>Diskon</span>
                <span style="color: #27ae60;">-$0.00</span>
            </div>
            <div class="summary-row">
                <span>Ongkir</span>
                <span style="font-size: 0.6rem; letter-spacing: 0;">CALCULATED AT NEXT STEP</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>$480.00</span>
            </div>

            <div class="promo-section">
                <input type="text" class="promo-input" placeholder="Kode Promo">
                <button class="btn-apply">APPLY</button>
            </div>

            <a href="#" class="btn-checkout">SELESAIKAN PESANAN &rarr;</a>
            <a href="{{ route('user.produk') }}" class="btn-continue">LANJUT BELANJA</a>
            
            <p style="text-align: center; font-size: 0.6rem; color: #ccc; margin-top: 15px;">🛡 Secure SSL Encryption</p>
        </div>
    </div>
</div>

</body>
</html>