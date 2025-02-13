<section class="bg-white shadow rounded-lg p-6">
    <header>
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Profile Information') }}</h2>
        <p class="mt-1 text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Layout foto profil dan form input -->
        <div class="flex flex-col md:flex-row items-center md:space-x-8 space-y-6 md:space-y-0">
            <!-- Foto Profil & Aksi -->
            <div class="relative">
                <div class="w-32 h-32 rounded-full overflow-hidden border border-gray-300">
                    <img id="profilePhotoPreview"
                         src="{{ $user->profile_photo_url ?? asset('images/profile-placeholder.png') }}"
                         alt="Profile Photo"
                         class="w-full h-full object-cover">
                </div>
                <!-- Tombol untuk memilih foto (ikon kamera) -->
                <button type="button"
                        onclick="document.getElementById('profile_photo').click()"
                        class="absolute bottom-0 right-0 bg-gray-800 text-white rounded-full p-2 hover:bg-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 5a2 2 0 012-2h4a2 2 0 012 2v1h3.5A1.5 1.5 0 0118 7.5v7A1.5 1.5 0 0116.5 16H3.5A1.5 1.5 0 012 14.5v-7A1.5 1.5 0 013.5 6H7V5z" />
                    </svg>
                </button>
                <!-- Tombol hapus foto -->
                @if($user->profile_photo_path)
                    <div class="mt-2 text-center">
                        <button type="button"
                                onclick="removeProfilePhoto()"
                                class="text-sm text-red-600 hover:underline focus:outline-none">
                            {{ __('Remove Photo') }}
                        </button>
                    </div>
                @endif
            </div>

            <!-- Form Input Data -->
            <div class="flex-1 grid grid-cols-1 gap-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">{{ __('Phone') }}</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">{{ __('Role') }}</label>
                    <select name="role" id="role" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="laboran" {{ old('role', $user->role) == 'laboran' ? 'selected' : '' }}>Laboran</option>
                        <option value="teknisi" {{ old('role', $user->role) == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="pengguna" {{ old('role', $user->role) == 'pengguna' ? 'selected' : '' }}>Pengguna</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div>
                    <label for="verification_code" class="block text-sm font-medium text-gray-700">{{ __('Verification Code') }}</label>
                    <input type="text" name="verification_code" id="verification_code"
                           placeholder="{{ __('Enter verification code if required') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-6 flex items-center">
            <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none">
                {{ __('Save Changes') }}
            </button>
            @if (session('status') === 'profile-updated')
                <span class="ml-4 text-sm text-green-600" 
                      x-data="{ show: true }" 
                      x-show="show" 
                      x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Saved.') }}
                </span>
            @endif
        </div>

        <!-- Input file tersembunyi -->
        <input type="file" name="image" id="profile_photo" accept="image/*" class="hidden">
    </form>
</section>

<!-- Script untuk preview foto dan penghapusan -->
<script>
    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePhotoPreview = document.getElementById('profilePhotoPreview');

    if (profilePhotoInput) {
        profilePhotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePhotoPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    function removeProfilePhoto() {
        profilePhotoPreview.src = "{{ asset('images/profile-placeholder.png') }}";
        let removeInput = document.getElementById('remove_image');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_image';
            removeInput.value = '1';
            removeInput.id = 'remove_image';
            profilePhotoInput.parentElement.appendChild(removeInput);
        }
    }
</script>
