<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body class="bg-checkout">
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
                    <div class="icon-badge"><img src="{{ asset('image/logo_wa.png') }}" alt="WA" style="width: 20px; height: 20px; object-fit: contain;"></div>
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

    <main class="checkout-container">
        <div class="checkout-grid">
            <!-- Left Side: Forms -->
            <div class="checkout-form-side">
                <form id="checkout-form" action="{{ route('user.checkout.paylater') }}" method="POST">
                    @csrf
                    
                    <div class="checkout-section">
                        <div class="section-number">1</div>
                        <h2 class="section-title">INFORMASI KONTAK</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label>NAMA LENGKAP</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>EMAIL</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="julianne@luxury.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>NOMOR TELEPON</label>
                            <input type="text" name="phone" placeholder="+62 000-000-0000" required>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <div class="section-number">2</div>
                        <h2 class="section-title">DETAIL ALAMAT</h2>
                        <div class="form-group">
                            <label>ALAMAT LENGKAP</label>
                            <textarea name="address" rows="4" placeholder="Jl. Pegangsaan Timur, No 56, Jakarta" required></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Side: Order Summary -->
            <div class="order-summary-side">
                <div class="summary-card">
                    <h2 class="summary-title">Rincian Pesanan</h2>
                    
                    <div class="order-items">
                        @foreach($cartItems as $item)
                        <div class="order-item">
                            <div class="item-img">
                                <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}" alt="{{ $item->product->name }}">
                            </div>
                            <div class="item-details">
                                <div class="item-header">
                                    <h3>{{ $item->product->name }}</h3>
                                    <span class="item-price">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                                <p class="item-variant">50ML EDITION</p>
                                <p class="item-qty">Qty: {{ $item->quantity }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="summary-totals">
                        <div class="total-row">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row">
                            <span>Ongkir</span>
                            <span class="free">Free</span>
                        </div>
                        <div class="total-row grand-total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="checkout-actions">
                        <button type="submit" form="checkout-form" class="btn-pay-later">
                            TRANSFER MANUAL (BAYAR NANTI)
                        </button>
                        
                        <button type="button" class="pay-button btn-checkout"
                            data-price="{{ $total }}"
                            data-name="Pembelian Parfum ÉLIXIRÉ"
                            data-user-name="{{ Auth::user()->name }}"
                            data-user-email="{{ Auth::user()->email }}">
                            BAYAR SEKARANG (OTOMATIS)
                        </button>
                    </div>

                    <div class="secure-checkout">
                        <i class="fa-solid fa-lock"></i> SECURE ENCRYPTED CHECKOUT
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer-simple">
        <div class="footer-content">
            <span class="footer-logo"><i class="fa-solid fa-mountain"></i> ÉLIXIRÉ</span>
        </div>
    </footer>
    <script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js" 
    data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        const payButtons = document.querySelectorAll('.pay-button');
        
        payButtons.forEach(button => {
            button.addEventListener('click', function() {
                const price = this.getAttribute('data-price');
                const name = this.getAttribute('data-name');
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
                        item_name: name,
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
