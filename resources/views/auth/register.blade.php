@extends('layouts.site')

@section('title', 'Admin Registration - ' . config('app.name', 'VTrack'))

@section('content')

        <section class="auth-page">
            <div class="auth-card">

                <div class="auth-card__heading">
                    <h1 class="auth-card__title">Create an Admin Account</h1>
                    <p class="auth-card__desc">Sign up to manage facility requests submitted through VTrack.</p>
                </div>

                <form class="auth-form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="request-field">
                        <label class="request-label" for="name">Full Name</label>
                        <input class="request-input" type="text" id="name" name="name"
                               value="{{ old('name') }}" placeholder="Juan Dela Cruz" required autofocus>
                    </div>

                    <div class="request-field">
                        <label class="request-label" for="email">Email Address</label>
                        <input class="request-input" type="email" id="email" name="email"
                               value="{{ old('email') }}" placeholder="you@bjmp.gov.ph" required>
                    </div>

                    <div class="request-field">
                        <label class="request-label" for="password">Password</label>
                        <input class="request-input" type="password" id="password" name="password"
                               placeholder="At least 8 characters" required>
                    </div>

                    <div class="request-field">
                        <label class="request-label" for="password_confirmation">Confirm Password</label>
                        <input class="request-input" type="password" id="password_confirmation"
                               name="password_confirmation" placeholder="Re-enter password" required>
                    </div>

                    <button type="submit" class="request-submit">Create Account</button>
                </form>

                <p class="auth-card__footer">
                    Already have an account? <a href="{{ route('login') }}" class="cta-band__link">Sign in</a>.
                </p>

            </div>
        </section>

@endsection
