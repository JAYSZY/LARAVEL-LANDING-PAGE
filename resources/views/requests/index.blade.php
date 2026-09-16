<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8" x-data="{ confirmingId: null, confirmingName: '' }">
        <div class="w-full space-y-4">

            @if (session('status'))
                <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Page banner --}}
            <div class="flex items-center gap-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 p-5 sm:p-6">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-white shadow-sm sm:h-16 sm:w-16">
                    <x-heroicon-o-building-office-2 class="h-7 w-7 text-[#0b1530] sm:h-8 sm:w-8" />
                </span>
                <div class="flex h-10 w-1 shrink-0 flex-col overflow-hidden rounded-full">
                    <span class="flex-1 bg-amber-400"></span>
                    <span class="flex-1 bg-blue-600"></span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Facility Management</p>
                    <h1 class="text-2xl font-bold text-[#0b1530] sm:text-3xl">Facility Requests</h1>
                    <p class="mt-1 text-sm text-slate-600">View and manage facility adoption requests from other BJMP offices and facilities.</p>
                </div>
            </div>

            {{-- Search & filters --}}
            <div class="rounded-2xl bg-white p-4 shadow-sm sm:p-5">
                <form method="GET" action="{{ route('facility-requests.index') }}" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative flex-1">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <x-heroicon-o-magnifying-glass class="h-5 w-5 text-gray-400" />
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search facility, region, or contact..."
                               class="block w-full rounded-md border-gray-300 pl-10 text-sm shadow-sm focus:border-[#0b1530] focus:ring-[#0b1530]">
                    </div>

                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <x-heroicon-o-map-pin class="h-5 w-5 text-gray-400" />
                        </span>
                        <select name="region" onchange="this.form.submit()"
                                class="block w-full rounded-md border-gray-300 py-2.5 pl-10 pr-8 text-sm shadow-sm focus:border-[#0b1530] focus:ring-[#0b1530] sm:w-52">
                            <option value="">All Regions</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region }}" @selected(request('region') === $region)>{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <x-heroicon-o-adjustments-horizontal class="h-5 w-5 text-gray-400" />
                        </span>
                        <select name="status" onchange="this.form.submit()"
                                class="block w-full rounded-md border-gray-300 py-2.5 pl-10 pr-8 text-sm shadow-sm focus:border-[#0b1530] focus:ring-[#0b1530] sm:w-44">
                            <option value="">All Statuses</option>
                            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                            <option value="reviewing" @selected(request('status') === 'reviewing')>Reviewing</option>
                            <option value="approved" @selected(request('status') === 'approved')>Approved</option>
                            <option value="denied" @selected(request('status') === 'denied')>Denied</option>
                        </select>
                    </div>

                    <button type="submit" class="inline-flex items-center justify-center gap-1.5 rounded-md bg-[#0b1530] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#0b1530]/90">
                        <x-heroicon-o-magnifying-glass class="h-4 w-4" />
                        Search
                    </button>

                    @if (request('search') || request('region') || request('status'))
                        <a href="{{ route('facility-requests.index') }}"
                           class="inline-flex items-center justify-center gap-1.5 rounded-md border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            <x-heroicon-o-x-mark class="h-4 w-4" />
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="rounded-xl bg-white shadow-sm overflow-hidden">
                @if ($facilityRequests->isEmpty())
                    <div class="p-6 text-sm text-gray-500">
                        @if (request('search') || request('region') || request('status'))
                            No facility requests match your search or filters.
                        @else
                            No facility requests have been submitted yet.
                        @endif
                    </div>
                @else
                    {{-- Mobile: stacked cards --}}
                    <div class="divide-y divide-gray-100 sm:hidden">
                        @foreach ($facilityRequests as $req)
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
                                            <x-heroicon-o-map-pin class="h-4 w-4 shrink-0 text-slate-400" />
                                            {{ $req->region }}
                                        </p>
                                        <p class="mt-2 flex items-center gap-1.5 text-sm text-gray-700">
                                            <x-heroicon-o-user class="h-4 w-4 shrink-0 text-slate-400" />
                                            {{ $req->contact_name }}
                                        </p>
                                        <p class="mt-1 flex items-center gap-1.5 text-sm text-gray-500">
                                            <x-heroicon-o-envelope class="h-4 w-4 shrink-0 text-slate-400" />
                                            <span class="break-all">{{ $req->email }}</span>
                                        </p>
                                        <p class="mt-1 flex items-center gap-1.5 text-xs text-gray-400">
                                            <x-heroicon-o-calendar class="h-3.5 w-3.5 shrink-0" />
                                            Submitted {{ $req->created_at->format('M d, Y') }}
                                        </p>

                                        <div class="mt-3 flex items-center gap-2">
                                            <a href="{{ route('facility-requests.edit', $req) }}"
                                               class="inline-flex items-center gap-1.5 rounded-md border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                                <x-heroicon-o-eye class="h-4 w-4" />
                                                Review
                                            </a>
                                            <button type="button"
                                                    @click="confirmingId = {{ $req->id }}; confirmingName = @js($req->facility_name); $dispatch('open-modal', 'confirm-delete')"
                                                    class="inline-flex items-center gap-1.5 rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                                <x-heroicon-o-trash class="h-4 w-4" />
                                                Delete
                                            </button>
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
                                @foreach ($facilityRequests as $req)
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
                                                <button type="button"
                                                        @click="confirmingId = {{ $req->id }}; confirmingName = @js($req->facility_name); $dispatch('open-modal', 'confirm-delete')"
                                                        class="inline-flex items-center gap-1.5 rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                                    <x-heroicon-o-trash class="h-4 w-4" />
                                                    Delete
                                                </button>
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

                    <div class="flex flex-col gap-3 border-t border-gray-100 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                        <p class="text-sm text-gray-500">
                            Showing {{ $facilityRequests->firstItem() }}&ndash;{{ $facilityRequests->lastItem() }} of {{ $facilityRequests->total() }} requests
                        </p>
                        {{ $facilityRequests->links() }}
                    </div>
                @endif
            </div>

        </div>

        <x-modal name="confirm-delete" focusable>
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">Delete facility request?</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Are you sure you want to delete <span x-text="confirmingName" class="font-semibold text-gray-900"></span>?
                    This action cannot be undone.
                </p>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="$dispatch('close-modal', 'confirm-delete')"
                            class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <form method="POST" :action="'{{ url('facility-requests') }}/' + confirmingId">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </x-modal>
    </div>
</x-app-layout>
