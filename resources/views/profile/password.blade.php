<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->name }} - Profile Settings</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --bg-color: #f3f4f6;
            --sidebar-bg: #f9fafb;
            --text-main: #333333;
            --text-sub: #666666;
            --border-color: #e5e7eb;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            display: flex;
            color: var(--text-main);
            height: 100vh;
        }

        /* --- SIDEBAR STYLE --- */
        .profile-sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .user-header-block {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
        }

        .user-avatar-circle {
            width: 44px;
            height: 44px;
            background-color: #e9e2d3;
            color: #7d6b53;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1rem;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-name-mini {
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: capitalize;
            color: #000;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 10px;
        }

        .nav-link, .logout-btn {
            text-decoration: none;
            color: var(--text-sub);
            padding: 12px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            transition: 0.2s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            box-sizing: border-box;
            font-family: inherit;
            text-align: left;
        }

        .nav-link:hover:not(.active), .logout-btn:hover {
            background-color: #eeeeee;
            color: #000;
        }

        .nav-link.active {
            background-color: #000000;
            color: #ffffff;
        }

        .logout-btn { color: #dc2626; }
        .logout-btn:hover { background-color: #fee2e2; }

        /* --- CONTENT AREA --- */
        .profile-main-content {
            flex-grow: 1;
            padding: 50px 70px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        /* PERBAIKAN: Gaya Alert agar sesuai Gambar */
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border: 1px solid #a7f3d0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            max-width: 600px;
        }

        .content-header { margin-bottom: 40px; }
        .content-header h2 { font-size: 2rem; font-weight: 700; margin: 0; }
        .content-header p { color: var(--text-sub); margin-top: 8px; font-size: 1.1rem; }

        .form-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            max-width: 600px;
        }

        .form-group { margin-bottom: 25px; }
        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: bold;
            color: var(--text-sub);
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .input-with-icon { position: relative; }
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-sub);
        }

        .input-with-icon input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-actions { margin-top: 40px; display: flex; gap: 15px; }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            border: none;
        }

        .btn-update { background-color: #2563eb; color: white; }
        .btn-batal { background-color: #e5e7eb; color: #374151; }
    </style>
</head>
<body>

    <aside class="profile-sidebar">
        <div class="user-header-block">
            <div class="user-avatar-circle">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="user-info">
                <span class="user-name-mini">{{ Auth::user()->name }}</span>
                <span style="font-size: 0.8rem; color: #999;">User</span> 
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" 
               class="nav-link {{ (request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard')) ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> <span>Dashboard</span>
            </a>

            <a href="{{ route('profile.index') }}" 
               class="nav-link active">
                <i class="fas fa-user"></i> <span>Profile Settings</span>
            </a>

           <div class="divider"></div>
           <a href="{{ route('logout') }}" class="nav-link logout-btn" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
        </nav>
    </aside>

    <main class="profile-main-content">
        <header class="content-header">
            <h2>Ubah Password</h2>
            <p>Demi keamanan, gunakan password yang kuat dan unik.</p>
        </header>

        @if (session('status') === 'password-updated')
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> Password berhasil diperbarui.
            </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label>PASSWORD SAAT INI</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input name="current_password" type="password" required>
                    </div>
                    @error('current_password', 'updatePassword')
                        <div style="color: red; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>PASSWORD BARU</label>
                    <div class="input-with-icon">
                        <i class="fas fa-key"></i>
                        <input name="password" type="password" required>
                    </div>
                    @error('password', 'updatePassword')
                        <div style="color: red; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>KONFIRMASI PASSWORD BARU</label>
                    <div class="input-with-icon">
                        <i class="fas fa-check-double"></i>
                        <input name="password_confirmation" type="password" required>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('profile.index') }}" class="btn btn-batal">Batal</a>
                    <button type="submit" class="btn btn-update">Update Password</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>