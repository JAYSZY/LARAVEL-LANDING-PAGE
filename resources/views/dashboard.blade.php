<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm font-medium text-gray-500">Total Requests</p>
                    <p class="mt-2 text-3xl font-bold text-[#0b1530]">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm font-medium text-gray-500">Pending</p>
                    <p class="mt-2 text-3xl font-bold text-amber-500">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm font-medium text-gray-500">Contacted</p>
                    <p class="mt-2 text-3xl font-bold text-blue-500">{{ $stats['contacted'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm font-medium text-gray-500">Approved</p>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ $stats['approved'] }}</p>
                </div>
            </div>

            {{-- Recent requests --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Facility Requests</h3>
                        <a href="{{ route('facility-requests.index') }}" class="text-sm font-medium text-[#0b1530] hover:underline">
                            View all &rarr;
                        </a>
                    </div>

                    @if ($recentRequests->isEmpty())
                        <p class="text-sm text-gray-500">No facility requests have been submitted yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr class="text-left text-gray-500">
                                        <th class="py-2 pr-4 font-medium">Facility</th>
                                        <th class="py-2 pr-4 font-medium">Contact</th>
                                        <th class="py-2 pr-4 font-medium">Status</th>
                                        <th class="py-2 pr-4 font-medium">Submitted</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($recentRequests as $req)
                                        <tr>
                                            <td class="py-2 pr-4 text-gray-900">{{ $req->facility_name }}</td>
                                            <td class="py-2 pr-4 text-gray-700">{{ $req->contact_name }}</td>
                                            <td class="py-2 pr-4">
                                                <x-request-status-badge :status="$req->status" />
                                            </td>
                                            <td class="py-2 pr-4 text-gray-500">{{ $req->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
