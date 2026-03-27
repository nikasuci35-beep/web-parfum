<!DOCTYPE html>
<html lang="id">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>ÉLIXIRÉ - Buat Akun</title>
    <link rel="stylesheet" href="{{ asset('css/regristrasi.css') }}" />
  </head>
  <body>
    <main class="register">
      <div class="main">
        <!-- Left Side: Branding / Hero Image -->
        <section class="left-side-dramatic" aria-label="Branding">
          <div class="background"><div class="gradient"></div></div>
          <div class="branding-overlay">
            <div class="container">
              <div class="div-wrapper">
                <div class="SVG">
                  <img class="vector" src="img/vector.svg" alt="ÉLIXIRÉ logo icon" />
                </div>
              </div>
              <div class="heading">
                <div class="text">ÉLIXIRÉ</div>
              </div>
            </div>
            <div class="div">
              <div class="scent-of-authority-wrapper">
                <p class="scent-of-authority">
                  <span class="text-wrapper">Scent of authority<br /></span>
                  <span class="span">Unspoken Influence</span>
                </p>
              </div>
              <div class="background-2"></div>
            </div>
            <div class="container-2"></div>
          </div>
        </section>
        <!-- Right Side: Registration Form -->
        <section class="right-side" aria-label="Registration Form">
          <div class="container-wrapper">
            <div class="div">
              <!-- Form Header -->
              <header class="form-header">
                <div class="div-wrapper-2">
                  <h1 class="text-wrapper-2">Buat Akun Anda</h1>
                </div>
                <div class="div-wrapper-2">
                  <p class="p">Mulailah perjalanan wangimu hari ini.</p>
                </div>
              </header>
              <!-- Registration Form -->
              <form class="registration-form" novalidate aria-label="Form registrasi">
                <!-- Nama Lengkap -->
                <div class="div-2">
                  <label class="nama-lengkap" for="nama-lengkap">NAMA LENGKAP</label>
                  <div class="input">
                    <input
                      class="container-3 field-input"
                      type="text"
                      id="nama-lengkap"
                      name="nama_lengkap"
                      autocomplete="name"
                      placeholder=""
                      aria-required="true"
                    />
                  </div>
                </div>
                <!-- Alamat Email -->
                <div class="div-2">
                  <label class="alamat-email" for="alamat-email">ALAMAT EMAIL</label>
                  <div class="input">
                    <input
                      class="container-3 field-input"
                      type="email"
                      id="alamat-email"
                      name="alamat_email"
                      autocomplete="email"
                      placeholder=""
                      aria-required="true"
                    />
                  </div>
                </div>
                <!-- Nama Pengguna -->
                <div class="div-2">
                  <label class="nama-pengguna" for="nama-pengguna">NAMA PENGGUNA</label>
                  <div class="input">
                    <input
                      class="container-3 field-input"
                      type="text"
                      id="nama-pengguna"
                      name="nama_pengguna"
                      autocomplete="username"
                      placeholder=""
                      aria-required="true"
                    />
                  </div>
                </div>
                <!-- Kata Sandi -->
                <div class="div-2">
                  <label class="kata-sandi" for="kata-sandi">KATA SANDI</label>
                  <div class="input password-input-wrapper">
                    <input
                      class="container-3 field-input"
                      type="password"
                      id="kata-sandi"
                      name="kata_sandi"
                      autocomplete="new-password"
                      placeholder=""
                      aria-required="true"
                    />
                    <button
                      type="button"
                      class="toggle-password"
                      aria-label="Tampilkan kata sandi"
                      data-target="kata-sandi"
                    >
                      <img class="eye-icon" src="img/icon-eye.svg" alt="" aria-hidden="true" />
                    </button>
                  </div>
                </div>
                <!-- Konfirmasi Kata Sandi -->
                <div class="div-2">
                  <label class="konfirmasi-kata" for="konfirmasi-kata-sandi">KONFIRMASI KATA SANDI</label>
                  <div class="input password-input-wrapper">
                    <input
                      class="container-3 field-input"
                      type="password"
                      id="konfirmasi-kata-sandi"
                      name="konfirmasi_kata_sandi"
                      autocomplete="new-password"
                      placeholder=""
                      aria-required="true"
                    />
                    <button
                      type="button"
                      class="toggle-password"
                      aria-label="Tampilkan konfirmasi kata sandi"
                      data-target="konfirmasi-kata-sandi"
                    >
                      <img class="eye-icon" src="img/icon-eye.svg" alt="" aria-hidden="true" />
                    </button>
                  </div>
                </div>
                <!-- Terms & Conditions -->
                <div class="terms-conditions">
                  <input class="input-2" type="checkbox" id="terms" name="terms" aria-required="true" />
                  <div class="div-wrapper">
                    <label class="isetuju-dengan" for="terms">Isetuju dengan Syarat &amp; Ketentuan</label>
                  </div>
                </div>
                <!-- Submit Button -->
                <button class="submit-button" type="submit" aria-label="Daftar akun baru">
                  <div class="submit-button-shadow"></div>
                  <div class="container-4"><span class="text-2">Register</span></div>
                  <div class="container-4"><img class="icon" src="img/icon.svg" alt="" aria-hidden="true" /></div>
                </button>
              </form>
              <!-- Login Link -->
              <div class="login-link">
                <span class="text-wrapper-3">Sudah punya akun?</span>
                <div class="link">
                  <a class="text-3" href="/login">Login</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <script>
      // Toggle password visibility
      document.querySelectorAll(".toggle-password").forEach(function (btn) {
        btn.addEventListener("click", function () {
          var targetId = btn.getAttribute("data-target");
          var input = document.getElementById(targetId);
          if (input) {
            var isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            btn.setAttribute("aria-label", isPassword ? "Sembunyikan kata sandi" : "Tampilkan kata sandi");
          }
        });
      });
    </script>
  </body>
</html>
