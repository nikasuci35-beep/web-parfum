<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ÉLIXIRÉ</title>
    <style>
        /* --- RESET & BASE --- */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Playfair Display', serif; }
        body, html { height: 100%; background-color: #F9F9F7; font-family: sans-serif; }

        .wrapper { display: flex; min-height: 100vh; width: 100%; }

        /* --- SISI KIRI: GAMBAR --- */
        .side-left {
            width: 50%;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset("image/prfmrefil.png") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 80px;
            color: white;
            position: relative;
        }

        .logo-top { position: absolute; top: 40px; left: 40px; font-weight: bold; letter-spacing: 4px; font-size: 20px; display: flex; align-items: center; }
        .logo-top svg { margin-right: 8px; fill: white; width: 20px; height: 20px; }
        
        .side-text { padding-left: 0; }
        .side-text h2 { font-weight: 300; font-size: 32px; margin-bottom: 5px; opacity: 0.9; }
        .side-text h1 { font-size: 55px; font-weight: 800; line-height: 1; letter-spacing: -1px; }

        /* --- SISI KANAN: FORM --- */
        .side-right {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background-color: #F9F9F7;
        }

        .form-container { width: 100%; max-width: 420px; }

        .header h2 { font-size: 38px; color: #1a1a1a; margin-bottom: 12px; font-weight: 700; font-family: 'Playfair Display', serif; }
        .header p { color: #6b7280; font-weight: 500; margin-bottom: 35px; font-size: 14px; }

        /* --- ALERT ERROR (PERSIS GAMBAR) --- */
        .alert-error {
            background-color: #FEF2F2;
            color: #DC2626;
            padding: 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
            font-weight: 600;
        }
        .alert-icon { margin-right: 10px; width: 18px; fill: none; stroke: currentColor; stroke-width: 2; }

        /* --- INPUTS --- */
        .input-group { margin-bottom: 22px; position: relative; }
        .input-group label { display: block; font-size: 13px; font-weight: bold; color: #333; margin-bottom: 8px; }
        
        .field-wrapper { position: relative; }
        .input-style {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
            background: white;
        }
        .input-style:focus { border-color: #C1A35F; }
        .input-style.is-invalid { border-color: #EF4444; }

        .error-text { color: #EF4444; font-size: 11px; margin-top: 6px; font-weight: 500; }
        
        /* Ikon di dalam input */
        .inside-icon { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #EF4444; width: 18px; fill: none; stroke: currentColor; stroke-width: 2; }

        .forgot-link { color: #C1A35F; text-decoration: none; font-size: 12px; font-weight: 600; }

        /* --- BUTTON --- */
        .btn-login {
            width: 100%;
            background-color: #C1A35F;
            color: #111;
            padding: 16px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn-login:hover { background-color: #A98C4E; }

        .footer-text { text-align: center; margin-top: 30px; font-size: 14px; color: #6b7280; }
        .footer-text a { color: #1a1a1a; font-weight: bold; text-decoration: none; }

        /* Responsive */
        @media (max-width: 900px) {
            .side-left { display: none; }
            .side-right { width: 100%; }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="side-left">
            <div class="logo-top">
                
                ÉLIXIRÉ
            </div>
            <div class="side-text">
                <h2>Scent of authority</h2>
                <h1>Unspoken Influence</h1>
            </div>
        </div>

        <div class="side-right">
            <div class="form-container">
                <div class="header">
                    <h2>Selamat Datang Kembali</h2>
                    <p>Masuk untuk melanjutkan perjalanan wewangian Anda</p>
                </div>

                @if ($errors->any())
                <div class="alert-error">
                    <svg class="alert-icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>Akun belum terdaftar. Harap periksa kembali detail Anda.</span>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <label>Nama Pengguna</label>
                        <div class="field-wrapper">
                            <input type="email" name="email" value="{{ old('email') }}" 
                                class="input-style {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                placeholder="" required autofocus>
                            
                            @error('email')
                            <svg class="inside-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            @enderror
                        </div>
                        @error('email')
                            <p class="error-text">Nama pengguna atau kata sandi tidak valid</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <label style="margin-bottom: 0;">Kata sandi</label>
                            <a href="#" class="forgot-link">Lupa kata sandi?</a>
                        </div>
                        <div class="field-wrapper">
                            <input type="password" name="password" id="password-field"
                                class="input-style {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                placeholder="" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">LOGIN</button>

                    <p class="footer-text">
                        Belum punya akun? <a href="{{ route('register') }}">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>