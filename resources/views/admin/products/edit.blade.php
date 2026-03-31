<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Edit Produk</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardadmin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- SIDEBAR FIX: HITAM PEKAT --- */
        .sidebar-menu ul li.active a {
            background-color: #000000 !important;
            color: #ffffff !important;
            border-radius: 12px;
        }

        .sidebar-menu ul li a {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            padding: 12px 15px;
            color: #666;
            transition: none !important;
        }

        .main-content { padding: 40px; }

        .form-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-image img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .current-image-preview {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h1>ÉLIXIRÉ</h1>
                <p>LUXURY PERFUMES</p>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-house-chimney"></i> Dashboard
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ route('admin.products.index') }}">
                            <i class="fa-solid fa-box-open"></i> Produk Anda
                        </a>
                    </li>
                    <li><a href="#"><i class="fa-solid fa-tags"></i> Jenis Kategori</a></li>
                    <li><a href="#"><i class="fa-solid fa-file-invoice-dollar"></i> Daftar Transaksi</a></li>
                    <li><a href="#"><i class="fa-solid fa-truck-fast"></i> Status Pesanan</a></li>
                </ul>
                <div class="divider" style="margin: 20px 0; border-top: 1px solid #eee;"></div>
                <ul>
                    <li><a href="{{ route('profile.index') }}"><i class="fa-solid fa-gear"></i> Profile Settings</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #e74c3c;">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
                <h2 style="font-weight: 700;">Edit Produk</h2>
                
                <div class="profile-section" style="display: flex; align-items: center; gap: 12px;">
                    <div class="profile-text" style="text-align: right;">
                        <span style="display: block; font-weight: 700; color: #1a1a1a;">{{ Auth::user()->name ?? 'admin' }}</span>
                        <span style="display: block; font-size: 12px; color: #888;">Administrator</span>
                    </div>
                    <div class="profile-image">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'admin') }}&background=C5A059&color=fff" alt="Avatar">
                    </div>
                </div>
            </header>

            <div class="form-card">
                <form id="editProductForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 10px; color: #333;">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 12px; background: #fafafa; outline: none; font-family: 'Poppins', sans-serif;" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 10px; color: #333;">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 12px; background: #fafafa; outline: none; font-family: 'Poppins', sans-serif;" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 10px; color: #333;">Deskripsi Aroma</label>
                        <textarea name="description" rows="3" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 12px; background: #fafafa; outline: none; font-family: 'Poppins', sans-serif;">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 10px; color: #333;">Foto Produk</label>
                        @if($product->image)
                            <div style="margin-bottom: 10px;">
                                <img src="{{ asset('storage/' . $product->image) }}" class="current-image-preview">
                            </div>
                        @endif
                        <div class="upload-box" style="border: 2px dashed #ddd; border-radius: 15px; padding: 25px; text-align: center; background: #fafafa; position: relative;">
                            <i class="fa-solid fa-image" style="font-size: 24px; color: #ccc; display: block; margin-bottom: 10px;"></i>
                            <p style="font-size: 12px; color: #999;">Ganti gambar produk</p>
                            <input type="file" name="image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                        </div>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.dashboard') }}" style="flex: 1; text-align: center; padding: 16px; background: #eee; color: #333; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 15px;">Batal</a>
                        
                        <button type="submit" style="flex: 2; padding: 16px; background: #000; color: #fff; border: none; border-radius: 12px; font-weight: 600; font-size: 15px; cursor: pointer;">
                            Update Produk
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Memastikan setelah klik update, user diarahkan ke Dashboard Admin
        document.getElementById('editProductForm').onsubmit = function() {
            setTimeout(function() {
                window.location.href = "{{ route('admin.dashboard') }}";
            }, 800); 
        };
    </script>

</body>
</html>