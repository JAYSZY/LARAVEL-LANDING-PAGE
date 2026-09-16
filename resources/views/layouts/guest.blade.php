<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VTrack') }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="page-body">
        <div class="auth-page">

            <a href="{{ url('/') }}" class="auth-page__brand">
                <img src="{{ asset('images/landing/bjmp-seal.png') }}" alt="BJMP Seal" class="auth-page__brand-logo">
                <span class="auth-page__brand-name">VTrack</span>
            </a>

            <div class="auth-card">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
