<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Facility Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('status'))
                <div class="rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($facilityRequests->isEmpty())
                    <div class="p-6 text-sm text-gray-500">
                        No facility requests have been submitted yet.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr class="text-left text-gray-500">
                                    <th class="px-6 py-3 font-medium">Facility</th>
                                    <th class="px-6 py-3 font-medium">Region</th>
                                    <th class="px-6 py-3 font-medium">Contact</th>
                                    <th class="px-6 py-3 font-medium">Email</th>
                                    <th class="px-6 py-3 font-medium">Status</th>
                                    <th class="px-6 py-3 font-medium">Submitted</th>
                                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($facilityRequests as $req)
                                    <tr>
                                        <td class="px-6 py-4 text-gray-900 font-medium">{{ $req->facility_name }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $req->region }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $req->contact_name }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $req->email }}</td>
                                        <td class="px-6 py-4">
                                            <x-request-status-badge :status="$req->status" />
                                        </td>
                                        <td class="px-6 py-4 text-gray-500">{{ $req->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                            <a href="{{ route('facility-requests.edit', $req) }}" class="font-medium text-[#0b1530] hover:underline">
                                                Edit
                                            </a>
                                            <form action="{{ route('facility-requests.destroy', $req) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Delete this facility request? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $facilityRequests->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
