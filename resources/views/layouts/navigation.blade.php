@php
    $navLinks = [
        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'home', 'active' => request()->routeIs('dashboard')],
        ['route' => 'facility-requests.index', 'label' => 'Facility Requests', 'icon' => 'clipboard-document-list', 'active' => request()->routeIs('facility-requests.*')],
    ];
@endphp

{{-- Desktop sidebar --}}
<aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-30 lg:flex lg:w-64 lg:flex-col lg:bg-[#0b1530]">
    <div class="flex items-center gap-3 px-4 py-4 border-b border-white/10">
        <img src="{{ asset('images/landing/bjmp-seal.png') }}" alt="BJMP Seal" class="h-9 w-9 shrink-0">
        <span class="leading-tight">
            <span class="block text-lg font-bold tracking-wide text-white">VTrack</span>
            <span class="block text-xs text-slate-300">BJMP Visitor Management</span>
        </span>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto p-4">
        @foreach ($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition {{ $link['active'] ? 'bg-white/10 text-amber-400' : 'text-slate-200 hover:bg-white/5 hover:text-amber-400' }}">
                <x-dynamic-component :component="'heroicon-o-' . $link['icon']" class="h-5 w-5 shrink-0" />
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="border-t border-white/10 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/5 hover:text-amber-400">
                <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5 shrink-0" />
                Log Out
            </button>
        </form>
    </div>
</aside>

{{-- Mobile drawer --}}
<div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-30 bg-black/50 lg:hidden" @click="sidebarOpen = false"></div>

<aside x-show="sidebarOpen" x-cloak
       class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col bg-[#0b1530] lg:hidden"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full">
    <div class="flex items-center justify-between gap-2 px-4 py-4 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/landing/bjmp-seal.png') }}" alt="BJMP Seal" class="h-9 w-9 shrink-0">
            <span class="leading-tight">
                <span class="block text-lg font-bold tracking-wide text-white">VTrack</span>
                <span class="block text-xs text-slate-300">BJMP Visitor Management</span>
            </span>
        </a>
        <button type="button" class="text-slate-300 hover:text-amber-400" @click="sidebarOpen = false" aria-label="Close sidebar">
            <x-heroicon-o-x-mark class="h-6 w-6" />
        </button>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto p-4">
        @foreach ($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition {{ $link['active'] ? 'bg-white/10 text-amber-400' : 'text-slate-200 hover:bg-white/5 hover:text-amber-400' }}">
                <x-dynamic-component :component="'heroicon-o-' . $link['icon']" class="h-5 w-5 shrink-0" />
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="border-t border-white/10 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-white/5 hover:text-amber-400">
                <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5 shrink-0" />
                Log Out
            </button>
        </form>
    </div>
</aside>
