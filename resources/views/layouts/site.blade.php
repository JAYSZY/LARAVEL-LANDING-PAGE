<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name', 'VTrack') . ' - BJMP Virac Visitor Tracking System')</title>
        <meta name="description" content="@yield('description', 'VTrack is the secure, offline-ready visitor management system of the Bureau of Jail Management and Penology - Virac District Jail.')">

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="page-body">

        <header class="site-header">
            <div class="site-header__inner">

                <a href="{{ url('/') }}" class="brand">
                    <img src="{{ asset('images/landing/bjmp-seal.png') }}" alt="BJMP Seal" class="brand__logo">
                    <span class="brand__text">
                        <span class="brand__name">VTrack</span>
                        <span class="brand__tagline">BJMP Visitor Management</span>
                    </span>
                </a>

                <a href="{{ route('login') }}" class="header-nav__link">
                    Admin Login
                </a>

            </div>
        </header>

        @yield('content')

        {{--FOOTER --}}
        <footer class="footer">
            <div class="footer-lockup-row">
                <img class="footer-seal" src="{{ asset('images/landing/bjmp-seal.png') }}" alt="BJMP Seal">
                <div class="footer-title-block">
                    <span class="footer-title">BUREAU OF JAIL MANAGEMENT AND PENOLOGY</span>
                    <span class="footer-subtitle">Safekeeping and Development</span>
                </div>
                <img class="footer-seal" src="{{ asset('images/landing/virac-shield.png') }}" alt="Virac District Jail Seal">
            </div>
            <span class="footer-credit">&copy; {{ date('Y') }} BJMP Virac &bull; VTrack v1.0 &bull; Developed by BSINFOTECH 4D</span>
        </footer>

    </body>
</html>
