<section class="bg-white shadow rounded-lg p-6">
    <header>
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Delete Account') }}</h2>
        <p class="mt-1 text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="mt-4 px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-semibold text-gray-800">{{ __('Are you sure you want to delete your account?') }}</h2>
            <p class="mt-1 text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                       class="mt-1 block w-3/4 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" x-on:click="$dispatch('close')"
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">
                    {{ __('Cancel') }}
                </button>
                <button type="submit"
                        class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
