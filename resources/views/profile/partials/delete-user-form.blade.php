<section class="space-y-6">
    <div class="flex items-start gap-4">
        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-600">
            <x-heroicon-s-trash class="h-6 w-6 text-white" />
        </span>
        <header>
            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('Delete Account') }}
            </h2>
        </header>
    </div>

    <div class="flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3">
        <x-heroicon-s-exclamation-circle class="mt-0.5 h-5 w-5 shrink-0 text-red-500" />
        <div class="text-sm text-red-800">
            <p class="font-medium">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
            <p class="mt-1 text-red-700">{{ __('Before deleting your account, please download any data or information that you wish to retain.') }}</p>
        </div>
    </div>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 rounded-md bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-500"
    >
        <x-heroicon-s-trash class="h-4 w-4" />
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
