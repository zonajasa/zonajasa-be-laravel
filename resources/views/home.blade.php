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
                <h2>About</h2>
                <div><span>Learn More</span> <span class="description-title">About Us</span></div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <p>
                        Zona Jasa is a modern landing page template built with Bootstrap.
                        Perfect for startups, SaaS, and digital services.
                    </p>
                </div>
                <div class="col-lg-6">
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Responsive Design</li>
                        <li><i class="bi bi-check-circle"></i> Clean UI</li>
                        <li><i class="bi bi-check-circle"></i> Easy Customization</li>
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
                <h2>Features</h2>
                <div><span>Our</span> <span class="description-title">Features</span></div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="feature-box">
                        <i class="bi bi-speedometer2"></i>
                        <h4>Fast Performance</h4>
                        <p>Optimized for speed and usability.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-box">
                        <i class="bi bi-palette"></i>
                        <h4>Modern Design</h4>
                        <p>Clean and professional UI.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-box">
                        <i class="bi bi-shield-check"></i>
                        <h4>Secure</h4>
                        <p>Built with best security practices.</p>
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
                <h2>Gallery</h2>
                <div><span>Our</span> <span class="description-title">Gallery</span></div>
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
                <h2>Team</h2>
                <div><span>Our</span> <span class="description-title">Team</span></div>
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
                <h2>Pricing</h2>
                <div><span>Our</span> <span class="description-title">Pricing</span></div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Free</h3>
                        <h4><sup>$</sup>0</h4>
                        <ul>
                            <li>Basic Features</li>
                            <li>Email Support</li>
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
                <h2>Contact</h2>
                <div><span>Get In</span> <span class="description-title">Touch</span></div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <p>Email: zonajasaplatform@gmail.com</p>
                    <p>Phone: +62 878 6800 0622</p>
                </div>
                <div class="col-lg-6">
                    <form>
                        <input type="text" class="form-control mb-3" placeholder="Your Name">
                        <input type="email" class="form-control mb-3" placeholder="Your Email">
                        <textarea class="form-control mb-3" rows="4" placeholder="Message"></textarea>
                        <button class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection