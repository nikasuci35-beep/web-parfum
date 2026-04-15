<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Notifikasi Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardadmin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html { scroll-behavior: smooth; }
        .notification-card {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 5px solid transparent;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            position: relative;
        }
        .notification-card.unread {
            border-left-color: #C5A059;
            background: #fffcf5;
        }
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }
        .notif-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .icon-order { background: #f0e8d8; color: #C5A059; }
        .icon-info  { background: #e8f4fd; color: #3498db; }
        
        .notif-content { flex: 1; }
        .notif-title { font-weight: 700; color: #1a1a1a; font-size: 15px; margin-bottom: 2px; }
        .notif-msg { color: #666; font-size: 13px; line-height: 1.4; }
        .notif-time { color: #aaa; font-size: 11px; margin-top: 8px; display: block; }

        .btn-action {
            border: none;
            background: none;
            cursor: pointer;
            padding: 8px;
            color: #ccc;
            transition: color 0.2s;
            font-size: 14px;
        }
        .btn-action:hover { color: #e74c3c; }
        .btn-read:hover { color: #2ecc71; }

        .empty-state {
            text-align: center;
            padding: 100px 20px;
            color: #ccc;
        }
        .empty-state i { font-size: 60px; margin-bottom: 20px; opacity: 0.3; }

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
    </style>
</head>
<body>

    @if(session('success'))
        <div class="flash-alert flash-success" id="flashMsg">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="mobile-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="app-container" style="display: block;">
        <main class="main-content" style="margin-left: 0; width: 100%; max-width: 900px; margin: 0 auto; padding: 40px 20px;">
            <header class="header" style="background: none; box-shadow: none; padding: 0; margin-bottom: 40px;">
                <div class="header-left" style="display: flex; align-items: center; gap: 20px;">
                    <a href="{{ route('admin.dashboard') }}" style="width: 45px; height: 45px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1a1a1a; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.2s;" onmouseover="this.style.transform='translateX(-5px)'" onmouseout="this.style.transform='translateX(0)'">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <h2 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin: 0;">Pusat Notifikasi</h2>
                        <p style="font-size: 13px; color: #888; margin-top: 4px;">Kembali ke Dashboard Utama</p>
                    </div>
                </div>
                <div class="header-right">
                    @if($notifications->count() > 0 && $unreadNotificationsCount > 0)
                        <form action="{{ route('admin.notifications.readAll') }}" method="POST">
                            @csrf
                            <button type="submit" style="background: #1a1a1a; border: none; color: #fff; padding: 10px 20px; border-radius: 10px; font-size: 12px; cursor: pointer; font-weight: 500; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fa-solid fa-check-double" style="margin-right: 8px;"></i> Tandai Semua Dibaca
                            </button>
                        </form>
                    @endif
                </div>
            </header>

            <div style="max-width: 800px; margin: 30px 0;">
                @forelse($notifications as $notif)
                    <div class="notification-card {{ $notif->is_read ? '' : 'unread' }}">
                        <div class="notif-icon {{ $notif->type == 'new_order' ? 'icon-order' : 'icon-info' }}">
                            <i class="fa-solid {{ $notif->type == 'new_order' ? 'fa-cart-shopping' : 'fa-info-circle' }}"></i>
                        </div>
                        <div class="notif-content">
                            <p class="notif-title">{{ $notif->title }}</p>
                            <p class="notif-msg">{{ $notif->message }}</p>
                            <div style="display: flex; align-items: center; gap: 15px; margin-top: 8px;">
                                <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                                @if($notif->type == 'new_order' && $notif->data_id)
                                    <a href="{{ route('admin.dashboard') }}#order-{{ $notif->data_id }}" style="font-size: 11px; color: #C5A059; text-decoration: none; font-weight: 600;">Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size: 9px; margin-left: 3px;"></i></a>
                                @endif
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            @if(!$notif->is_read)
                                <form action="{{ route('admin.notifications.read', $notif->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-action btn-read" title="Tandai dibaca">
                                        <i class="fa-solid fa-check-double"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.notifications.destroy', $notif->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action" title="Hapus" onclick="return confirm('Hapus notifikasi ini?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-bell-slash"></i>
                        <h3>Tidak ada notifikasi</h3>
                        <p>Semua aktivitas terbaru Anda akan muncul di sini.</p>
                    </div>
                @endforelse
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
            setTimeout(() => { flashMsg.style.opacity = '0'; flashMsg.style.transition = 'opacity .5s'; }, 3000);
            setTimeout(() => flashMsg.remove(), 3500);
        }
    </script>
</body>
</html>
