<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="w-full space-y-6">

            @if (session('status'))
                <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Page banner --}}
            <div class="flex items-center gap-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 p-5 sm:p-6">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-white shadow-sm sm:h-16 sm:w-16">
                    <x-heroicon-o-squares-2x2 class="h-7 w-7 text-[#0b1530] sm:h-8 sm:w-8" />
                </span>
                <div class="flex h-10 w-1 shrink-0 flex-col overflow-hidden rounded-full">
                    <span class="flex-1 bg-amber-400"></span>
                    <span class="flex-1 bg-blue-600"></span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Admin Dashboard</p>
                    <h1 class="text-2xl font-bold text-[#0b1530] sm:text-3xl">Dashboard</h1>
                    <p class="mt-1 text-sm text-slate-600">Monitor facility requests and track system activity at a glance.</p>
                </div>
            </div>

            {{-- Stat cards --}}
            @php
                $statCards = [
                    ['label' => 'Total Requests', 'value' => $stats['total'], 'icon' => 's-document-text', 'border' => 'border-blue-100', 'bg' => 'bg-blue-50', 'iconBg' => 'bg-blue-100', 'iconColor' => 'text-blue-600', 'accent' => 'bg-blue-500'],
                    ['label' => 'Pending', 'value' => $stats['pending'], 'icon' => 's-clock', 'border' => 'border-amber-100', 'bg' => 'bg-amber-50', 'iconBg' => 'bg-amber-100', 'iconColor' => 'text-amber-600', 'accent' => 'bg-amber-500'],
                    ['label' => 'Reviewing', 'value' => $stats['reviewing'], 'icon' => 's-arrow-path', 'border' => 'border-blue-100', 'bg' => 'bg-blue-50', 'iconBg' => 'bg-blue-100', 'iconColor' => 'text-blue-600', 'accent' => 'bg-blue-500'],
                    ['label' => 'Approved', 'value' => $stats['approved'], 'icon' => 's-check-circle', 'border' => 'border-green-100', 'bg' => 'bg-green-50', 'iconBg' => 'bg-green-100', 'iconColor' => 'text-green-600', 'accent' => 'bg-green-500'],
                    ['label' => 'Denied', 'value' => $stats['denied'], 'icon' => 's-x-circle', 'border' => 'border-red-100', 'bg' => 'bg-red-50', 'iconBg' => 'bg-red-100', 'iconColor' => 'text-red-600', 'accent' => 'bg-red-500'],
                ];
            @endphp
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 lg:grid-cols-5">
                @foreach ($statCards as $card)
                    <div class="rounded-2xl border {{ $card['border'] }} {{ $card['bg'] }} p-4 sm:p-5">
                        <div class="flex items-center gap-3">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full {{ $card['iconBg'] }} sm:h-12 sm:w-12">
                                <x-dynamic-component :component="'heroicon-' . $card['icon']" class="h-5 w-5 {{ $card['iconColor'] }} sm:h-6 sm:w-6" />
                            </span>
                            <div class="min-w-0">
                                <p class="truncate text-xs font-medium text-gray-600 sm:text-sm">{{ $card['label'] }}</p>
                                <p class="text-xl font-bold text-[#0b1530] sm:text-2xl">{{ $card['value'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4 h-1 w-10 rounded-full {{ $card['accent'] }}"></div>
                    </div>
                @endforeach
            </div>

            {{-- Recent requests --}}
            <div class="rounded-2xl bg-white shadow-sm overflow-hidden">
                <div class="flex flex-col gap-4 border-b border-gray-100 p-4 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-building-office-2 class="mt-0.5 h-6 w-6 shrink-0 text-[#0b1530]" />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Facility Requests</h3>
                            <p class="mt-0.5 text-sm text-gray-500">Latest facility adoption requests from other BJMP offices and facilities.</p>
                        </div>
                    </div>
                    <a href="{{ route('facility-requests.index') }}"
                       class="inline-flex shrink-0 items-center gap-1.5 self-start rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 sm:self-auto">
                        View All
                        <x-heroicon-o-arrow-right class="h-4 w-4" />
                    </a>
                </div>

                @if ($recentRequests->isEmpty())
                    <p class="p-4 text-sm text-gray-500 sm:p-6">No facility requests have been submitted yet.</p>
                @else
                    {{-- Mobile: stacked cards --}}
                    <div class="divide-y divide-gray-100 sm:hidden">
                        @foreach ($recentRequests as $req)
                            <div class="p-4">
                                <div class="flex items-start gap-3">
                                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sky-50">
                                        <x-heroicon-o-building-office-2 class="h-5 w-5 text-sky-600" />
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <p class="truncate font-medium text-gray-900">{{ $req->facility_name }}</p>
                                            <x-request-status-badge :status="$req->status" />
                                        </div>
                                        <p class="mt-0.5 flex items-center gap-1.5 text-sm text-gray-600">
                                            <x-heroicon-o-user class="h-4 w-4 shrink-0 text-slate-400" />
                                            {{ $req->contact_name }}
                                        </p>
                                        <p class="mt-1 flex items-center gap-1.5 text-xs text-gray-400">
                                            <x-heroicon-o-calendar class="h-3.5 w-3.5 shrink-0" />
                                            {{ $req->created_at->diffForHumans() }}
                                        </p>

                                        <div class="mt-3">
                                            <a href="{{ route('facility-requests.edit', $req) }}"
                                               class="inline-flex items-center gap-1.5 rounded-md border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                                <x-heroicon-o-eye class="h-4 w-4" />
                                                Review
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Desktop: table --}}
                    <div class="hidden overflow-x-auto sm:block">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-slate-50">
                                <tr class="text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    <th class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-heroicon-o-building-office class="h-4 w-4 text-slate-400" />
                                            Facility
                                        </span>
                                    </th>
                                    <th class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-heroicon-o-map-pin class="h-4 w-4 text-slate-400" />
                                            Region
                                        </span>
                                    </th>
                                    <th class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-heroicon-o-user class="h-4 w-4 text-slate-400" />
                                            Contact
                                        </span>
                                    </th>
                                    <th class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-heroicon-o-envelope class="h-4 w-4 text-slate-400" />
                                            Email
                                        </span>
                                    </th>
                                    <th class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-heroicon-o-clock class="h-4 w-4 text-slate-400" />
                                            Status
                                        </span>
                                    </th>
                                    <th class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-heroicon-o-calendar class="h-4 w-4 text-slate-400" />
                                            Submitted
                                        </span>
                                    </th>
                                    <th class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-heroicon-o-ellipsis-horizontal class="h-4 w-4 text-slate-400" />
                                            Actions
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($recentRequests as $req)
                                    <tr class="hover:bg-slate-50/60">
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-3">
                                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sky-50">
                                                    <x-heroicon-o-building-office-2 class="h-5 w-5 text-sky-600" />
                                                </span>
                                                <div class="min-w-0">
                                                    <p class="truncate font-medium text-gray-900">{{ $req->facility_name }}</p>
                                                    <p class="truncate text-xs text-gray-500">{{ $req->region }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-gray-700">
                                            <span class="inline-flex items-center gap-1.5">
                                                <x-heroicon-o-map-pin class="h-4 w-4 shrink-0 text-slate-400" />
                                                {{ $req->region }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-gray-700">
                                            <span class="inline-flex items-center gap-1.5">
                                                <x-heroicon-o-user class="h-4 w-4 shrink-0 text-slate-400" />
                                                {{ $req->contact_name }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-gray-700">
                                            <span class="inline-flex items-center gap-1.5">
                                                <x-heroicon-o-envelope class="h-4 w-4 shrink-0 text-slate-400" />
                                                {{ $req->email }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <x-request-status-badge :status="$req->status" />
                                        </td>
                                        <td class="px-4 py-4 text-gray-500">
                                            <span class="inline-flex items-center gap-1.5">
                                                <x-heroicon-o-calendar class="h-4 w-4 shrink-0 text-slate-400" />
                                                {{ $req->created_at->format('M d, Y') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="{{ route('facility-requests.edit', $req) }}"
                                                   class="inline-flex items-center gap-1.5 rounded-md border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                                    <x-heroicon-o-eye class="h-4 w-4" />
                                                    Review
                                                </a>
                                                <button type="button" class="rounded-md p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600" aria-label="More actions">
                                                    <x-heroicon-o-ellipsis-vertical class="h-4 w-4" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
