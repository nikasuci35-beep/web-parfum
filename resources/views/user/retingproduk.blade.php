<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/retingproduk.css') }}">
</head>
<body>

    <div class="rating-container">
        <a href="{{ route('user.pesanan.detail', $order->id) }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> KEMBALI KE DETAIL PESANAN
        </a>

        <div class="rating-header">
            <h1>Beri Ulasan</h1>
            <p>Bagikan pengalaman Anda menggunakan produk ini.</p>
        </div>

        <div class="rating-card">
            <div class="product-preview">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=400' }}" alt="{{ $product->name }}">
                <div>
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->size ?? '100ml' }} • ÉLIXIRÉ Collector</p>
                </div>
            </div>

            @if($existingReview)
                <div style="text-align: center; padding: 20px;">
                    <div style="font-size: 40px; color: #c5a059; margin-bottom: 15px;">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-{{ $i <= $existingReview->rating ? 'solid' : 'regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <p style="font-style: italic; color: #555;">"{{ $existingReview->comment }}"</p>
                    <p style="margin-top: 20px; font-size: 13px; color: #888;">Ulasan Anda telah terkirim. Terima kasih!</p>
                </div>
            @else
                <form action="{{ route('user.reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="form-group" style="text-align: center; margin-top: 20px;">
                        <label style="margin-bottom: 20px; display: block; color: #888;">BERIKAN RATING</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required /><label for="star5" title="5 stars"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"><i class="fa-solid fa-star"></i></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tulis Ulasan Anda</label>
                        <textarea name="comment" class="luxury-textarea" placeholder="Bagikan apa yang Anda sukai dari aroma ini..."></textarea>
                    </div>

                    <button type="submit" class="btn-submit-rating">KIRIM ULASAN</button>
                </form>
            @endif
        </div>
    </div>

</body>
</html>
