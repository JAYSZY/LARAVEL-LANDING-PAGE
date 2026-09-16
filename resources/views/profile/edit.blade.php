<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl divide-y divide-gray-100 rounded-2xl bg-white shadow-sm">
                <div class="p-4 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="p-4 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="p-4 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
