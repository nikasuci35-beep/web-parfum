<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Profile Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profilbody.css') }}">
    <style>
    /* 1. Perbaikan Sidebar & Navigasi Utama */
    .profile-sidebar {
        background: #ffffff !important;
        padding: 20px 0 !important;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 8px; /* Jarak antar menu */
        padding: 0 15px;
    }

    /* 2. Reset Gaya Link (Agar identik dengan dashboard admin) */
    .sidebar-nav a {
        display: flex !important;
        align-items: center !important;
        padding: 12px 15px !important;
        text-decoration: none !important;
        color: #8E8E8E !important;        /* Sama dengan --sidebar-text admin */
        border-radius: 8px !important;    /* Sama dengan radius admin */
        font-size: 14px !important;
        font-family: 'Poppins', sans-serif !important; /* Font admin */
        transition: 0.3s !important;      /* Transisi admin */
        background-color: transparent !important;
        width: 100% !important;
        box-sizing: border-box !important;
        gap: 15px !important;             /* Jarak teks ke ikon */
    }

    /* Ukuran tetap di Icon, tidak butuh margin-right karena ada gap */
    .sidebar-nav a i {
        width: 20px;
        text-align: center;
        font-size: 16px;
    }

    /* 3. EFEK AKTIF & HOVER (Sama persis dengan admin) */
    .sidebar-nav a.active,
    .sidebar-nav a:hover:not([href$="logout"]),
    .sidebar-nav a:active:not([href$="logout"]) {
        background: #1A1A1A !important; /* Background aktif/di-klik/di-hover */
        color: #ffffff !important;      /* Teks putih */
        box-shadow: none !important;
    }

    .sidebar-nav a.active i,
    .sidebar-nav a:hover:not([href$="logout"]) i,
    .sidebar-nav a:active:not([href$="logout"]) i {
        color: #ffffff !important;
    }

    /* 5. Khusus Logout agar tidak ikut hitam */
    .sidebar-nav .logout-btn {
        color: #e74c3c !important;
        margin-top: 10px;
    }
</style>
</head>
<body class="profile-body">

    <aside class="profile-sidebar">
        <div class="sidebar-user" style="display: flex; align-items: center; gap: 15px; padding: 0 15px 25px 15px; margin-bottom: 25px; border-bottom: 1px solid #EDEDED;">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Photo" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=F7E9C8&color=333" alt="Avatar" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
            @endif
            <div class="user-meta">
                <strong style="display: block; font-size: 15px; color: #1A1A1A; font-family: 'Poppins', sans-serif; font-weight: 600;">{{ Auth::user()->name }}</strong>
                <small style="display: block; font-size: 12px; color: #8E8E8E; margin-top: 2px;">{{ ucfirst(Auth::user()->role ?? 'User') }}</small>
            </div>
        </div>
       <nav class="sidebar-nav">
    <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" 
       class="nav-link {{ (request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard')) ? 'active' : '' }}">
        <i class="fas fa-th-large"></i> <span>Dashboard</span>
    </a>

    <a href="{{ route('profile.index') }}" 
       class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
        <i class="fas fa-user"></i> <span>Profile Settings</span>
    </a>

    <li class="nav-item">
                        <form id="logout-form-final" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-final').submit();" style="color: #e74c3c; text-decoration: none; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
                        </a>
                    </li>
