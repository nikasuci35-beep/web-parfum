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
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/img/bg-login.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 80px;
            color: white;
            position: relative;
        }

        .logo-top { position: absolute; top: 40px; left: 40px; font-weight: bold; letter-spacing: 4px; font-size: 20px; }
        
        .side-text { border-left: 4px solid #C1A35F; padding-left: 25px; }
        .side-text h2 { font-style: italic; font-weight: 300; font-size: 28px; margin-bottom: 5px; opacity: 0.9; }
        .side-text h1 { font-size: 55px; text-transform: uppercase; font-weight: 800; line-height: 1; letter-spacing: -1px; }

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

        .header h2 { font-size: 42px; color: #1a1a1a; margin-bottom: 8px; font-family: serif; }
        .header p { color: #888; font-style: italic; margin-bottom: 35px; font-size: 15px; }

        /* --- ALERT ERROR (PERSIS GAMBAR) --- */
        .alert-error {
            background-color: #FEF2F2;
            border: 1px solid #FEE2E2;
            color: #B45454;
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
        .input-group label { display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; color: #555; margin-bottom: 10px; letter-spacing: 1.5px; }
        
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
        .input-style.is-invalid { border-color: #F87171; }

        .error-text { color: #EF4444; font-size: 11px; margin-top: 6px; font-weight: bold; }
        
        /* Ikon di dalam input */
        .inside-icon { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #EF4444; width: 16px; }

        .forgot-link { float: right; color: #C1A35F; text-decoration: none; font-size: 11px; font-weight: bold; }

        /* --- BUTTON --- */
        .btn-login {
            width: 100%;
            background-color: #C1A35F;
            color: white;
            padding: 18px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 13px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.4s;
            box-shadow: 0 5px 15px rgba(193, 163, 95, 0.2);
        }
        .btn-login:hover { background-color: #000; transform: translateY(-2px); }

        .footer-text { text-align: center; margin-top: 30px; font-size: 13px; color: #888; }
        .footer-text a { color: #1a1a1a; font-weight: bold; text-decoration: none; border-bottom: 1px solid #1a1a1a; }

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
            <div class="logo-top">ÉLIXIRÉ</div>
            <div class="side-text">
                <h2>Scent of authority</h2>
                <h1>Unspoken Influence</h1>
            </div>
        </div>

        <div class="side-right">
            <div class="form-container">
                <div class="header">
                    <h2>Welcome Back</h2>
                    <p>Login to continue your fragrance journey</p>
                </div>

                @if ($errors->any())
                <div class="alert-error">
                    <svg class="alert-icon" viewBox="0 0 24 24"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0116 0z" /></svg>
                    <span>Account not registered. Please check your details.</span>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <label>Username</label>
                        <div class="field-wrapper">
                            <input type="email" name="email" value="{{ old('email') }}" 
                                class="input-style {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                placeholder="alex vaughan" required autofocus>
                            
                            @error('email')
                            <svg class="inside-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                            @enderror
                        </div>
                        @error('email')
                            <p class="error-text">Invalid username or password</p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <a href="#" class="forgot-link">Forgot password?</a>
                        <label>Password</label>
                        <div class="field-wrapper">
                            <input type="password" name="password" 
                                class="input-style {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                placeholder="••••••••" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">LOGIN</button>

                    <p class="footer-text">
                        Don't have an account? <a href="{{ route('register') }}">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>