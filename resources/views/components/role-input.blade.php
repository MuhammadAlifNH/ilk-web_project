@props(['user', 'roles' => ['admin', 'laboran', 'teknisi', 'pengguna']])

<div>
    <x-input-label for="role" :value="__('Role')" />
    <select id="role" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        @foreach($roles as $role)
            <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                {{ ucfirst($role) }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('role')" />
</div>

<div id="verification-code-section" class="hidden">
    <x-input-label for="verification_code" :value="__('Verification Code')" />
    <x-text-input id="verification_code" name="verification_code" type="password" class="mt-1 block w-full" autocomplete="off" />
    <x-input-error class="mt-2" :messages="$errors->get('verification_code')" />
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let roleInput = document.getElementById('role');
        let verificationCodeSection = document.getElementById('verification-code-section');

        function checkRole() {
            if (roleInput.value.toLowerCase() !== 'pengguna') {
                verificationCodeSection.classList.remove('hidden');
            } else {
                verificationCodeSection.classList.add('hidden');
            }
        }

        roleInput.addEventListener('change', checkRole);
        checkRole();
    });
</script>

