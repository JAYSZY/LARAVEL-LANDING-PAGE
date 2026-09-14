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

        <header class="site-header" x-data="{ open: false }">
            <div class="site-header__inner">

                <a href="{{ url('/') }}" class="brand">
                    <img src="{{ asset('images/landing/bjmp-seal.png') }}" alt="BJMP Seal" class="brand__logo">
                    <span class="brand__text">
                        <span class="brand__name">VTrack</span>
                        <span class="brand__tagline">BJMP Visitor Management</span>
                    </span>
                </a>

                <nav class="site-nav">
                    <a href="{{ url('/') }}" class="site-nav__link {{ url()->current() === url('/') ? 'site-nav__link--active' : '' }}">Home</a>
                    <a href="{{ route('request.create') }}" class="site-nav__link {{ request()->routeIs('request.*') ? 'site-nav__link--active' : '' }}">Request Access</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="site-nav__link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="site-nav__link">Staff Login</a>
                    @endauth
                </nav>

                <button type="button" class="site-nav__toggle" @click="open = ! open" aria-label="Toggle navigation">
                    <x-heroicon-o-bars-3 class="h-6 w-6" x-show="! open" />
                    <x-heroicon-o-x-mark class="h-6 w-6" x-show="open" x-cloak />
                </button>
            </div>

            <div class="site-nav-mobile" x-show="open" x-cloak>
                <a href="{{ url('/') }}" class="site-nav-mobile__link">Home</a>
                <a href="{{ route('request.create') }}" class="site-nav-mobile__link">Request Access</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="site-nav-mobile__link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="site-nav-mobile__link">Staff Login</a>
                @endauth
            </div>
        </header>

        @yield('content')

        {{--FOOTER --}}
        <footer class="site-footer">

            {{-- Contact info bar --}}
            <div class="site-footer__grid">

                @php
                    $contact = [
                        ['icon' => 'map-pin', 'text' => 'Brgy. Calatagan, Virac,<br>Catanduanes, Philippines'],
                        ['icon' => 'phone', 'text' => '09971578500'],
                        ['icon' => 'envelope', 'text' => 'viracjail@bjmp.gov.ph<br>&#64;BJMPViracOfficial'],
                        ['icon' => 'clock', 'text' => 'Mon &ndash; Sun: 8:00 AM &ndash; 4:00 PM'],
                    ];
                @endphp

                @foreach ($contact as $item)
                    <div class="footer-item">
                        <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="icon-amber-sm" />
                        <p class="footer-item__text">{!! $item['text'] !!}</p>
                    </div>
                @endforeach

            </div>

            <div class="site-footer__bottom">
                <p class="site-footer__copyright">&copy; {{ date('Y') }} BJMP Virac District Jail. All rights reserved.</p>
                <div class="site-footer__links">
                    <a href="{{ url('/') }}" class="site-footer__link">Home</a>
                    <a href="{{ route('request.create') }}" class="site-footer__link">Request Access</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="site-footer__link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="site-footer__link">Staff Login</a>
                    @endauth
                </div>
            </div>
        </footer>

    </body>
</html>
