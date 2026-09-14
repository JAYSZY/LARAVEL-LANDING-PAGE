<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Facility Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-50 border border-red-200 px-4 py-3">
                        <p class="text-sm font-semibold text-red-800">Please fix the following errors:</p>
                        <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('facility-requests.update', $facilityRequest) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <x-input-label for="facility_name" value="Facility Name" />
                            <x-text-input id="facility_name" name="facility_name" type="text" class="mt-1 block w-full"
                                          :value="old('facility_name', $facilityRequest->facility_name)" required />
                            <x-input-error :messages="$errors->get('facility_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="region" value="Region / Province" />
                            <x-text-input id="region" name="region" type="text" class="mt-1 block w-full"
                                          :value="old('region', $facilityRequest->region)" required />
                            <x-input-error :messages="$errors->get('region')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="contact_name" value="Contact Person" />
                            <x-text-input id="contact_name" name="contact_name" type="text" class="mt-1 block w-full"
                                          :value="old('contact_name', $facilityRequest->contact_name)" required />
                            <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="position" value="Position / Rank" />
                            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full"
                                          :value="old('position', $facilityRequest->position)" required />
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="contact_number" value="Contact Number" />
                            <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full"
                                          :value="old('contact_number', $facilityRequest->contact_number)" required />
                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email Address" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                          :value="old('email', $facilityRequest->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0b1530] focus:ring-[#0b1530]">
                                @foreach (['pending', 'contacted', 'approved', 'declined'] as $status)
                                    <option value="{{ $status }}" @selected(old('status', $facilityRequest->status) === $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="message" value="Additional Details (from requester)" />
                        <textarea id="message" name="message" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0b1530] focus:ring-[#0b1530]">{{ old('message', $facilityRequest->message) }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="admin_notes" value="Admin Notes (internal)" />
                        <textarea id="admin_notes" name="admin_notes" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0b1530] focus:ring-[#0b1530]">{{ old('admin_notes', $facilityRequest->admin_notes) }}</textarea>
                        <x-input-error :messages="$errors->get('admin_notes')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="btn-primary">Save Changes</button>
                        <a href="{{ route('facility-requests.index') }}" class="text-sm font-medium text-gray-600 hover:underline">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
