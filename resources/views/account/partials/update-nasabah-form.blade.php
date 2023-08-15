<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Nasabah Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your Nasabah informations.') }}
        </p>
    </header>

    <form method="post" action="{{ route('nasabah.update') }}" class="mt-6 space-y-6 w-full">
        @csrf
        @method('patch')
        <div class="flex justify-between gap-x-8 w-full">
            <div class="w-1/2">
                <x-form.input-label for="pekerjaan" :value="__('Pekerjaan')" />
                <x-form.input.text-input id="pekerjaan" name="pekerjaan" type="text" class="mt-1 block w-full"
                    :value="old('pekerjaan', $user->nasabah->pekerjaan)" required autofocus />
                <x-form.input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
            </div>

            <div class="w-1/2">
                <x-form.input-label for="jabatan" :value="__('Jabatan')" />
                <x-form.input.text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full"
                    :value="old('jabatan', $user->nasabah->jabatan)" required autofocus />
                <x-form.input-error class="mt-2" :messages="$errors->get('jabatan')" />
            </div>
        </div>
        <div>
            <x-form.input-label for="alamat" :value="__('Alamat')" />
            <x-form.input.text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full"
                :value="old('alamat', $user->nasabah->alamat)" required autofocus />
            <x-form.input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div class="flex justify-between gap-x-8 w-full">
            <div class="w-1/2">
                <x-form.input-label for="provinsi" :value="__('Provinsi')" />
                <x-form.input.text-input id="provinsi" name="provinsi" type="text" class="mt-1 block w-full"
                    :value="old('provinsi', $user->nasabah->provinsi)" required autofocus />
                <x-form.input-error class="mt-2" :messages="$errors->get('provinsi')" />
            </div>

            <div class="w-1/2">
                <x-form.input-label for="kota_kabupaten" :value="__('Kota/Kabupaten')" />
                <x-form.input.text-input id="kota_kabupaten" name="kota_kabupaten" type="text"
                    class="mt-1 block w-full" :value="old('kota_kabupaten', $user->nasabah->kota_kabupaten)" required autofocus />
                <x-form.input-error class="mt-2" :messages="$errors->get('kota_kabupaten')" />
            </div>
        </div>
        <div class="flex justify-between gap-x-8 w-full">
            <div class="w-1/2">
                <x-form.input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                <x-form.input.text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full"
                    :value="old('tempat_lahir', $user->nasabah->tempat_lahir)" required autofocus />
                <x-form.input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
            </div>

            <div class="w-1/2">
                <x-form.input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                <x-form.input.text-input id="tanggal_lahir" name="tanggal_lahir" type="date"
                    class="mt-1 block w-full" :value="old('tanggal_lahir', $user->nasabah->tanggal_lahir)" required autofocus />
                <x-form.input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
            </div>
        </div>


        <div class="flex justify-between gap-x-8 w-full">
            <div class="w-1/2">
                <x-form.input-label for="identitas" :value="__('Identitas')" />
                <select id="identitas" name="identitas"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option value="" disabled selected>Not Selected</option>
                    <option value="PASPORT"
                        {{ old('identitas', $user->nasabah->identitas) == 'PASSPORT' ? 'selected' : '' }}>
                        PASSPORT</option>
                    <option value="KTP" {{ old('identitas', $user->nasabah->identitas) == 'KTP' ? 'selected' : '' }}>
                        KTP
                    </option>
                </select>
                <x-form.input-error class="mt-2" :messages="$errors->get('identitas')" />
            </div>

            <div class="w-1/2">
                <x-form.input-label for="nomor_identitas" :value="__('Nomor Identitas')" />
                <x-form.input.text-input id="nomor_identitas" name="nomor_identitas" type="text"
                    class="mt-1 block w-full" :value="old('nomor_identitas', $user->nasabah->nomor_identitas)" required autofocus />
                <x-form.input-error class="mt-2" :messages="$errors->get('nomor_identitas')" />
            </div>
        </div>

        <div class="">
            <x-form.input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                <option value="" disabled selected>Not Selected</option>
                <option value="Laki-Laki" {{ old('gender', $user->nasabah->gender) == 'Laki-Laki' ? 'selected' : '' }}>
                    Laki-Laki</option>
                <option value="Perempuan" {{ old('gender', $user->nasabah->gender) == 'Perempuan' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>
            <x-form.input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>
        <div>
            <x-form.input-label for="nomor_hp" :value="__('Nomor HP')" />
            <x-form.input.text-input id="nomor_hp" name="nomor_hp" type="text" class="mt-1 block w-full"
                :value="old('nomor_hp', $user->nasabah->nomor_hp)" required autofocus />
            <x-form.input-error class="mt-2" :messages="$errors->get('nomor_hp')" />
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
