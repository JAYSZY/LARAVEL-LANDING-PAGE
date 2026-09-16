<section>
    <div class="flex items-start gap-4">
        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#0b1530]">
            <x-heroicon-s-lock-closed class="h-6 w-6 text-white" />
        </span>
        <header>
            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('Update Password') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div x-data="{ show: false }">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative mt-1.5">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-lock-closed class="h-5 w-5 text-gray-400" />
                </span>
                <input :type="show ? 'text' : 'password'" id="update_password_current_password" name="current_password"
                       class="block w-full rounded-md border-gray-300 pl-10 pr-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       autocomplete="current-password" placeholder="{{ __('Enter current password') }}">
                <button type="button" @click="show = ! show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600" aria-label="{{ __('Toggle password visibility') }}">
                    <x-heroicon-o-eye class="h-5 w-5" x-show="! show" />
                    <x-heroicon-o-eye-slash class="h-5 w-5" x-show="show" x-cloak />
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative mt-1.5">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-lock-closed class="h-5 w-5 text-gray-400" />
                </span>
                <input :type="show ? 'text' : 'password'" id="update_password_password" name="password"
                       class="block w-full rounded-md border-gray-300 pl-10 pr-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       autocomplete="new-password" placeholder="{{ __('Enter new password') }}">
                <button type="button" @click="show = ! show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600" aria-label="{{ __('Toggle password visibility') }}">
                    <x-heroicon-o-eye class="h-5 w-5" x-show="! show" />
                    <x-heroicon-o-eye-slash class="h-5 w-5" x-show="show" x-cloak />
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative mt-1.5">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-lock-closed class="h-5 w-5 text-gray-400" />
                </span>
                <input :type="show ? 'text' : 'password'" id="update_password_password_confirmation" name="password_confirmation"
                       class="block w-full rounded-md border-gray-300 pl-10 pr-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       autocomplete="new-password" placeholder="{{ __('Confirm new password') }}">
                <button type="button" @click="show = ! show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600" aria-label="{{ __('Toggle password visibility') }}">
                    <x-heroicon-o-eye class="h-5 w-5" x-show="! show" />
                    <x-heroicon-o-eye-slash class="h-5 w-5" x-show="show" x-cloak />
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end gap-4">
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif

            <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-[#0b1530] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#0b1530]/90">
                <x-heroicon-s-lock-closed class="h-4 w-4" />
                {{ __('Update Password') }}
            </button>
        </div>
    </form>
</section>
