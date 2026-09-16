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
    <body class="font-sans antialiased">
        <div class="flex min-h-screen bg-gray-100" x-data="{ sidebarOpen: false }">

            @include('layouts.navigation')

            <div class="flex min-w-0 flex-1 flex-col lg:pl-64">

                <header class="sticky top-0 z-20 flex items-center justify-between gap-4 border-b border-gray-200 bg-white px-4 py-3 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3 min-w-0">
                        <button type="button" class="text-gray-500 hover:text-gray-700 lg:hidden" @click="sidebarOpen = true" aria-label="Open sidebar">
                            <x-heroicon-o-bars-3 class="h-6 w-6" />
                        </button>

                        @isset($header)
                            <div class="min-w-0">{{ $header }}</div>
                        @endisset
                    </div>

                    <a href="{{ route('profile.edit') }}" class="flex shrink-0 items-center gap-2 text-sm font-medium text-gray-700 hover:text-[#0b1530]">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#0b1530] text-xs font-semibold text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                    </a>
                </header>

                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
