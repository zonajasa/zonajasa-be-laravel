<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <a href="{{ route('landing.index') }}" class="logo d-flex align-items-center">
            <h1 class="sitename">Zona Jasa</h1>
        </a>

        <!-- Navigation -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('landing.index') }}#hero" class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">landing.index</a></li>
                <li><a href="{{ route('landing.index') }}#about">Tentang</a></li>
                <li><a href="{{ route('landing.index') }}#features">Fitur</a></li>
                <li><a href="{{ route('landing.index') }}#gallery">Galeri</a></li>
                <li><a href="{{ route('landing.index') }}#team">Tim</a></li>
                <li><a href="{{ route('landing.index') }}#pricing">Harga</a></li>
                <li><a href="{{ route('landing.index') }}#contact">Kontak</a></li>
            </ul>

            <!-- Mobile Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>