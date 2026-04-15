<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->order_number }} - ÉLIXIRÉ</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/detailpesanan.css') }}">
</head>
<body>



    <div class="main-container">
        <header class="order-header">
            <div class="header-left">
                <a href="{{ route('user.pesanan') }}" class="back-link"><i class="fa-solid fa-arrow-left"></i> KEMBALI KE PESANAN</a>
                <h1>Pesanan #{{ $order->order_number }}</h1>
                <p>Terima kasih atas kepercayaan Anda pada ÉLIXIRÉ.</p>
            </div>
            <div class="header-right">
                <div class="status-glass">
                    <span class="dot {{ $order->status }}"></span>
                    <span class="txt-status">{{ strtoupper($order->status) }}</span>
                </div>
            </div>
        </header>

        <div class="order-grid">
            {{-- Bagian Kiri: Daftar Produk --}}
            <section class="order-items-section">
                <h3 class="section-title">Produk yang Dipesan</h3>
                <div class="items-list">
                    @foreach($order->items as $item)
                    <div class="item-card">
                        <div class="item-img">
                            <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}" alt="{{ $item->product->name }}">
                        </div>
                        <div class="item-info">
                            <h4>{{ $item->product->name }}</h4>
                            <p class="item-meta">{{ $item->product->size ?? '100ml' }}</p>
                            <div class="item-price-qty">
                                <span class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                <span class="qty">x{{ $item->quantity }}</span>
                            </div>
                            @if($order->status == 'selesai')
                                <a href="{{ route('user.reviews.index', ['order_id' => $order->id, 'product_id' => $item->product_id]) }}" 
                                   class="btn-review" 
                                   style="display: inline-block; margin-top: 10px; font-size: 10px; font-weight: 700; color: #c5a059; text-decoration: none; text-transform: uppercase; border: 1px solid #c5a059; padding: 5px 12px; border-radius: 4px; transition: 0.3s;">
                                   <i class="fa-solid fa-star" style="margin-right: 5px;"></i> BERI ULASAN
                                </a>
                            @endif
                        </div>
                        <div class="item-total">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            {{-- Bagian Kanan: Detail Pengiriman & Pembayaran --}}
            <aside class="order-sidebar">
                <div class="info-card">
                    <h3 class="section-title">Informasi Pengiriman</h3>
                    <div class="info-group">
                        <label>Penerima</label>
                        <p><strong>{{ Auth::user()->name }}</strong></p>
                    </div>
                    <div class="info-group">
                        <label>Telepon</label>
                        <p>{{ Auth::user()->phone ?? '-' }}</p>
                    </div>
                    <div class="info-group">
                        <label>Alamat</label>
                        <p>{{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div class="info-card payment-summary">
                    <h3 class="section-title">Ringkasan Pembayaran</h3>
                    <div class="summary-row">
                        <span>Subtotal Produk</span>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Pengiriman</span>
                        <span>Gratis</span>
                    </div>
                    <hr>
                    <div class="summary-row total">
                        <span>Total Belanja</span>
                        <span class="amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="sidebar-actions">
                    @if($order->status == 'selesai')
                        <button class="btn-primary-lux">BELI LAGI</button>
                    @endif
                    @if($order->status == 'dibayar' || $order->status == 'dikirim' || $order->status == 'diproses')
                        <a href="{{ route('user.cekresi.index') }}" class="btn-primary-lux" style="text-decoration: none; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; background: #111;">LACAK PESANAN</a>
                    @endif
                    <a href="https://wa.me/6285385739017?text=Halo%20ÉLIXIRÉ,%20saya%20ingin%20bertanya%20mengenai%20pesanan%20saya%20dengan%20nomor%20%23{{ $order->order_number }}" target="_blank" class="btn-secondary-lux">HUBUNGI PENJUAL</a>
                </div>
            </aside>
        </div>
    </div>

    <footer class="footer-luxury">
        <div class="footer-copyright">
            <p>&copy; 2026 ÉLIXIRÉ. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
