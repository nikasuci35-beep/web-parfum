<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/pesanan.css') }}">
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
    <header>
        <h1>Pesanan Saya</h1>
        <p>Kelola semua pesanan Anda dengan mudah dalam satu ruang kurasi.</p>
    </header>

    <nav class="filter-tabs">
        <a href="{{ route('user.pesanan') }}" class="{{ !request('status') ? 'active' : '' }}">SEMUA</a>
        <a href="{{ route('user.pesanan', ['status' => 'menunggu']) }}" class="{{ request('status') == 'menunggu' ? 'active' : '' }}">BELUM DIBAYAR</a>
        <a href="{{ route('user.pesanan', ['status' => 'dikemas']) }}" class="{{ request('status') == 'dikemas' ? 'active' : '' }}">DIKEMAS</a>
        <a href="{{ route('user.pesanan', ['status' => 'dikirim']) }}" class="{{ request('status') == 'dikirim' ? 'active' : '' }}">DIKIRIM</a>
        <a href="{{ route('user.pesanan', ['status' => 'selesai']) }}" class="{{ request('status') == 'selesai' ? 'active' : '' }}">SELESAI</a>
        <a href="{{ route('user.pesanan', ['status' => 'dibatalkan']) }}" class="{{ request('status') == 'dibatalkan' ? 'active' : '' }}">BATAL</a>
    </nav>

    <div class="order-list">
        @forelse($orders as $order)
            <div class="order-card">
                <div class="card-content">
                    @php
                        $firstItem = $order->items->first();
                        $otherItemsCount = $order->items->count() - 1;
                    @endphp
                    <div class="product-img">
                        @if($firstItem && $firstItem->product->image)
                            <img src="{{ asset('storage/'.$firstItem->product->image) }}" alt="Preview">
                        @else
                            <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400" alt="Preview">
                        @endif
                    </div>
                    <div class="product-details">
                        <div class="badge-row">
                            <span class="order-id">#{{ $order->order_number }}</span>
                            @php
                                $statusClass = [
                                    'menunggu' => 'status-menunggu',
                                    'dibayar' => 'status-proses',
                                    'diproses' => 'status-proses',
                                    'dikirim' => 'status-dikirim',
                                    'selesai' => 'status-selesai',
                                    'dibatalkan' => 'status-dibatalkan'
                                ][$order->status] ?? 'status-proses';
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ strtoupper($order->status) }}</span>
                        </div>
                        <h3>{{ $firstItem ? $firstItem->product->name : 'Produk Tidak Ditemukan' }}</h3>
                        @if($otherItemsCount > 0)
                            <div class="other-items-label">+ {{ $otherItemsCount }} produk lainnya</div>
                        @else
                            <div class="desc">{{ $firstItem ? ($firstItem->product->description ?? 'Eau De Parfum') : '' }}</div>
                        @endif
                        <div class="price-row">
                            <span class="qty">TOTAL: {{ $order->items->count() }} Item</span>
                            <span class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-actions">
                    <div class="info-date">
                        <label>{{ $order->status == 'selesai' ? 'SELESAI PADA' : 'TANGGAL PESANAN' }}</label>
                        <span>{{ $order->created_at->format('d F Y') }}</span>
                    </div>
                    <div class="button-group">
                        <a href="{{ route('user.pesanan.detail', $order->id) }}" class="btn-secondary" style="text-decoration: none;">DETAIL</a>
                        @if($order->status == 'menunggu')
                            <button class="btn-gold btn-pay-orders pay-now"
                                data-price="{{ $order->total_price }}"
                                data-user-name="{{ Auth::user()->name }}"
                                data-user-email="{{ Auth::user()->email }}">BAYAR</button>
                            <form action="{{ route('user.pesanan.cancel', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-outline-cancel" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">BATALKAN</button>
                            </form>
                        @elseif($order->status == 'dibayar')
                            <a href="{{ route('user.cekresi.index') }}" class="btn-dark" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">LACAK</a>
                        @elseif($order->status == 'selesai')
                            <a href="{{ route('user.pesanan.detail', $order->id) }}" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">BERI ULASAN</a>
                            <button class="btn-secondary">BELI LAGI</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 50px; color: #888;">
                <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 20px;"></i>
                <p>Belum ada pesanan.</p>
                <a href="{{ route('user.produk') }}" style="color: var(--primary-gold); font-weight: 700; text-decoration: none; margin-top: 10px; display: inline-block;">MULAI BELANJA</a>
            </div>
        @endforelse
    </div>

    <!-- Banner and Footer remains... -->

    <div class="loyalty-banner">
        <div class="banner-text">
            <span class="label">THE LOYALTY CLUB</span>
            <h2>Keistimewaan dalam Setiap Semprotan.</h2>
            <p>Dapatkan akses eksklusif ke koleksi Atelier kami dan undangan pre-order untuk rilisan terbatas.</p>
            <button class="btn-banner">PELAJARI LEBIH LANJUT</button>
        </div>
        <div class="banner-graphic">
            <div class="text-overlay">PRAMO</div>
        </div>
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

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        const payNowButtons = document.querySelectorAll('.pay-now');
        
        payNowButtons.forEach(button => {
            button.addEventListener('click', function() {
                const price = this.getAttribute('data-price');
                const userName = this.getAttribute('data-user-name');
                const userEmail = this.getAttribute('data-user-email');

                fetch('/get-snap-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        price: price,
                        item_name: "Pembayaran Pesanan ÉLIXIRÉ",
                        name: userName,
                        email: userEmail
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error: ' + data.error);
                        return;
                    }

                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            alert("Pembayaran Berhasil!");
                            window.location.href = "{{ route('user.checkout.success') }}";
                        },
                        onPending: function(result) {
                            alert("Selesaikan pembayaran Anda di gerai/bank.");
                        },
                        onError: function(result) {
                            alert("Pembayaran Gagal.");
                        }
                    });
                })
                .catch(err => {
                    console.error('Fetch Error:', err);
                    alert("Gagal menghubungi server pembayaran.");
                });
            });
        });
    </script>
</body>
</html>