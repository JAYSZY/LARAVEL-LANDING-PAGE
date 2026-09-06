<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="snap-y snap-mandatory scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'VTrack') }} - BJMP Virac Visitor Tracking System</title>
        <meta name="description" content="VTrack is the secure, offline-ready visitor management system of the Bureau of Jail Management and Penology - Virac District Jail.">

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="page-body">

        @include('partials.site-header')

        <section class="hero">
            <img src="{{ asset('images/landing/BJMP1.png') }}" alt="Virac District Jail, Building 1"
                 class="hero__image">
            <div class="hero__overlay"></div>

            <div class="hero__content">
                <h1 class="hero__title">
                    Secure visitor tracking for BJMP Virac
                </h1>

                <div class="hero__divider">
                    <span class="hero__divider-line"></span>
                    <x-heroicon-s-star class="hero__divider-icon" />
                    <span class="hero__divider-line"></span>
                </div>

                <p class="hero__subtitle">
                    VTrack replaces the paper logbook with a fast, offline-ready system for recording,
                    verifying, and monitoring every visitor who enters the facility.
                </p>

                <div class="hero__actions">
                    <a href="#features" class="btn-outline-lg">
                        See How It Works
                    </a>
                </div>

                <p class="hero__tagline">
                    Secure &middot; Encrypted &middot; Works Offline
                </p>
            </div>
        </section>

        <div class="content-frame">

            {{-- ============================================================
                 FEATURE HIGHLIGHTS
                 Three cards describing what makes VTrack useful at the gate.
            ============================================================= --}}
            <section id="features" class="features">
                <div class="container-wide">

                    <div class="section-heading">
                        <h2 class="section-heading__title">Built for the gate, not just the office</h2>
                        <p class="section-heading__desc">
                            Every feature is designed around one goal: making visitor check-in fast for staff
                            and safe for the facility.
                        </p>
                    </div>

                    <div class="feature-grid">

                        @php
                            $features = [
                                ['icon' => 'finger-print', 'title' => 'Biometric Fingerprint', 'desc' => "Confirm a visitor's identity right at the gate with fingerprint verification."],
                                ['icon' => 'identification', 'title' => 'OCR ID Capture', 'desc' => "Scan a government ID and auto-fill the visitor's details in seconds."],
                                ['icon' => 'lock-closed', 'title' => 'Encrypted & Offline', 'desc' => 'Visitor records are encrypted and stored locally, so the system keeps working without internet.'],
                            ];
                        @endphp

                        @foreach ($features as $feature)
                            <div class="card">
                                <div class="card__icon">
                                    <x-dynamic-component :component="'heroicon-o-' . $feature['icon']" class="icon-amber" />
                                </div>
                                <h3 class="card__title">{{ $feature['title'] }}</h3>
                                <p class="card__desc">{{ $feature['desc'] }}</p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>

            {{-- ============================================================
                 TRUST BADGES
                 Reassurance strip, echoing the "Secure / Encrypted / Offline
                 Ready" badges shown on the VTrack sign-in screen.
            ============================================================= --}}
            <section class="badges">
                <div class="badges__grid">

                    @php
                        $badges = [
                            ['icon' => 'shield-check', 'label' => 'Secure', 'desc' => 'Protected system access'],
                            ['icon' => 'lock-closed', 'label' => 'Encrypted', 'desc' => 'All visitor data is encrypted'],
                            ['icon' => 'signal-slash', 'label' => 'Offline Ready', 'desc' => 'Works without an internet connection'],
                        ];
                    @endphp

                    @foreach ($badges as $badge)
                        <div>
                            <div class="badge__icon">
                                <x-dynamic-component :component="'heroicon-o-' . $badge['icon']" class="icon-navy" />
                            </div>
                            <h4 class="badge__title">{{ $badge['label'] }}</h4>
                            <p class="badge__desc">{{ $badge['desc'] }}</p>
                        </div>
                    @endforeach

                </div>
            </section>

            {{-- ============================================================
                 ADOPTION CTA
                 Invites other facilities/offices to request VTrack for
                 their own site.
            ============================================================= --}}
            <section class="adoption-cta">
                <p class="adoption-cta__text">
                    Interested in bringing VTrack to your facility? If you're interested,
                    submit a request <a href="{{ route('adoption-request.create') }}" class="adoption-cta__link">here</a>.
                </p>
            </section>

            @include('partials.site-footer')

        </div>

    </body>
</html>
