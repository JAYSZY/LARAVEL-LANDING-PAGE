<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Review Facility Request') }}
            </h2>
            <x-request-status-badge :status="$facilityRequest->status" />
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if ($errors->any())
                <div class="rounded-lg bg-red-50 border border-red-200 px-4 py-3">
                    <p class="text-sm font-semibold text-red-800">Please fix the following errors:</p>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Submitted information (read-only) --}}
            <div class="rounded-xl bg-white shadow-sm p-6">
                <h3 class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-4">Submitted Information</h3>

                <dl class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs text-gray-500">Facility Name</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $facilityRequest->facility_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">Region / Province</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $facilityRequest->region }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">Contact Person</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $facilityRequest->contact_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">Position / Rank</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $facilityRequest->position }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">Contact Number</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $facilityRequest->contact_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">Email Address</dt>
                        <dd class="text-sm font-medium text-gray-900 break-all">{{ $facilityRequest->email }}</dd>
                    </div>
                </dl>

                @if ($facilityRequest->message)
                    <div class="mt-6 border-t border-gray-100 pt-4">
                        <dt class="text-xs text-gray-500 mb-1.5">Message from Requester</dt>
                        <blockquote class="rounded-lg border-l-4 border-gray-200 bg-gray-50 px-4 py-3 text-sm italic text-gray-700">
                            &ldquo;{{ $facilityRequest->message }}&rdquo;
                        </blockquote>
                    </div>
                @endif

                <p class="mt-4 text-xs text-gray-400">Submitted {{ $facilityRequest->created_at->format('M d, Y \a\t g:i A') }}</p>
            </div>

            {{-- Decision --}}
            <div class="rounded-xl bg-white shadow-sm border-t-4 border-amber-400 p-6"
                 x-data="{ pendingStatus: null, pendingLabel: '' }">

                <h3 class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-4">Decision</h3>

                <form id="review-form" method="POST" action="{{ route('facility-requests.update', $facilityRequest) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" id="status-field" value="{{ $facilityRequest->status }}">

                    <div class="mb-5">
                        <x-input-label for="admin_notes" value="Admin Notes (internal only, not shared with requester)" />
                        <textarea id="admin_notes" name="admin_notes" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0b1530] focus:ring-[#0b1530]">{{ old('admin_notes', $facilityRequest->admin_notes) }}</textarea>
                        <x-input-error :messages="$errors->get('admin_notes')" class="mt-2" />
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        @if ($facilityRequest->status === 'pending')
                            <button type="submit"
                                    onclick="document.getElementById('status-field').value='reviewing'"
                                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                Start Reviewing
                            </button>
                        @endif

                        @if (in_array($facilityRequest->status, ['pending', 'reviewing']))
                            <button type="button"
                                    @click="pendingStatus = 'approved'; pendingLabel = 'Approve'; $dispatch('open-modal', 'confirm-decision')"
                                    class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">
                                Approve
                            </button>
                            <button type="button"
                                    @click="pendingStatus = 'denied'; pendingLabel = 'Deny'; $dispatch('open-modal', 'confirm-decision')"
                                    class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                                Deny
                            </button>
                        @endif

                        @if (in_array($facilityRequest->status, ['approved', 'denied']))
                            <p class="text-sm text-gray-600">
                                This request has been <span class="font-semibold">{{ $facilityRequest->status }}</span>.
                            </p>
                            <button type="submit"
                                    onclick="document.getElementById('status-field').value='reviewing'"
                                    class="text-sm font-medium text-gray-500 underline hover:text-gray-700">
                                Reopen for review
                            </button>
                        @endif

                        <button type="submit" class="ms-auto text-sm font-medium text-gray-500 hover:text-gray-700">
                            Save Notes Only
                        </button>
                    </div>
                </form>

                <x-modal name="confirm-decision" focusable>
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900" x-text="pendingLabel + ' this request?'"></h2>
                        <p class="mt-2 text-sm text-gray-600">
                            This will mark <span class="font-semibold text-gray-900">{{ $facilityRequest->facility_name }}</span>'s
                            request as <span x-text="pendingStatus" class="font-semibold"></span>.
                            You can reopen it for review later if needed.
                        </p>
                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" @click="$dispatch('close-modal', 'confirm-decision')"
                                    class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="button"
                                    @click="document.getElementById('status-field').value = pendingStatus; document.getElementById('review-form').submit()"
                                    :class="pendingStatus === 'approved' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
                                    class="rounded-md px-4 py-2 text-sm font-medium text-white">
                                <span x-text="'Confirm ' + pendingLabel"></span>
                            </button>
                        </div>
                    </div>
                </x-modal>
            </div>

            <a href="{{ route('facility-requests.index') }}" class="inline-block text-sm font-medium text-gray-600 hover:underline">
                &larr; Back to Facility Requests
            </a>

        </div>
    </div>
</x-app-layout>
