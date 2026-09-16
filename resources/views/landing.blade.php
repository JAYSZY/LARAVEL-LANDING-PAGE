@extends('layouts.site')

@section('title', config('app.name', 'VTrack') . ' - BJMP Virac Visitor Tracking System')
@section('description', 'VTrack is the secure, offline-ready visitor management system of the Bureau of Jail Management and Penology - Virac District Jail.')

@section('content')

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
                    VTrack is an offline-ready system for recording,
                    verifying, and monitoring every visitor who enters the facility.
                </p>

                <div class="hero__actions">
                    <a href="#features" class="btn-outline-lg">
                        See How It Works
                    </a>
                </div>
            </div>
        </section>

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
                            <x-dynamic-component :component="'heroicon-o-' . $badge['icon']" class="icon-amber" />
                        </div>
                        <h4 class="badge__title">{{ $badge['label'] }}</h4>
                        <p class="badge__desc">{{ $badge['desc'] }}</p>
                    </div>
                @endforeach

            </div>
        </section>

        {{-- ============================================================
             CLOSING CTA
             Text-link invitation for other BJMP facilities/regions to
             request VTrack for their own use.
        ============================================================= --}}
        <section class="cta-band">
            <div class="cta-band__inner">
                <div class="cta-band__icon-wrap">
                    <x-heroicon-o-paper-airplane class="cta-band__icon" />
                </div>
                <p class="cta-band__text">
                    Interested in bringing VTrack to your facility?
                    <a href="{{ route('request.create') }}" class="cta-band__link">Submit a request here</a>.
                </p>
            </div>
        </section>

@endsection
