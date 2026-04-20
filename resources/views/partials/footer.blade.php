<footer id="footer" class="footer dark-background">

    <div class="container footer-top">
        <div class="row gy-4">

            <!-- Brand & Contact -->
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    <span class="sitename">Zona Jasa</span>
                </a>

                <div class="footer-contact pt-3">
                    <p>Kota Kendari</p>
                    <p>Provinsi Sulawesi Tenggara</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+62 878 6800 0622</span></p>
                    <p><strong>Email:</strong> <span>zonajasaplatform@gmail.com</span></p>
                </div>

                <div class="social-links d-flex mt-4">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- Useful Links -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}#hero">Home</a></li>
                    <li><a href="{{ route('home') }}#about">About us</a></li>
                    <li><a href="{{ route('home') }}#features">Services</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Product Management</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Graphic Design</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-4 col-md-12 footer-newsletter">
                <h4>Our Newsletter</h4>
                <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>

                <form action="#" method="post">
                    <div class="newsletter-form">
                        <input type="email" name="email" placeholder="Email address">
                        <input type="submit" value="Subscribe">
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Copyright -->
    <div class="container copyright text-center mt-4">
        <p>
            © <span>Copyright</span>
            <strong class="px-1 sitename">Zona Jasa</strong>
            <span>All Rights Reserved</span>
        </p>
    </div>

</footer>