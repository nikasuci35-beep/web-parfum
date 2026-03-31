<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Profile Settings</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/profilbody.css') }}">
</head>
<body class="profile-body">

    <aside class="profile-sidebar">
        <div class="sidebar-user">
            <img src="https://ui-avatars.com/api/?name=Alex+Chen&background=F7E9C8&color=333" alt="Tech Admin">
            <div class="user-meta">
                <strong>Tech Admin</strong>
                <small>User</small>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="#"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="#" class="active"><i class="fas fa-user"></i> Profile</a>
             <li><form method="POST" action="{{ route('logout') }}">@csrf<a href="beranda.blade.php" onclick="event.preventDefault(); this.closest('form').submit();">LOG OUT</a></form></li>
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="logout-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </nav>
    </aside>

    <main class="profile-content">
        <header class="content-header">
            <h2>Profile Settings</h2>
            <p>Atur informasi pribadimu dan keamanan akunmu</p>
        </header>

        <form method="post" action="{{ route('profile.update') }}" class="card-section">
            @csrf
            @method('patch')
            
            <div class="banner-gradient"></div>
            
            <div class="profile-header">
                <div class="avatar-box">
                    <img src="https://ui-avatars.com/api/?name=Alex+Chen&background=F7E9C8&color=333" alt="Alex">
                    <button class="change-photo"><i class="fas fa-camera"></i></button>
                </div>
                <div class="header-btns">
                    <button type="button" class="btn-outline-cancel">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                </div>
            </div>

            <div class="input-grid">
                <div class="form-group col-full">
                    <label>NAMA LENGKAP</label>
                    <div class="input-wrapper">
                        <i class="far fa-user"></i>
                        <input type="text" name="name" value="{{ $user->name }}" placeholder="Alex Chen">
                    </div>
                </div>
                <div class="form-group col-full">
                    <label>ALAMAT EMAIL</label>
                    <div class="input-wrapper">
                        <i class="far fa-envelope"></i>
                        <input type="email" name="email" value="{{ $user->email }}" placeholder="alex.chen@techadmin.com">
                    </div>
                </div>
                <div class="form-group">
                    <label>NOMOR TELEPON</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone"></i>
                        <input type="text" placeholder="+62 000-000-0000">
                    </div>
                </div>
                <div class="form-group col-full">
                    <label>BIO</label>
                    <textarea placeholder="Isi biormu..." class="textarea-bio"></textarea>
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
                <button class="btn-light">Ubah Password</button>
            </div>

            <div class="sec-item">
                <div class="item-text">
                    <div class="auth-flex">
                        <strong>2-langkah autentikasi</strong>
                        <span class="badge-active">AKTIF</span>
                    </div>
                    <p>Tambahkan lapisan keamanan untuk Akunmu.</p>
                </div>
                <button class="btn-light">Atur</button>
            </div>

            <div class="sec-item col-full">
                <div class="item-text">
                    <strong>Sesi Perangkat</strong>
                    <a href="#" class="view-retail">Log out dari semua perangkat</a>
                </div>
                <div class="session-box">
                    <i class="fas fa-desktop"></i>
                    <div class="session-meta">
                        <strong>Macbook Pro 16"</strong> San Francisco, US<br>
                        <small>Chrome • Active now</small>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>
</html>