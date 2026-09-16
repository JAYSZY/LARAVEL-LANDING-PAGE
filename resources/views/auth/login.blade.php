@extends('layouts.site')

@section('title', 'Admin Login - ' . config('app.name', 'VTrack'))

@section('content')

        <section class="auth-page">
            <div class="auth-card">

                <div class="auth-card__heading">
                    <h1 class="auth-card__title">Admin Login</h1>
                    <p class="auth-card__desc">Sign in to review facility requests submitted through VTrack.</p>
                </div>

                <form class="auth-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="request-field">
                        <label class="request-label" for="email">Email Address</label>
                        <input class="request-input" type="email" id="email" name="email"
                               value="{{ old('email') }}" placeholder="you@bjmp.gov.ph" required autofocus>
                    </div>

                    <div class="request-field">
                        <label class="request-label" for="password">Password</label>
                        <input class="request-input" type="password" id="password" name="password"
                               placeholder="********" required>
                    </div>

                    <label class="auth-form__remember">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    <button type="submit" class="request-submit">Sign In</button>
                </form>

                <p class="auth-card__footer">
                    Don't have an account? <a href="{{ route('register') }}" class="cta-band__link">Register here</a>.
                </p>

            </div>
        </section>

@endsection
