<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - ÉLIXIRÉ</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/success.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}"> <!-- Gunakan navbar dari checkout -->
</head>
<body>

    <main class="success-container">
        <div class="success-icon-wrapper">
            <i class="fa-solid fa-check"></i>
        </div>

        <h1 class="success-title">Terima Kasih atas Pesanan Anda!</h1>
        <p class="success-message">
            Wewangian Anda sedang dalam perjalanan. Kami telah menerima permintaan Anda dan para pengrajin kami sedang menyiapkan aroma khas ÉLIXIRÉ Anda untuk dikirim.
        </p>



        <div class="action-buttons">
            <a href="{{ route('user.pesanan') }}" class="btn-track">
                <i class="fa-solid fa-box"></i> PESANAN SAYA
            </a>
            <a href="{{ route('user.produk') }}" class="btn-continue">
                <i class="fa-solid fa-shopping-bag"></i> LANJUTKAN BELANJA
            </a>
        </div>
    </main>

    <footer class="footer-simple" style="margin-top: 100px; text-align: center; padding-bottom: 40px; border-top: 1px solid #eee;">
        <div class="footer-content" style="padding-top: 40px;">
            <span class="footer-logo">ÉLIXIRÉ</span>
            <div style="margin-top: 15px; font-size: 10px; color: #bbb;">
                <a href="#" style="margin: 0 10px; color: inherit; text-decoration: none;">PRIVASI</a>
                <a href="#" style="margin: 0 10px; color: inherit; text-decoration: none;">KETENTUAN</a>
            </div>
        </div>
    </footer>
</body>
</html>
