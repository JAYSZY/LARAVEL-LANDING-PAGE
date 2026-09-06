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

            </div>
        </header>

        @yield('content')

        {{-- ============================================================
             FOOTER
             Two parts:
             1) a contact info bar (location / phone / email / visiting
                hours) copied from the official BJMP Virac website.
             2) a slim credit line matching the sign-in screen's footer.
        ============================================================= --}}
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
        </footer>

    </body>
</html>
