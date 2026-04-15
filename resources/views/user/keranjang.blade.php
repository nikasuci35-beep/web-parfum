<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="{{ asset('css/keranjang.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="breadcrumb">BERANDA > KERANJANG BELANJA</div>
    
    <h1 class="cart-title">Keranjang Belanja</h1>
    <p class="cart-subtitle">Lihat pilihan belanja mu sebelum checkout.</p>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    <div class="cart-wrapper">
        <div class="cart-items">
            @php $subtotal = 0; @endphp
            @forelse($cartItems as $item)
                @php $subtotal += $item->product->price * $item->quantity; @endphp
                <div class="cart-item">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" class="item-img">
                    @else
                        <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400" class="item-img">
                    @endif
                    <div class="item-details">
                        <h3>{{ $item->product->name }}</h3>
                        <p>{{ $item->product->category->name ?? 'Fragrance' }} • {{ $item->quantity }} pcs</p>
                        <div class="qty-btn" style="margin-top: 10px;">
                            <form action="{{ route('user.keranjang.update', $item->id) }}" method="POST" style="display: contents;">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="decrease"><i class="fa-solid fa-minus"></i></button>
                                <span>{{ $item->quantity }}</span>
                                <button type="submit" name="action" value="increase"><i class="fa-solid fa-plus"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="item-price">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</div>
                    
                    <form action="{{ route('user.keranjang.remove', $item->id) }}" method="POST" class="delete-btn" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div style="text-align: center; padding: 40px; color: #888;">
                    <p>Keranjang belanja mu masih kosong.</p>
                    <a href="{{ route('user.produk') }}" style="color: #c5a059; text-decoration: underline; font-size: 0.9rem;">Mulai belanja sekarang</a>
                </div>
            @endforelse
        </div>

        <div class="order-summary">
            <h2>Rincian Pesanan</h2>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="summary-row">
                <span>Ongkir</span>
                <span style="font-size: 0.6rem; letter-spacing: 0;">GRATIS ONGKIR</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <a href="{{ route('user.checkout') }}" class="btn-checkout">SELESAIKAN PESANAN &rarr;</a>
            <a href="{{ route('user.produk') }}" class="btn-continue">LANJUT BELANJA</a>
            
            <p style="text-align: center; font-size: 0.6rem; color: #ccc; margin-top: 15px;">🛡 Secure SSL Encryption</p>
        </div>
    </div>
</div>

</body>
</html>