</nav>
    </aside>

    <main class="profile-content">
        <header class="content-header">
            <h2>Profile Settings</h2>
            <p>Atur informasi pribadimu dan keamanan akunmu</p>
        </header>

        @if(session('status'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="card-section" enctype="multipart/form-data">
            @csrf
            @method('patch')
            
            <div class="banner-gradient"></div>
            
            <div class="profile-header">
               <div class="avatar-box" style="position: relative;">
    @if(Auth::user()->avatar)
        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Photo" id="avatar-preview">
    @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=F7E9C8&color=333" alt="Avatar" id="avatar-preview">
    @endif
    
    <button type="button" id="camera-btn" class="change-photo">
        <i class="fas fa-camera"></i>
    </button>
    <input type="file" id="avatar-input" name="avatar" accept="image/*" style="display: none;">
</div>
                <div class="header-btns">
                    <a href="{{ url()->previous() }}" class="btn-outline-cancel" style="text-decoration: none; display: inline-block; text-align: center; line-height: 40px;">Batal</a>
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                </div>
            </div>

            <div class="input-grid">
                <div class="form-group col-full">
                    <label>NAMA LENGKAP</label>
                    <div class="input-wrapper">
                        <i class="far fa-user"></i>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                    </div>
                </div>
                <div class="form-group col-full">
                    <label>ALAMAT EMAIL</label>
                    <div class="input-wrapper">
                        <i class="far fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>NOMOR TELEPON</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="phone" value="{{ Auth::user()->phone ?? '+62 ' }}" placeholder="+62 000-000-0000">
                    </div>
                </div>
                <div class="form-group col-full">
                    <label>BIO</label>
                    <textarea name="bio" placeholder="Isi biomu..." class="textarea-bio">{{ Auth::user()->bio ?? '' }}</textarea>
                </div>
            </div>
        </form>

        <section class="card-section">
            <h3 class="card-title"><i class="fas fa-lock"></i> Login & Keamanan</h3>
            
            <div class="sec-item">
                <div class="item-text">
                    <strong>Ubah Password</strong>
                    <p>Update passwordmu untuk keamanan akunmu.</p>
                </div>
                <a href="{{ route('profile.password.edit') }}" class="btn-light" style="text-decoration: none;">Ubah Password</a>
            </div>
           
            <div class="session-container mt-5">
    <div class="session-header">
        <h5 class="session-title">Sesi Perangkat</h5>
        <form action="{{ route('profile.logout-all-sessions') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout-all">Log out dari semua perangkat</button>
        </form>
    </div>

    <div class="sesi-perangkat-box" style="display: flex; align-items: center; gap: 15px;">
    <div class="icon">
        <i class="fas fa-laptop" style="font-size: 24px; color: #666;"></i>
    </div>

    <div class="info">
        <strong style="display: block;">{{ $platform }} PC</strong>
        <span style="color: #666; font-size: 13px;">
            {{ $browser }} • <span style="color: green; font-weight: bold;">Active now</span>
        </span>
    </div>
</div>
</div>
<div class="danger-zone" style="margin-top: 30px; padding: 20px; border: 1px solid #ebccd1; border-radius: 8px; background-color: #fcf8f2;">
    <h3 style="color: #a94442; margin-top: 0; font-size: 18px; font-weight: bold;">Hapus Akun</h3>
    <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
        Setelah akun dihapus, semua data di <strong>ÉLIXIRÉ</strong> akan hilang permanen. 
        Tindakan ini tidak bisa dibatalkan.
    </p>

    <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        @method('delete')

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-size: 13px; color: #333; margin-bottom: 5px;">Masukkan Password untuk Konfirmasi:</label>
            <input type="password" name="password" placeholder="Password Anda" required 
                style="width: 100%; max-width: 300px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; display: block;">
            
            @error('password', 'userDeletion')
                <span style="color: #a94442; font-size: 12px;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" 
            onclick="return confirm('Apakah kamu benar-benar yakin? Semua data parfum dan riwayat belanja akan hilang.')"
            style="background-color: #d9534f; color: white; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 14px;">
            Hapus Akun Sekarang
        </button>
    </form>
</div>
        </section>
    </main>
<script>
    // Menghubungkan tombol kamera dengan input file
    document.getElementById('camera-btn').addEventListener('click', function() {
        document.getElementById('avatar-input').click();
    });

    // Opsional: Jika ingin langsung submit saat foto dipilih
    document.getElementById('avatar-input').onchange = function() {
        this.closest('form').submit();
    };
</script>
</body>
</html>