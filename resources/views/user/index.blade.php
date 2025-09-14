@php use App\Models\User; @endphp
 @include('components.head-user')



<body class="index-page">
 @include('components.navbar-user')


  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 >Pengen Hemat Ga Perlu Ribet</h1>
            <p data-aos="fade-up" data-aos-delay="100">Kami dapat membantu dalam mengelola keuangan pribadi secara lebih efisien,
terencana, dan terintegrasi</p>
            <!-- <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="#about" class="btn-get-started">Get Started <i class="bi bi-arrow-right"></i></a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div> -->
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="{{ asset('user/landing/img/hero-img.png') }}" class="img-fluid animated" alt="Hero Image">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Apa itu CampuSave</h3>
              <h2>CampuSave adalah platform web terintegrasi dengan sistem kampus untuk
membantu mahasiswa STT NF dalam mengelola keuangan pribadi.</h2>
              <p>
                Mahasiswa yang sering kesulitan mengatur keuangan, terutama penerima KIP yang
cenderung boros karena kurangnya literasi finansial dan alat bantu efektif. Campusave hadir untuk membantu mengatur keuangan
              </p>
              <!-- <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div> -->
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('user/landing/img/5240.jpg') }}" class="img-fluid" alt="About Image">
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

      <section id="literation" class="about section">
              <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Literation</h2>
        <p>What Are Our Main Literation<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">
        <div class="row gx-50">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h2>Literasi Keuangan.</h2>
              <p>Pentingnya mahasiswa untuk memahami sumber dana KIP yang diterima, apakah mencakup biaya kuliah saja atau juga biaya hidup, sehingga pengelolaannya bisa lebih terstruktur. Selanjutnya, buat anggaran bulanan dengan memisahkan dana untuk biaya kuliah dan biaya hidup, serta mencatat setiap pengeluaran agar dapat memantau penggunaan dana secara efektif. Dalam mengelola pengeluaran, prioritaskan kebutuhan pokok seperti makanan, transportasi, dan tempat tinggal, serta berusahalah untuk lebih hemat dengan menghindari pengeluaran yang tidak perlu. Meskipun dana terbatas, usahakan untuk menyisihkan sedikit dana setiap bulan untuk tabungan atau dana darurat, yang sangat berguna jika ada kebutuhan mendesak di masa depan.
              </p>
              <!-- <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div> -->
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('user/landing/img/literasi3.jpg') }}" class="img-fluid" alt="About Image">
          </div>

        </div>
      </div>

    </section><!-- /About Section -->
    <!-- Values Section -->
    <section id="values" class="values section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Features</h2>
        <p>What Are Our Main Features<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <img src="{{ asset('user/landing/img/values-1.png') }}" class="img-fluid" alt="Value 1">
              <h3>Perencanaan anggaran</h3>
              <p>Memperkirakan pemasukan dan pengeluaran agar mahasiswa dapat mengelola keuangannya secara efektif</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <img src="{{ asset('user/landing/img/values-2.png') }}" class="img-fluid" alt="Value 2">
              <h3>Tabungan manual</h3>
              <p>Menyisihkan sebagian uang secara rutin dengan tujuan untuk mengumpulkan dana secara sederhana dan terkontrol</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <img src="{{ asset('user/landing/img/values-3.png') }}" class="img-fluid" alt="Value 3">
              <h3>Pencatatan pemasukan & pengeluaran</h3>
              <p> Mencatat setiap pemasukan dan pengeluaran secara teratur, dengan tujuan untuk memantau aliran keuangan dan membantu dalam mengelola anggaran secara efektif.</p>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section><!-- /Values Section -->
    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Our Advacedd Features<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-xl-6" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('user/landing/img/features.png') }}" class="img-fluid" alt="Features Image">
          </div>

          <div class="col-xl-6 d-flex">
            <div class="row align-self-center gy-4">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Terintegrasi dengan Kampus</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Melihat Catatan Keuangan</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Registrasi dan Login Mahasiswa</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Akses Admin untuk Mengelola Akun</h3>
                </div>
              </div><!-- End Feature Item -->

            </div>
          </div>

        </div>

      </div>

    </section><!-- /Features Section -->

  </main>

          <!-- Main Sidebar Container -->
        @include('components.footer-user')

