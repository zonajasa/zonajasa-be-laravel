@extends('layouts.app')

@section('title', 'Download ZonaJasa - Aplikasi Modern untuk Produktivitas Anda')

@section('content')

<nav class="navbar fixed-top bg-transparent navbar-landing">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Logo / Brand -->
        <a class="navbar-brand fw-bold text-dark d-flex align-items-center gap-2" href="#hero">
            <img src="{{ asset('images/LogoZonaJasa.png') }}"
                alt="ZonaJasa Logo"
                class="navbar-logo">
            <span>ZonaJasa</span>
        </a>

        <!-- Menu kanan (selalu tampil) -->
        <ul class="navbar-nav d-flex flex-row align-items-center gap-4 mb-0">
            <li class="nav-item">
                <a class="nav-link text-dark" href="#features">Fitur</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#faq">FAQ</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary btn-sm px-4 rounded-pill" href="#download">
                    Get App
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- HERO -->
<section id="hero" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">
                    Solusi Pencarian Jasa dalam Satu Aplikasi
                </h1>
                <p class="hero-subtitle">
                    Temukan dan pesan berbagai jasa profesional dengan mudah, cepat, dan aman langsung dari genggaman Anda.
                </p>

                <div class="d-flex gap-3 mt-4 store-badge-wrapper">
                    <img src="{{ asset('images/gplay.png') }}" class="store-badge" alt="Google Play">
                    <img src="{{ asset('images/appstore.png') }}" class="store-badge" alt="App Store">
                </div>
            </div>

            <div class="col-md-6 text-center">
                <img src="{{ asset('images/m1.png') }}"
                    loading="lazy"
                    class="img-fluid hero-mockup-small">
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="features-section">
    <div class="container">

        <!-- Heading -->
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6">
                Kenapa Memilih <span class="text-primary">ZonaJasa</span>?
            </h2>
            <p class="text-muted mt-2">
                Solusi pencarian jasa yang cepat, aman, dan terpercaya untuk kebutuhan Anda
            </p>
        </div>

        <!-- Feature Cards -->
        <div class="row g-4">

            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-primary">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <h5>Pencarian Cepat & Akurat</h5>
                    <p>
                        Temukan penyedia jasa terdekat hanya dalam hitungan detik dengan sistem pencarian yang responsif.
                    </p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-success">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h5>Keamanan Terjamin</h5>
                    <p>
                        Data pribadi dan transaksi Anda dilindungi dengan sistem keamanan berlapis berstandar industri.
                    </p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-warning text-dark">
                        <i class="bi bi-phone-fill"></i>
                    </div>
                    <h5>Akses Fleksibel</h5>
                    <p>
                        Gunakan ZonaJasa kapan saja melalui perangkat Android maupun iOS tanpa batasan.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="faq-section">
    <div class="container">

        <!-- Heading -->
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6">
                Pertanyaan yang Sering Diajukan
            </h2>
            <p class="text-muted mt-2">
                Temukan jawaban atas pertanyaan umum seputar ZonaJasa
            </p>
        </div>

        <!-- FAQ Wrapper -->
        <div class="faq-wrapper mx-auto">

            <div class="accordion" id="faqAccordion">

                <!-- FAQ Item -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apa itu ZonaJasa?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            ZonaJasa adalah aplikasi pencarian jasa yang membantu Anda menemukan dan memesan
                            berbagai layanan profesional secara cepat, mudah, dan terpercaya.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faq2">
                            Jenis jasa apa saja yang tersedia?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Tersedia berbagai kategori jasa seperti layanan rumah tangga, teknisi,
                            jasa profesional, hingga kebutuhan harian sesuai lokasi Anda.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faq3">
                            Apakah ZonaJasa aman digunakan?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya. ZonaJasa menggunakan sistem keamanan berlapis untuk melindungi data
                            serta memastikan transaksi berjalan dengan aman.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faq4">
                            Apakah aplikasi ini gratis?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Aplikasi dapat diunduh dan digunakan secara gratis.
                            Biaya hanya dikenakan sesuai jasa yang Anda pesan.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faq5">
                            Apakah tersedia di Android & iOS?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya. ZonaJasa tersedia untuk perangkat Android dan iOS,
                            sehingga bisa diakses kapan saja dan di mana saja.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container text-center">
        <p class="fw-semibold">ZonaJasa</p>
        <div class="d-flex justify-content-center gap-3 mb-2">
            <a href="#" class="text-muted">Privacy Policy</a>
            <a href="#" class="text-muted">Terms</a>
            <a href="#" class="text-muted">Contact</a>
        </div>
        <small class="text-muted">&copy; {{ date('Y') }} ZonaJasa</small>
    </div>
</footer>

@endsection