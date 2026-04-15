<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Paket - ÉLIXIRÉ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pesanan.css') }}"> {{-- For Navbar/Footer styles --}}
    <link rel="stylesheet" href="{{ asset('css/cekresi.css') }}">
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
            </ul>
        </div>
    </nav>

    <div class="tracking-container">
        <div class="tracking-header">
            <h1>Lacak Pesanan</h1>
            <p>Pantau perjalanan aroma eksklusif Anda hingga ke pintu rumah.</p>
        </div>

        <div class="tracking-card">
            <form action="{{ route('user.cekresi.check') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Kurir</label>
                    <select name="courier" class="luxury-select">
                        <option value="jne">JNE (Jalur Nugraha Ekakurir)</option>
                        <option value="jnt">J&T Express</option>
                        <option value="sicepat">SiCepat Ekspres</option>
                        <option value="tiki">TIKI</option>
                        <option value="spx">Shopee Express (SPX)</option>
                        <option value="anteraja">AnterAja</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nomor Resi (AWB)</label>
                    <input type="text" name="awb" class="luxury-input" placeholder="Contoh: JX123456789" required autocomplete="off" value="{{ old('awb') }}">
                </div>

                <div class="form-group">
                    <label>5 Digit Terakhir No. HP (Opsional)</label>
                    <input type="text" name="phone" class="luxury-input" placeholder="Khusus kurir tertentu (J&T)">
                </div>

                <button type="submit" class="btn-track">LACAK SEKARANG</button>
            </form>
        </div>

        @if(session('result'))
            @php $result = session('result'); @endphp
            
            <div class="result-section">
                @if(isset($result['status']) && $result['status'] == 200)
                    <div class="summary-card">
                        <div class="summary-header">
                            <div>
                                <small style="color: #aaa; text-transform: uppercase; font-size: 10px; font-weight: 700;">Nomor Resi</small>
                                <h3 style="margin-top: 5px;">{{ $result['data']['summary']['awb'] }}</h3>
                            </div>
                            <span class="status-label">{{ strtoupper($result['data']['summary']['status']) }}</span>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                            <div>
                                <small style="color: #aaa; font-size: 10px;">KURIR</small>
                                <p style="font-weight: 600; font-size: 14px;">{{ strtoupper($result['data']['summary']['courier']) }}</p>
                            </div>
                            <div>
                                <small style="color: #aaa; font-size: 10px;">PENERIMA</small>
                                <p style="font-weight: 600; font-size: 14px;">{{ $result['data']['detail']['receiver'] ?? 'Pelanggan ÉLIXIRÉ' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="summary-card">
                        <h3 style="margin-bottom: 25px; font-size: 16px;">Riwayat Pengiriman</h3>
                        <div class="history-list">
                            @foreach($result['data']['history'] as $index => $log)
                                <div class="history-item {{ $index == 0 ? 'latest' : '' }}">
                                    <span class="history-date">{{ \Carbon\Carbon::parse($log['date'])->format('d M Y, H:i') }}</span>
                                    <p class="history-desc">{{ $log['desc'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert-luxury">
                        <i class="fa-solid fa-circle-exclamation" style="margin-right: 10px;"></i>
                        Nomor resi tidak ditemukan atau terjadi kesalahan pada layanan kurir. Mohon periksa kembali nomor resi Anda.
                    </div>
                @endif
            </div>
        @endif
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
                    <li><i class="fa-brands fa-whatsapp"></i><span>0853-8573-9017</span></li>
                    <li><i class="fa-regular fa-envelope"></i><span>hello@elixire.com</span></li>
                    <li><i class="fa-solid fa-location-dot"></i><span>Jakarta, Indonesia</span></li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright-bar">
            <p>&copy; 2026 ELIXIRÉ. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>