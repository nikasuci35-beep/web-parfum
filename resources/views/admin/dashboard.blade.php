<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardadmin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html { scroll-behavior: smooth; }
        #status-pesanan, #produk-anda { scroll-margin-top: 100px; }
        .dot-indicator { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .bg-green  { background: #2ecc71; }
        .bg-yellow { background: #f1c40f; }
        .bg-grey   { background: #34495e; }
        .bg-red    { background: #e74c3c; }
        .bg-blue   { background: #3498db; }

        .status-select {
            padding: 5px 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
            font-family: 'Poppins', sans-serif;
            background: #fff;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s;
        }
        .status-select:focus { border-color: #C5A059; }

        /* ── Flash Alert ── */
        .flash-alert {
            position: fixed; top: 20px; right: 20px; z-index: 99999;
            padding: 14px 22px; border-radius: 12px;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            animation: slideIn .4s ease;
        }
        .flash-success { background: #1a1a1a; color: #fff; border-left: 4px solid #C5A059; }
        .flash-error   { background: #fff0f0; color: #c0392b; border-left: 4px solid #e74c3c; }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(60px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── Modal Overlay ── */
        .modal-overlay {
            display: none; position: fixed; z-index: 9999;
            left: 0; top: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.55);
            align-items: center; justify-content: center;
            backdrop-filter: blur(5px);
        }
        .modal-box {
            background: #fff; padding: 36px;
            border-radius: 20px; width: 480px; max-width: 95vw;
            box-shadow: 0 24px 60px rgba(0,0,0,0.2);
            animation: popIn .3s ease;
        }
        @keyframes popIn {
            from { opacity: 0; transform: scale(.92); }
            to   { opacity: 1; transform: scale(1); }
        }
        .modal-title {
            font-size: 18px; font-weight: 700; color: #1a1a1a;
            margin-bottom: 4px;
        }
        .modal-subtitle { font-size: 12px; color: #aaa; margin-bottom: 24px; }
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block; font-size: 12px; font-weight: 600;
            color: #555; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .5px;
        }
        .form-control {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid #e8e8e8; border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: 13px; color: #333;
            transition: border-color .2s;
            box-sizing: border-box;
        }
        .form-control:focus { outline: none; border-color: #C5A059; }

        /* ── Upload Zone (sama dengan form Tambah Produk) ── */
        .upload-zone {
            border: 2px dashed #ddd; border-radius: 15px;
            padding: 30px; text-align: center; cursor: pointer;
            background: #fafafa; position: relative;
        }
        .upload-zone input[type="file"] {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;
        }
        .upload-icon {
            font-size: 30px; color: #ccc; margin-bottom: 10px; display: block;
        }
        .upload-zone p { font-size: 12px; color: #999; margin: 0; }

        /* ── Image Preview ── */
        .img-preview-wrap {
            display: none; margin-top: 12px; position: relative; border-radius: 12px; overflow: hidden;
        }
        .img-preview-wrap img {
            width: 100%; height: 150px; object-fit: cover; display: block; border-radius: 12px;
        }
        .img-preview-wrap .img-remove-btn {
            position: absolute; top: 8px; right: 8px;
            background: rgba(0,0,0,0.6); color: #fff; border: none;
            border-radius: 50%; width: 28px; height: 28px; cursor: pointer;
            font-size: 12px; display: flex; align-items: center; justify-content: center;
        }

        /* ── Category Card in List ── */
        .cat-item-img {
            width: 36px; height: 36px;
            border-radius: 8px; object-fit: cover;
            border: 1.5px solid #f0e8d8;
        }
        .cat-item-placeholder {
            width: 36px; height: 36px; border-radius: 8px;
            background: #f0ece3; display: flex;
            align-items: center; justify-content: center;
            color: #C5A059; font-size: 14px; flex-shrink: 0;
        }
        .cat-item {
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 8px 0; border-bottom: 1px solid #f5f5f5;
            gap: 8px;
        }
        .cat-item:last-of-type { border-bottom: none; }
        .cat-item-name {
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #1a1a1a;
        }
        .cat-empty {
            text-align: center;
            padding: 20px 10px;
            font-size: 12px;
            color: #ccc;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }
        .cat-empty i {
            font-size: 20px;
        }
        .cat-item-actions { display: flex; gap: 8px; flex-shrink: 0; }
        .cat-btn-edit, .cat-btn-del {
            border: none; border-radius: 6px; padding: 4px 8px;
            font-size: 11px; cursor: pointer; transition: all .2s;
        }
        .cat-btn-edit { background: #f0e8d8; color: #C5A059; }
        .cat-btn-edit:hover { background: #C5A059; color: #fff; }
        .cat-btn-del { background: #fff0f0; color: #e74c3c; }
        .cat-btn-del:hover { background: #e74c3c; color: #fff; }

        /* ── Modal Footer Buttons ── */
        .modal-footer { display: flex; gap: 10px; justify-content: flex-end; margin-top: 24px; }
        .btn-cancel {
            padding: 11px 22px; border: none;
            background: #f0f0f0; border-radius: 10px;
            cursor: pointer; font-size: 13px; font-weight: 500;
            transition: background .2s;
        }
        .btn-cancel:hover { background: #e0e0e0; }
        .btn-save {
            padding: 11px 26px; border: none;
            background: #1a1a1a; color: #fff; border-radius: 10px;
            cursor: pointer; font-size: 13px; font-weight: 600;
            letter-spacing: .3px;
        }

        /* ── Button Tambah Kategori — matching sidebar style ── */
        .btn-new-category {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #1A1A1A;
            color: #FFFFFF;
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.3px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-new-category i {
            font-size: 13px;
        }
        .btn-new-category:hover,
        .btn-new-category:active,
        .btn-new-category:focus {
            background: #1A1A1A;
            color: #FFFFFF;
            outline: none;
        }
    </style>
</head>
<body>

    {{-- ── Flash Messages ── --}}
    @if(session('success'))
        <div class="flash-alert flash-success" id="flashMsg">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="flash-alert flash-error" id="flashMsg">
            <i class="fa-solid fa-circle-xmark"></i> {{ $errors->first() }}
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
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="#status-pesanan">
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
                    <h2>Admin Dashboard</h2>
                </div>
                <div class="header-right" style="display: flex; gap: 20px; align-items: center;">
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="query" placeholder="Cari produk anda..."
                               value="{{ request('query') }}"
                               oninput="if(this.value === '') { window.location.href = '{{ route('admin.dashboard') }}'; }">
                    </form>
                    
                    <!-- Notification Bell -->
                    <a href="{{ route('admin.notifications.index') }}" style="position: relative; cursor: pointer; transition: opacity 0.3s; text-decoration: none;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                        <img src="{{ asset('image/lonceng.png') }}" alt="Notifikasi" style="width: 28px; height: 31px; object-fit: contain;">
                        @if($unreadNotificationsCount > 0)
                            <span style="position: absolute; top: -2px; right: -2px; width: 10px; height: 10px; background-color: #e74c3c; border-radius: 50%; border: 2px solid #fff;"></span>
                        @endif
                    </a>
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

            {{-- Stats --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-box"></i></div>
                    <div class="stat-content"><p>Total Produk</p><h3>{{ \App\Models\Product::count() }}</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div class="stat-content"><p>Total Pesanan</p><h3>{{ $totalOrders }}</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-content"><p>Total Pembeli</p><h3>{{ $totalUsers }}</h3></div>
                </div>
                <div class="stat-card">
                    <div class="icon-wrap"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                    <div class="stat-content"><p>Total Penjualan</p><h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3></div>
                </div>
            </div>

            {{-- ══════════════════════════════════
                 MANAGE CATEGORIES
            ══════════════════════════════════ --}}
            <div id="manage-categories" class="manage-categories-card" style="scroll-margin-top:100px;">
                <div class="category-header">
                    <div class="header-text">
                        <h3>Manage Categories</h3>
                        <p>Tambah, edit, dan hapus kategori produk beserta fotonya</p>
                    </div>
                    <button class="btn-new-category" onclick="openAddModal()">
                        <i class="fa-solid fa-plus"></i> Tambah Kategori
                    </button>
                </div>

                <div class="category-columns">
                    {{-- PRODUCT --}}
                    <div class="cat-column">
                        <label class="cat-label"><i class="fa-solid fa-user-tag"></i> PRODUCT (TARGET)</label>
                        @forelse($categories->where('type', 'product') as $cat)
                            <div class="cat-item">
                                <div style="display:flex; align-items:center; gap:10px; flex:1; min-width:0;">
                                    @if($cat->image)
                                        <img src="{{ asset('storage/'.$cat->image) }}" class="cat-item-img" alt="{{ $cat->name }}">
                                    @else
                                        <div class="cat-item-placeholder"><i class="fa-solid fa-tag"></i></div>
                                    @endif
                                    <span class="cat-item-name">{{ $cat->name }}</span>
                                </div>
                                <div class="cat-item-actions">
                                    <button class="cat-btn-edit" onclick='openEditModal({{ $cat->id }}, "{{ addslashes($cat->name) }}", "{{ $cat->type }}", "{{ $cat->image ? asset("storage/".$cat->image) : "" }}")'>
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="cat-btn-del" onclick="confirmDelete({{ $cat->id }}, '{{ addslashes($cat->name) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="cat-empty"><i class="fa-solid fa-inbox"></i> Belum ada kategori</div>
                        @endforelse
                    </div>

                    {{-- AROMA --}}
                    <div class="cat-column">
                        <label class="cat-label"><i class="fa-solid fa-wind"></i> AROMA</label>
                        @forelse($categories->where('type', 'aroma') as $cat)
                            <div class="cat-item">
                                <div style="display:flex; align-items:center; gap:10px; flex:1; min-width:0;">
                                    @if($cat->image)
                                        <img src="{{ asset('storage/'.$cat->image) }}" class="cat-item-img" alt="{{ $cat->name }}">
                                    @else
                                        <div class="cat-item-placeholder"><i class="fa-solid fa-wind"></i></div>
                                    @endif
                                    <span class="cat-item-name">{{ $cat->name }}</span>
                                </div>
                                <div class="cat-item-actions">
                                    <button class="cat-btn-edit" onclick='openEditModal({{ $cat->id }}, "{{ addslashes($cat->name) }}", "{{ $cat->type }}", "{{ $cat->image ? asset("storage/".$cat->image) : "" }}")'>
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="cat-btn-del" onclick="confirmDelete({{ $cat->id }}, '{{ addslashes($cat->name) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="cat-empty"><i class="fa-solid fa-inbox"></i> Belum ada kategori</div>
                        @endforelse
                    </div>

                    {{-- COLLECTION --}}
                    <div class="cat-column">
                        <label class="cat-label"><i class="fa-solid fa-gem"></i> COLLECTION</label>
                        @forelse($categories->where('type', 'collection') as $cat)
                            <div class="cat-item">
                                <div style="display:flex; align-items:center; gap:10px; flex:1; min-width:0;">
                                    @if($cat->image)
                                        <img src="{{ asset('storage/'.$cat->image) }}" class="cat-item-img" alt="{{ $cat->name }}">
                                    @else
                                        <div class="cat-item-placeholder"><i class="fa-solid fa-star"></i></div>
                                    @endif
                                    <span class="cat-item-name">{{ $cat->name }}</span>
                                </div>
                                <div class="cat-item-actions">
                                    <button class="cat-btn-edit" onclick='openEditModal({{ $cat->id }}, "{{ addslashes($cat->name) }}", "{{ $cat->type }}", "{{ $cat->image ? asset("storage/".$cat->image) : "" }}")'>
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="cat-btn-del" onclick="confirmDelete({{ $cat->id }}, '{{ addslashes($cat->name) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="cat-empty"><i class="fa-solid fa-inbox"></i> Belum ada kategori</div>
                        @endforelse
                    </div>

                </div>
            </div>

            {{-- Transaksi & Status --}}
            <div id="status-pesanan" class="recent-orders" style="background:#fff; padding:25px; border-radius:15px; margin-top:30px; box-shadow: 0 4px 25px rgba(0,0,0,0.05); scroll-margin-top: 100px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div>
                        <h3 style="font-size:18px; font-weight:700; color:#1a1a1a; margin:0;">Transaksi & Status</h3>
                        <p style="font-size: 12px; color: #888; margin-top: 4px;">Kelola pesanan dan pantau status pengiriman secara real-time</p>
                    </div>
                </div>
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                        <thead>
                            <tr style="text-align: left; border-bottom: 2px solid #f8f8f8;">
                                <th style="padding: 12px 15px; color: #888; font-weight: 500;">ORDER ID</th>
                                <th style="padding: 12px 15px; color: #888; font-weight: 500;">PEMBELI</th>
                                <th style="padding: 12px 15px; color: #888; font-weight: 500;">TOTAL</th>
                                <th style="padding: 12px 15px; color: #888; font-weight: 500;">STATUS</th>
                                <th style="padding: 12px 15px; color: #888; font-weight: 500;">TANGGAL</th>
                                <th style="padding: 12px 15px; color: #888; font-weight: 500;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr id="order-{{ $order->id }}" style="border-bottom: 1px solid #f8f8f8; transition: background 0.2s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px; font-weight: 600; color: #1a1a1a;">#{{ $order->order_number }}</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name ?? 'User') }}&background=f0e8d8&color=C5A059" style="width: 28px; height: 28px; border-radius: 50%;">
                                        <span>{{ $order->user->name ?? 'Guest' }}</span>
                                    </div>
                                </td>
                                <td style="padding: 15px; font-weight: 600; color: #C5A059;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td style="padding: 15px;">
                                    @php
                                        $statusClass = 'bg-yellow';
                                        if($order->status == 'selesai') $statusClass = 'bg-green';
                                        if($order->status == 'dibatalkan') $statusClass = 'bg-red';
                                        if($order->status == 'dikirim') $statusClass = 'bg-blue';
                                        if($order->status == 'diproses') $statusClass = 'bg-grey';
                                    @endphp
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 500; text-transform: capitalize; 
                                        @if($order->status == 'selesai') background: #e8f8f0; color: #2ecc71;
                                        @elseif($order->status == 'dibatalkan') background: #fee8e8; color: #e74c3c;
                                        @elseif($order->status == 'menunggu') background: #fff9e6; color: #f1c40f;
                                        @elseif($order->status == 'dikirim') background: #eaf2f8; color: #3498db;
                                        @else background: #f0f0f0; color: #34495e; @endif">
                                        <span class="dot-indicator {{ $statusClass }}"></span>
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td style="padding: 15px; color: #888;">{{ $order->created_at->format('d M Y') }}</td>
                                <td style="padding: 15px;">
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="display: inline-flex; align-items: center;">
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
                                <td colspan="6" style="text-align: center; padding: 40px; color: #bbb;">
                                    <i class="fa-solid fa-inbox" style="font-size: 30px; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
                                    Tidak ada transaksi saat ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Products --}}
            <div id="produk-anda" class="product-header" style="display:flex; justify-content:space-between; align-items:center; margin:40px 0 20px;">
                <h3 style="font-weight:600;">
                    Produk Anda
                    @if(request('query'))
                        <span style="font-size:14px; font-weight:normal; color:#888;">- Hasil untuk: "{{ request('query') }}"</span>
                    @endif
                </h3>
                <a href="{{ route('admin.products.create') }}" class="btn-add-product" style="text-decoration:none;">
                    <i class="fa-solid fa-plus"></i> Tambah Produk Baru
                </a>
            </div>

            <div class="product-grid">
                @forelse($products as $product)
                <div class="product-item">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div style="width:80px; height:80px; background:#eee; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                            <i class="fa-solid fa-image" style="color:#ccc;"></i>
                        </div>
                    @endif
                    <div class="p-details" style="flex:1;">
                        <h4 style="font-size:15px; margin-bottom:2px;">{{ $product->name }}</h4>
                        <span style="font-size:12px; color:#aaa;">{{ $product->categories->first()->name ?? 'Perfume Collection' }}</span>
                        <div class="p-stock" style="font-size:12px; margin:5px 0;">Stock: <strong>{{ $product->stock ?? '0' }}</strong></div>
                        <div class="p-price" style="font-weight:700; color:#C5A059;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="p-actions" style="display:flex; flex-direction:column; gap:10px; color:#ccc;">
                        <a href="{{ route('admin.products.edit', $product) }}" style="color:inherit;"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus produk ini?')"
                                    style="background:none; border:none; color:#e74c3c; cursor:pointer;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div style="grid-column:span 3; text-align:center; padding:50px; color:#888; background:#fff; border-radius:15px;">
                    <p>Produk tidak ditemukan.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>


    {{-- ══════════════════════════════════
         MODAL: TAMBAH KATEGORI
    ══════════════════════════════════ --}}
    <div id="addCategoryModal" class="modal-overlay" onclick="handleOverlayClick(event,'addCategoryModal')">
        <div class="modal-box">
            <p class="modal-title"><i class="fa-solid fa-tags" style="color:#C5A059; margin-right:8px;"></i> Tambah Kategori Baru</p>
            <p class="modal-subtitle">Isi detail kategori dan upload gambar (opsional)</p>

            <form id="addCategoryForm" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" class="form-control" required placeholder="Misal: Floral, Luxury, Baccarat...">
                </div>

                <div class="form-group">
                    <label>Tipe Kategori</label>
                    <select name="type" class="form-control" required>
                        <option value="product">Product (Gender / Target)</option>
                        <option value="aroma">Aroma</option>
                        <option value="collection">Collection</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto / Gambar Kategori <span style="color:#aaa; font-weight:400;">(Opsional)</span></label>
                    <div class="upload-zone" id="addUploadZone">
                        <input type="file" name="image" accept="image/*" id="addImageInput" onchange="previewImage(this,'addPreviewWrap','addPreviewImg','addUploadZone')">
                        <div id="addUploadZoneContent">
                            <i class="fa-solid fa-image" style="font-size: 24px; color: #ccc; display: block; margin-bottom: 10px;"></i>
                            <p style="font-size: 12px; color: #999; margin: 0;">Klik untuk pilih gambar kategori</p>
                        </div>
                    </div>
                    <div class="img-preview-wrap" id="addPreviewWrap" style="display:none; margin-top:10px; position:relative;">
                        <img src="" id="addPreviewImg" alt="Preview" style="width: 80px; height: 80px; border-radius: 10px; object-fit: cover; border: 1px solid #ddd;">
                        <button type="button" class="img-remove-btn" onclick="removePreview('addImageInput','addPreviewWrap','addUploadZone')" style="position:absolute; top:-5px; left:65px; width:20px; height:20px; font-size:10px;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addCategoryModal')">Batal</button>
                    <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>


    {{-- ══════════════════════════════════
         MODAL: EDIT KATEGORI
    ══════════════════════════════════ --}}
    <div id="editCategoryModal" class="modal-overlay" onclick="handleOverlayClick(event,'editCategoryModal')">
        <div class="modal-box">
            <p class="modal-title"><i class="fa-solid fa-pen" style="color:#C5A059; margin-right:8px;"></i> Edit Kategori</p>
            <p class="modal-subtitle">Ubah nama, tipe, atau ganti foto kategori</p>

            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tipe Kategori</label>
                    <select name="type" id="editType" class="form-control" required>
                        <option value="product">Product (Gender / Target)</option>
                        <option value="aroma">Aroma</option>
                        <option value="collection">Collection</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto / Gambar Kategori <span style="color:#aaa; font-weight:400;">(Kosongkan jika tidak ingin mengubah)</span></label>

                    {{-- Gambar saat ini --}}
                    <div id="editCurrentImgWrap" style="display:none; margin-bottom:10px;">
                        <img id="editCurrentImg" src="" alt="Current" style="width: 80px; height: 80px; border-radius: 10px; object-fit: cover; border: 1px solid #ddd;">
                    </div>

                    <div class="upload-zone" id="editUploadZone" style="margin-top:10px;">
                        <input type="file" name="image" accept="image/*" id="editImageInput" onchange="previewImage(this,'editPreviewWrap','editPreviewImg','editUploadZone')">
                        <div id="editUploadZoneContent">
                            <i class="fa-solid fa-image" style="font-size: 24px; color: #ccc; display: block; margin-bottom: 10px;"></i>
                            <p style="font-size: 12px; color: #999; margin: 0;">Klik untuk ganti gambar</p>
                        </div>
                    </div>
                    <div class="img-preview-wrap" id="editPreviewWrap" style="display:none; margin-top:10px; position:relative;">
                        <img src="" id="editPreviewImg" alt="Preview" style="width: 80px; height: 80px; border-radius: 10px; object-fit: cover; border: 1px solid #ddd;">
                        <button type="button" class="img-remove-btn" onclick="removePreview('editImageInput','editPreviewWrap','editUploadZone')" style="position:absolute; top:-5px; left:65px; width:20px; height:20px; font-size:10px;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('editCategoryModal')">Batal</button>
                    <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>


    {{-- ══════════════════════════════════
         MODAL: KONFIRMASI HAPUS
    ══════════════════════════════════ --}}
    <div id="deleteCategoryModal" class="modal-overlay" onclick="handleOverlayClick(event,'deleteCategoryModal')">
        <div class="modal-box" style="width:380px; text-align:center;">
            <div style="font-size:48px; color:#e74c3c; margin-bottom:12px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <p class="modal-title" style="text-align:center;">Hapus Kategori?</p>
            <p style="font-size:13px; color:#888; margin:8px 0 24px;" id="deleteMessage">
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="deleteCategoryForm" method="POST">
                @csrf @method('DELETE')
                <div class="modal-footer" style="justify-content:center;">
                    <button type="button" class="btn-cancel" onclick="closeModal('deleteCategoryModal')">Batal</button>
                    <button type="submit" style="padding:11px 26px; border:none; background:#e74c3c; color:#fff; border-radius:10px; cursor:pointer; font-size:13px; font-weight:600;">
                        <i class="fa-solid fa-trash"></i> Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        /* ─── Modal Helpers ─── */
        function openModal(id)  { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        function handleOverlayClick(e, id) {
            if (e.target === document.getElementById(id)) closeModal(id);
        }

        /* ─── Open Add Modal ─── */
        function openAddModal() {
            document.getElementById('addCategoryForm').reset();
            removePreview('addImageInput','addPreviewWrap','addUploadZone');
            openModal('addCategoryModal');
        }

        /* ─── Open Edit Modal ─── */
        function openEditModal(id, name, type, imgUrl) {
            const form = document.getElementById('editCategoryForm');
            form.action = '/admin/categories/' + id;
            document.getElementById('editName').value = name;
            const sel = document.getElementById('editType');
            for (let opt of sel.options) opt.selected = (opt.value === type);

            const currentWrap = document.getElementById('editCurrentImgWrap');
            if (imgUrl) {
                document.getElementById('editCurrentImg').src = imgUrl;
                currentWrap.style.display = 'block';
            } else {
                currentWrap.style.display = 'none';
            }
            removePreview('editImageInput','editPreviewWrap','editUploadZone');
            openModal('editCategoryModal');
        }

        /* ─── Open Delete Modal ─── */
        function confirmDelete(id, name) {
            const form = document.getElementById('deleteCategoryForm');
            form.action = '/admin/categories/' + id;
            document.getElementById('deleteMessage').textContent =
                'Anda akan menghapus kategori "' + name + '". Tindakan ini tidak dapat dibatalkan.';
            openModal('deleteCategoryModal');
        }

        /* ─── Image Upload Preview ─── */
        function previewImage(input, wrapId, imgId, zoneId) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById(imgId).src = e.target.result;
                document.getElementById(wrapId).style.display = 'block';
                document.getElementById(zoneId).style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function removePreview(inputId, wrapId, zoneId) {
            const input = document.getElementById(inputId);
            if (input) input.value = '';
            document.getElementById(wrapId).style.display = 'none';
            document.getElementById(zoneId).style.display = 'block';
        }

        /* ─── Sidebar Toggle (Mobile) ─── */
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
            document.body.classList.toggle('sidebar-open');
        }

        /* ─── Auto-dismiss flash ─── */
        const flashMsg = document.getElementById('flashMsg');
        if (flashMsg) {
            setTimeout(() => { flashMsg.style.opacity = '0'; flashMsg.style.transition = 'opacity .5s'; }, 3500);
            setTimeout(() => flashMsg.remove(), 4000);
        }

        /* ─── Auto scroll to products after search ─── */
        @if(request('query'))
            document.addEventListener('DOMContentLoaded', () => {
                document.getElementById('produk-anda').scrollIntoView({ behavior: 'smooth' });
            });
        @endif
    </script>
</body>
</html>