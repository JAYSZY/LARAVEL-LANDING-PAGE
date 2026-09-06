<header class="site-header">
    <div class="site-header__inner">

        <a href="{{ url('/') }}" class="brand">
            <img src="{{ asset('images/landing/bjmp-seal.png') }}" alt="BJMP Seal" class="brand__logo">
            <span class="brand__text">
                <span class="brand__name">VTrack</span>
                <span class="brand__tagline">BJMP Visitor Management</span>
            </span>
        </a>

        <nav class="site-header__nav">
            <a href="{{ $navHref ?? '#features' }}" class="btn-outline">
                {{ $navLabel ?? 'Learn More' }}
            </a>
        </nav>

    </div>
</header>
