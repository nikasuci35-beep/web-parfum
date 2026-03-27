<!DOCTYPE html>
<html lang="id">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>ÉLIXIRÉ - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
  </head>
  <body>
    <main class="login">
      <div class="main">
        <!-- Left Side: Hero/Branding Section -->
        <section class="section-left-side">
          <img class="background-image" src="{{ asset('image/login.png') }}" alt="Perfume background" />
          <div class="dark-overlay" aria-hidden="true"></div>
          <div class="gradient-overlay-for" aria-hidden="true"></div>
          <!-- Logo -->
          <div class="logo-top-left" role="banner">
            <div class="container">
              <div class="SVG" aria-hidden="true">
                <img class="vector" src="image/logo.png" alt="" />
              </div>
            </div>
            <div class="div-wrapper">
              <span class="text-wrapper">ÉLIXIRÉ</span>
            </div>
          </div>
          <!-- Center Tagline -->
          <div class="center-content">
            <div class="div">
              <div class="heading">
                <p class="scent-of-authority">
                  <span class="span">Scent of authority<br /></span>
                  <span class="text-wrapper-2">Unspoken Influence</span>
                </p>
              </div>
              <div class="background" aria-hidden="true"></div>
            </div>
          </div>
        </section>
        <!-- Right Side: Login Form Section -->
        <section class="section-right-side" aria-label="Login Form">
          <div class="container-2">
            <!-- Header -->
            <header class="header">
              <div class="div-wrapper-2">
                <h1 class="text-wrapper-3">Selamat Datang Kembali</h1>
              </div>
              <div class="div-wrapper-2">
                <p class="p">Masuk untuk melanjutkan perjalanan wewangian Anda</p>
              </div>
            </header>
            <!-- Form -->
            <form class="form" novalidate>
              <!-- Username Field -->
              <div class="div-2">
                <div class="div-wrapper-2">
                  <label class="text-wrapper-4" for="username">Nama Pengguna</label>
                </div>
                <div class="div-wrapper-2">
                  <div class="input">
                    <input
                      class="input-field"
                      id="username"
                      type="text"
                      name="username"
                      autocomplete="username"
                      aria-label="Nama Pengguna"
                      placeholder=""
                    />
                  </div>
                </div>
                <div class="container-4" aria-live="polite" role="alert"></div>
              </div>
              <!-- Password Field -->
              <div class="div-2">
                <div class="container-5">
                  <div class="div-wrapper">
                    <label class="text-wrapper-5" for="password">Kata sandi</label>
                  </div>
                  <div class="div-wrapper">
                    <a href="#" class="text-wrapper-6" aria-label="Lupa kata sandi?">Lupa kata sandi?</a>
                  </div>
                </div>
                <div class="password-input-wrapper">
                  <input
                    class="input-field password-field"
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="current-password"
                    aria-label="Kata sandi"
                    placeholder=""
                  />
                  <button
                    type="button"
                    class="toggle-password"
                    aria-label="Tampilkan atau sembunyikan kata sandi"
                    aria-pressed="false"
                  >
                    <img src="img/container.svg" alt="" aria-hidden="true" class="eye-icon" />
                  </button>
                </div>
              </div>
              <!-- Submit Button -->
              <button class="login-button" type="submit">
                <span class="text">LOGIN</span>
              </button>
            </form>
            <!-- Footer Link -->
            <div class="footer-link">
              <span class="text-wrapper-7">Belum punya akun?</span>
              <div class="link">
                <a href="{{ route('register') }}" class="text-2">Register</a>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <script>
      // Toggle password visibility
      const toggleBtn = document.querySelector(".toggle-password");
      const passwordInput = document.querySelector("#password");

      if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener("click", function () {
          const isPassword = passwordInput.type === "password";
          passwordInput.type = isPassword ? "text" : "password";
          toggleBtn.setAttribute("aria-pressed", isPassword ? "true" : "false");
        });
      }
    </script>
  </body>
</html>
