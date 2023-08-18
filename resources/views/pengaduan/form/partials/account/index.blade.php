<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-6xl">
        <section>
            <header>
                <h2 class="text-xl font-medium text-gray-900">
                    {{ __('Data Nasabah') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Pastikan data sudah benar. Bila belum,') }}
                    <x-nav-link class="underline text-blue-700 font-bold" :href="route('account.edit')">
                        {{ __('ubah di sini') }}
                    </x-nav-link>
                </p>
            </header>
            <div class="grid md:grid-cols-2 gap-x-10 mt-4">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.user.name" :value="__('Nama Nasabah')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.user.name" name="nasabah.user.name" type="text"
                                    class="mt-1 block w-full" value="{{ $user->name }}" required autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.user.email" :value="__('Email Nasabah')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.user.email" name="nasabah.user.email"
                                    type="text" class="mt-1 block w-full" value="{{ $user->email }}" required
                                    autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.pekerjaan" :value="__('Pekerjaan')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.pekerjaan" name="nasabah.pekerjaan"
                                    type="text" class="mt-1 block w-full" value="{{ $user->nasabah->pekerjaan }}"
                                    required autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.jabatan" :value="__('Jabatan')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.jabatan" name="nasabah.jabatan" type="text"
                                    class="mt-1 block w-full" value="{{ $user->nasabah->pekerjaan }}" required
                                    autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.tempat_lahir" :value="__('Tempat, Tanggal Lahir')" />
                            </td>
                            <td>
                                <div class="grid grid-cols-2 gap-x-4">
                                    <x-form.input.input-disabled id="nasabah.tempat_lahir" name="nasabah.tempat_lahir"
                                        type="text" class="mt-1 block w-full"
                                        value="{{ $user->nasabah->tempat_lahir }}" required autofocus />
                                    <x-form.input.input-disabled id="nasabah.tanggal_lahir" name="nasabah.tanggal_lahir"
                                        type="text" class="mt-1 block w-full"
                                        value="{{ $user->nasabah->tanggal_lahir }}" required autofocus />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table>
                    <tbody>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.gender" :value="__('Gender')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.gender" name="nasabah.gender" type="text"
                                    class="mt-1 block w-full" value="{{ $user->nasabah->gender }}" required autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.alamat" :value="__('Alamat')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.alamat" name="nasabah.alamat" type="text"
                                    class="mt-1 block w-full" value="{{ $user->nasabah->alamat }}" required
                                    autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.provinsi" :value="__('Provinsi')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.provinsi" name="nasabah.provinsi"
                                    type="text" class="mt-1 block w-full" value="{{ $user->nasabah->provinsi }}"
                                    required autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.kota_kabupaten" :value="__('Kota Kabupaten')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.kota_kabupaten" name="nasabah.kota_kabupaten"
                                    type="text" class="mt-1 block w-full"
                                    value="{{ $user->nasabah->kota_kabupaten }}" required autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input-label for="nasabah.nomor_hp" :value="__('Nomor HP')" />
                            </td>
                            <td>
                                <x-form.input.input-disabled id="nasabah.nomor_hp" name="nasabah.nomor_hp"
                                    type="text" class="mt-1 block w-full" value="{{ $user->nasabah->nomor_hp }}"
                                    required autofocus />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
