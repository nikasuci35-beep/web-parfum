<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Daftar Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardadmin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html { scroll-behavior: smooth; }
        .dot-indicator { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .bg-green  { background: #2ecc71; }
        .bg-yellow { background: #f1c40f; }
        .bg-grey   { background: #34495e; }
        .bg-red    { background: #e74c3c; }
        .bg-blue   { background: #3498db; }

        .flash-alert {
            position: fixed; top: 20px; right: 20px; z-index: 99999;
            padding: 14px 22px; border-radius: 12px;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            animation: slideIn .4s ease;
        }
        .flash-success { background: #1a1a1a; color: #fff; border-left: 4px solid #C5A059; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(60px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .status-select {
            padding: 5px 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 12px;
            font-family: 'Poppins', sans-serif;
            background: #fff;
            cursor: pointer;
            outline: none;
        }
        .status-select:focus { border-color: #C5A059; }
    </style>
</head>
<body>

    @if(session('success'))
        <div class="flash-alert flash-success" id="flashMsg">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="mobile-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h1>ÉLIXIRÉ</h1>
                <p>LUXURY PERFUMES</p>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-house-chimney"></i> Dashboard
                        </a>
                    </li>
                    <li><a href="{{ route('admin.dashboard') }}#produk-anda"><i class="fa-solid fa-box-open"></i> Produk Anda</a></li>
                    <li><a href="{{ route('admin.dashboard') }}#manage-categories"><i class="fa-solid fa-tags"></i> Jenis Kategori</a></li>
                    <li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.orders.index') }}">
                            <i class="fa-solid fa-file-invoice-dollar"></i> Transaksi & Status
                        </a>
                    </li>
                </ul>
                <div class="divider" style="margin: 20px 0; border-top: 1px solid #eee;"></div>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i> Profile Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form-final" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        <a href="{{ route('logout') }}" class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form-final').submit();"
                           style="color: #e74c3c; text-decoration: none; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h2>Daftar Transaksi</h2>
                </div>
                <div class="header-right" style="display: flex; gap: 20px; align-items: center;">
                    <div class="profile-section" style="display: flex; align-items: center; gap: 12px;">
                        <div class="profile-text" style="text-align: right;">
                            <span class="p-name" style="display: block; font-weight: 700; color: #1a1a1a;">{{ Auth::user()->name ?? 'admin' }}</span>
                            <span class="p-role" style="display: block; font-size: 12px; color: #888;">Administrator</span>
                        </div>
                        <div class="profile-image">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'admin') }}&background=C5A059&color=fff"
                                 alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </header>

            <div style="background:#fff; padding:30px; border-radius:15px; margin-top:30px; box-shadow: 0 4px 25px rgba(0,0,0,0.04);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    <div>
                        <h3 style="font-size:20px; font-weight:700; color:#1a1a1a; margin:0;">Semua Transaksi</h3>
                        <p style="font-size: 13px; color: #888; margin-top: 4px;">Kelola pesanan dan pantau status pengiriman</p>
                    </div>
                    <div style="display:flex; gap:10px;">
                        {{-- Future filter or export buttons --}}
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                        <thead>
                            <tr style="text-align: left; border-bottom: 2px solid #f8f8f8;">
                                <th style="padding: 15px; color: #888; font-weight: 500;">ORDER ID</th>
                                <th style="padding: 15px; color: #888; font-weight: 500;">PELANGGAN</th>
                                <th style="padding: 15px; color: #888; font-weight: 500;">ALAMAT PENGIRIMAN</th>
                                <th style="padding: 15px; color: #888; font-weight: 500;">TOTAL HARGA</th>
                                <th style="padding: 15px; color: #888; font-weight: 500;">STATUS</th>
                                <th style="padding: 15px; color: #888; font-weight: 500;">TANGGAL</th>
                                <th style="padding: 15px; color: #888; font-weight: 500;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr style="border-bottom: 1px solid #f8f8f8; transition: background 0.2s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px; font-weight: 700; color: #1a1a1a;">#{{ $order->order_number }}</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name ?? 'User') }}&background=f0e8d8&color=C5A059" style="width: 32px; height: 32px; border-radius: 50%;">
                                        <div>
                                            <div style="font-weight: 600;">{{ $order->user->name ?? 'Guest' }}</div>
                                            <div style="font-size: 11px; color: #aaa;">{{ $order->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 15px; color: #555; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $order->shipping_address ?? 'Tidak ada alamat' }}
                                </td>
                                <td style="padding: 15px; font-weight: 700; color: #C5A059;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td style="padding: 15px;">
                                    @php
                                        $statusColor = '#f1c40f';
                                        $statusBg = '#fff9e6';
                                        if($order->status == 'selesai') { $statusColor = '#2ecc71'; $statusBg = '#e8f8f0'; }
                                        if($order->status == 'dibatalkan') { $statusColor = '#e74c3c'; $statusBg = '#fee8e8'; }
                                        if($order->status == 'dikirim') { $statusColor = '#3498db'; $statusBg = '#eaf2f8'; }
                                        if($order->status == 'diproses') { $statusColor = '#9b59b6'; $statusBg = '#f4eaf8'; }
                                    @endphp
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: uppercase; background: {{ $statusBg }}; color: {{ $statusColor }};">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td style="padding: 15px; color: #888;">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td style="padding: 15px;">
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="display: inline-flex; align-items: center; gap: 8px;">
                                        @csrf @method('PUT')
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="menunggu" {{ $order->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 60px; color: #bbb;">
                                    <i class="fa-solid fa-file-circle-exclamation" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.3;"></i>
                                    Belum ada transaksi saat ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        const flashMsg = document.getElementById('flashMsg');
        if (flashMsg) {
            setTimeout(() => { flashMsg.style.opacity = '0'; flashMsg.style.transition = 'opacity .5s'; }, 3500);
            setTimeout(() => flashMsg.remove(), 4000);
        }
    </script>
</body>
</html>
