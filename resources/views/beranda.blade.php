<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parfum ELIXIRE</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400&display=swap" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  </head>
  <body>
    <div class="main-container">
      <div class="landing-1">
        <div class="main-wrapper">
          <div class="hero-section-container">
            <div class="top-navigation-bar">
              <div class="navigation-links-left">
                <div class="link"></div>
                <div class="link-2"></div>
              </div>
              <div class="container">
                <div class="container-3"><div class="svg"></div></div>
                <div class="heading"><span class="text">ÉLIXIRÉ</span></div>
              </div>
              <div class="utilities-right">
                <form action="{{ route('search') }}" method="GET" style="display: flex; align-items: center; justify-content: flex-end; gap: 5px; position: relative; overflow: hidden;">
    
    <div id="papanCariKontainer" style="width: 0; opacity: 0; transition: width 0.4s ease, opacity 0.3s ease; overflow: hidden;">
        <input type="text" id="papanCari" name="query" placeholder="Cari parfum..." 
               style="width: 200px; /* Lebar penuh saat muncul */
                      border: 1px solid #d9d9d9; border-radius: 20px; padding: 5px 15px; outline: none; font-size: 14px; box-sizing: border-box;">
    </div>

    <button type="button" id="tombolSearch" style="background: none; border: none; cursor: pointer; padding: 0; z-index: 2;">
        <div class="vector"></div> </button>
</form>
</div>
            </div>
            <div class="background-image-overlay">
              <div class="overlay"></div>
            </div>
            <div class="blur-content"></div>
            <div class="hero-content">
              <div class="container-4">
                <div class="heading-5">
                  <span class="scent-of-authority">
                    Scent of Authority<br />Unspoken Influence</span
                  >
                </div>
                <div class="container-6"></div>
                <span class="diracik-dari-esensi"
                  >Diracik dari esensi pilihan dunia,ELIXIRE menghadirkan jejak
                  yang tenang,berkelas,dan tidak mudah dilupakan.</span>
               <div class="cta-buttons">
  <a href="{{ route('login') }}" class="button" style="text-decoration: none;">
    <div class="button-shadow"></div>
    <span class="text-7">LOGIN</span>
  </a>

  <a href="{{ route('register') }}" class="button-8" style="text-decoration: none;">
    <div class="button-shadow-9"></div>
    <span class="register">REGISTER</span>
  </a>
</div>
                </div>
              </div>
            </div>
          </div>
          <div class="collection-preview-section">
            <div class="container-a">
              <div class="container-b">
                <div class="container-c">
                  <div class="heading-d">
                    <span class="koleksi">Koleksi</span>
                  </div>
                  <div class="container-e">
                    <span class="setiap-botol-tersimpan"
                      >Setiap botol tersimpan warisan craftsmanship
                      sejati,disempurnakan oleh waktu dan dirancang untuk
                      melampaui generasi.</span
                    >
                  </div>
                </div>
                <div class="link-f">
                  <span class="explore-all">Jelajahi semuanya</span>
                  <div class="container-10"><div class="icon"></div></div>
                </div>
              </div>
            <!-- Product Section -->
<section class="max-w-6xl mx-auto py-12 px-6">

    <h2 class="text-2xl font-bold mb-8 text-gray-800">
        Our Cakes
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($products as $product)

        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

            <!-- Image -->
            <img src="{{ asset('storage/'.$product->image) }}"
                 class="w-full h-48 object-cover">

            <!-- Content -->
            <div class="p-4">

                <h3 class="text-lg font-semibold text-gray-800">
                    {{ $product->name }}
                </h3>
            </div>
        </div>
        @endforeach
    </div>
</section>
          <div class="stats-section">
            <div class="container-26">
              <div class="container-27">
                <div class="container-28">
                  <span class="aroma-eksklusif">aroma eksklusif</span>
                </div>
                <div class="container-29"><span class="text-2a">50+</span></div>
                <div class="horizontal-divider"></div>
              </div>
              <div class="container-2b">
                <div class="container-2c">
                  <span class="butik-global">butik global</span>
                </div>
                <div class="container-2d"><span class="text-2e">12</span></div>
                <div class="horizontal-divider-2f"></div>
              </div>
              <div class="container-30">
                <div class="container-31">
                  <span class="warisan-tahunan">WARISAN TAHUNAN</span>
                </div>
                <div class="container-32"><span class="text-33">25+</span></div>
                <div class="horizontal-divider-34"></div>
              </div>
            </div>
          </div>
          <div class="footer">
            <div class="container-35">
              <div class="container-36">
                <div class="container-37">
                  <div class="container-38"><div class="svg-39"></div></div>
                  <div class="heading-3a">
                    <span class="text-3b">ÉLIXIRÉ</span>
                  </div>
                </div>
                <div class="margin"></div>
              </div>
              <div class="container-3c"><div class="container-3d"></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script>
    const tombol = document.getElementById('tombolSearch');
    const papanCari = document.getElementById('papanCari');
    const kontainer = document.getElementById('papanCariKontainer');
    const form = tombol.closest('form');

    // 1. Logika Klik Tombol
    tombol.addEventListener('click', function(e) {
        // Cek apakah kontainer sedang tertutup (width 0)
        if (kontainer.style.width === '0px' || kontainer.style.width === '') {
            // Munculkan dengan animasi
            kontainer.style.width = '210px'; // Sesuaikan lebar total yang diinginkan (input + padding)
            kontainer.style.opacity = '1';
            
            // Fokus ke input setelah animasi selesai (0.4 detik)
            setTimeout(() => {
                papanCari.focus();
            }, 400);
        } else {
            // Jika sudah terbuka dan ada isinya, lakukan pencarian
            if (papanCari.value.trim() !== "") {
                form.submit();
            } else {
                // Jika kosong dan diklik lagi, sembunyikan dengan animasi
                sembunyikanPapanCari();
            }
        }
    });

    // 2. Logika Sembunyi Otomatis (Saat klik di luar atau tidak fokus)
    papanCari.addEventListener('blur', function() {
        // Beri delay agar submit form tidak terpotong
        setTimeout(() => {
            if (papanCari.value.trim() === "") {
                sembunyikanPapanCari();
            }
        }, 250);
    });

    // Fungsi pembantu untuk menyembunyikan dengan animasi
    function sembunyikanPapanCari() {
        kontainer.style.width = '0px';
        kontainer.style.opacity = '0';
    }
</script>
  </body>
</html>
