<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-form.input-label for="name" :value="__('Name')" />
            <x-form.input.text-input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-form.input-label for="email" :value="__('Email')" />
            <x-form.input.text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-form.input-label for="password" :value="__('Password')" />

            <x-form.input.text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-form.input.text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-form.input-label for="role" :value="__('role')" />
            <x-form.input.select-input id="role" class="block mt-1 w-full" name=role>
                <option value="" disabled selected>Pilih Role</option>
                <option value="nasabah" {{ old('role') == 'nasabah' ? 'selected' : '' }}>Nasabah</option>
                <option value="pialang" {{ old('role') == 'pialang' ? 'selected' : '' }}>Pialang</option>
                <option value="bursa" {{ old('role') == 'bursa' ? 'selected' : '' }}>Bursa</option>
                <option value="bappebti" {{ old('role') == 'bappebti' ? 'selected' : '' }}>Bappebti</option>
            </x-form.input.select-input>
            <x-form.input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
