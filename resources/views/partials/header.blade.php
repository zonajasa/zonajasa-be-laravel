<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <h1 class="sitename">Zona Jasa</h1>
        </a>

        <!-- Navigation -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}#hero" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('home') }}#about">Tentang</a></li>
                <li><a href="{{ route('home') }}#features">Fitur</a></li>
                <li><a href="{{ route('home') }}#gallery">Galeri</a></li>
                <li><a href="{{ route('home') }}#team">Tim</a></li>
                <li><a href="{{ route('home') }}#pricing">Harga</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
            </ul>

            <!-- Mobile Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>