<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLIXIRÉ - Welcome Back</title>
    <link rel="stylesheet" href="logingagal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div class="left-section">
            <div class="logo-container">
                <img src="logo.png" alt="ÉLIXIRÉ Logo" class="logo-img">
                <span class="logo-text">ÉLIXIRÉ</span>
            </div>
            <div class="parfum-container">
                <img src="parfum.png" alt="Parfum ÉLIXIRÉ" class="parfum-img">
            </div>
            <div class="text-container">
                <h1 class="headline">Scent of authority</h1>
                <h2 class="sub-headline">Unspoken Influence</h2>
            </div>
        </div>

        <div class="right-section">
            <div class="form-wrapper">
                <h1 class="welcome-title">Welcome Back</h1>
                <p class="welcome-subtitle">Login to continue your fragrance journey</p>

                <div class="alert alert-danger" role="alert">
                    <img src="error-icon.png" alt="Error" class="error-icon">
                    Account not registered. Please check your details.
                </div>

                <form class="login-form">
                    <div class="mb-3 input-group-container">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" placeholder="alex.vaughan" value="alex.vaughan">
                            <span class="input-group-text"><img src="error-icon-small.png" alt="!"></span>
                        </div>
                        <p class="text-danger error-text">Invalid username or password</p>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label mb-0">Password</label>
                            <a href="#" class="forgot-password-link">Forgot password?</a>
                        </div>
                        <input type="password" class="form-control" id="password" placeholder="password123" value="password123">
                    </div>

                    <button type="submit" class="btn btn-login w-100">LOGIN</button>
                </div>

                <div class="text-center mt-3">
                    <p class="register-text">Don't have an account? <a href="register.blade.php" class="register-link">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>