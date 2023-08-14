<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Nasabah Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your Nasabah informations.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 w-full">
        @csrf
        @method('patch')
        <div>
            <x-form.input-label for="alamat" :value="__('alamat')" />
            <x-form.input.text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full"
                :value="old('alamat', $user->nasabah->alamat)" required autofocus />
        </div>

        <div>
            <x-form.input-label for="provinsi" :value="__('provinsi')" />
            <x-form.input.text-input id="provinsi" name="provinsi" type="text" class="mt-1 block w-full"
                :value="old('provinsi', $user->nasabah->provinsi)" required autofocus />
        </div>

        <div>
            <x-form.input-label for="kota_kabupaten" :value="__('kota_kabupaten')" />
            <x-form.input.text-input id="kota_kabupaten" name="kota_kabupaten" type="text"
                class="mt-1 block w-full" :value="old('kota_kabupaten', $user->nasabah->kota_kabupaten)" required autofocus />
        </div>
        <div class="flex justify-between gap-x-8 w-full">
            <div class="w-1/2">
                <x-form.input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                <x-form.input.text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full"
                    :value="old('tempat_lahir', $user->nasabah->tempat_lahir)" required autofocus />
            </div>

            <div class="w-1/2">
                <x-form.input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                <x-form.input.text-input id="tanggal_lahir" name="tanggal_lahir" type="date"
                    class="mt-1 block w-full" :value="old('tanggal_lahir', $user->nasabah->tanggal_lahir)" required autofocus />
            </div>
        </div>


        <div class="flex justify-between gap-x-8 w-full">
            <div class="w-1/2">
                <x-form.input-label for="identitas" :value="__('Identitas')" />
                <select id="identitas" name="identitas"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option value="" disabled>Not Selected</option>
                    <option value="PASPORT"
                        {{ old('identitas', $user->nasabah->identitas) == 'PASSPORT' ? 'selected' : '' }}>
                        PASSPORT</option>
                    <option value="KTP" {{ old('identitas', $user->nasabah->identitas) == 'KTP' ? 'selected' : '' }}>
                        KTP
                    </option>
                </select>
            </div>

            <div class="w-1/2">
                <x-form.input-label for="nomor_identitas" :value="__('Nomor Identitas')" />
                <x-form.input.text-input id="nomor_identitas" name="nomor_identitas" type="text"
                    class="mt-1 block w-full" :value="old('nomor_identitas', $user->nasabah->nomor_identitas)" required autofocus />
            </div>
        </div>

        <div class="">
            <x-form.input-label for="gender" :value="__('gender')" />
            <select id="gender" name="gender"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                <option value="" disabled>Not Selected</option>
                <option value="PASPORT" {{ old('gender', $user->nasabah->gender) == 'Laki-Laki' ? 'selected' : '' }}>
                    Laki-Laki</option>
                <option value="KTP" {{ old('gender', $user->nasabah->gender) == 'Perempuan' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>
        </div>
        <div>
            <x-form.input-label for="nomor_hp" :value="__('nomor_hp')" />
            <x-form.input.text-input id="nomor_hp" name="nomor_hp" type="text" class="mt-1 block w-full"
                :value="old('nomor_hp', $user->nasabah->nomor_hp)" required autofocus />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
