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
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li><a href="{{ route('home') }}#features">Features</a></li>
                <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
                <li><a href="{{ route('home') }}#team">Team</a></li>
                <li><a href="{{ route('home') }}#pricing">Pricing</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>

            </ul>

            <!-- Mobile Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>