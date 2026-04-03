@extends('layouts.app')

@section('title', 'Zona Jasa')

@section('content')

<main class="main">

    <!-- ======= HERO ======= -->
    <section id="hero" class="hero section dark-background">
        <img src="{{ asset('assets/img/hero-bg-2.jpg') }}" class="hero-bg" alt="">

        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1>
                        Bingung Cari Tukang & Jasa Terpercaya?<br>
                        <span>Zona Jasa</span> Solusinya
                    </h1>
                    <p>
                        Temukan tukang, teknisi, dan jasa profesional terdekat
                        dengan rating asli, harga transparan, dan booking instan.
                    </p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Get Started</a>
                    </div>
                </div>

                <!-- HERO IMAGE -->
                <div class="col-lg-4 hero-img text-center">
                    <img src="{{ asset('assets/images/m2.png') }}"
                        class="img-fluid animated hero-illustration"
                        alt="Zona Jasa Illustration">
                </div>
            </div>
        </div>

        <!-- 🌊 WAVES -->
        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none">
            <defs>
                <path id="wave-path"
                    d="M-160 44c30 0 58-18 88-18s58 18 88 18
               58-18 88-18 58 18 88 18v44h-352z">
                </path>
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3"></use>
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0"></use>
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9"></use>
            </g>
        </svg>

    </section>
    <!-- End Hero -->

    <!-- ======= ABOUT ======= -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Tentang</h2>
                <div><span>Pelajari Lebih Lanjut</span> <span class="description-title">Tentang Zona Jasa</span></div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <p>
                        Zona Jasa adalah platform modern untuk mencari dan menemukan berbagai layanan profesional dengan cepat dan mudah.
                        Cocok untuk individu maupun bisnis yang membutuhkan jasa terpercaya di berbagai bidang.
                        Dengan Zona Jasa, Anda dapat menemukan penyedia jasa terdekat, membandingkan harga, membaca ulasan, dan memesan layanan secara langsung melalui aplikasi.
                    </p>
                </div>
                <div class="col-lg-6">
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Temukan penyedia jasa terpercaya di berbagai bidang</li>
                        <li><i class="bi bi-check-circle"></i> Antarmuka mudah digunakan untuk semua kalangan</li>
                        <li><i class="bi bi-check-circle"></i> Cepat dan efisien, hemat waktu pencarian</li>
                        <li><i class="bi bi-check-circle"></i> Review dan rating membantu memilih penyedia jasa terbaik</li>
                        <li><i class="bi bi-check-circle"></i> Dukungan pelanggan siap membantu kapan saja</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End About -->

    <!-- ======= FEATURES ======= -->
    <section id="features" class="features section">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Fitur</h2>
                <div><span>Fitur</span> <span class="description-title">Kami</span></div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <i class="bi bi-search"></i>
                        <h4>Pencarian mudah</h4>
                        <p>Cari jasa yang Anda butuhkan dengan cepat dan akurat, berdasarkan lokasi atau kategori.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <i class="bi bi-people"></i>
                        <h4>Penyedia Jasa Terpercaya</h4>
                        <p>Terhubung dengan penyedia jasa profesional dan terpercaya, sudah diverifikasi oleh sistem kami.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <i class="bi bi-phone"></i>
                        <h4>Pemesanan instant</h4>
                        <p>Pesan layanan langsung melalui aplikasi, mudah dan cepat tanpa ribet.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <i class="bi bi-star"></i>
                        <h4>Ratings dan ulasan</h4>
                        <p>Baca ulasan dan rating pengguna lain untuk memastikan kualitas layanan sebelum memesan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <i class="bi bi-cash-stack"></i>
                        <h4>Harga yang transparan</h4>
                        <p>Lihat harga jasa secara jelas dan bandingkan penyedia layanan untuk keputusan terbaik.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <i class="bi bi-clock-history"></i>
                        <h4>Riwayat layanan</h4>
                        <p>Lacak semua layanan yang pernah Anda pesan, termasuk status dan detail penyedia jasa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features -->

    <!-- ======= GALLERY ======= -->
    <section id="gallery" class="gallery section">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Galeri</h2>
                <div><span>Galeri</span> <span class="description-title">Kami</span></div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-4">
                    <img src="{{ asset('assets/img/gallery/gallery-1.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('assets/img/gallery/gallery-2.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('assets/img/gallery/gallery-3.jpg') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End Gallery -->

    <!-- ======= TEAM ======= -->
    <section id="team" class="team section">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Tim</h2>
                <div><span>Tim</span> <span class="description-title">Kami</span></div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                        <h4>Akbar</h4>
                        <span>IT Director</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                        <h4>Muhammad Syamsul Marif</h4>
                        <span>Infrastructure & Operation</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <img src="{{ asset('assets/img/team/team-2.jpg') }}" class="img-fluid" alt="">
                        <h4>Miftahul Jannah</h4>
                        <span>Software Development</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                        <h4>Yoga Pratrian</h4>
                        <span>IT Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team -->

    <!-- ======= PRICING ======= -->
    <section id="pricing" class="pricing section">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Harga</h2>
                <div><span>Penetapan</span> <span class="description-title">Harga</span></div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Gratis</h3>
                        <h4><sup>$</sup>0</h4>
                        <ul>
                            <li>Fitur Dasar</li>
                            <li>Dukungan Email</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing -->

    <!-- ======= CONTACT ======= -->
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Kontak</h2>
                <div><span>Hubungi</span> <span class="description-title"></span></div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <p>Phone: +62 878 6800 0622</p>
                    <p>Email: zonajasaplatform@gmail.com</p>
                </div>
                <div class="col-lg-6">
                    <form>
                        <input type="text" class="form-control mb-3" placeholder="Nama Anda">
                        <input type="email" class="form-control mb-3" placeholder="Email Anda">
                        <textarea class="form-control mb-3" rows="4" placeholder="Pesan"></textarea>
                        <button class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection