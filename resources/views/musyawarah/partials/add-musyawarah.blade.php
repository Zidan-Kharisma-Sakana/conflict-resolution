<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-8">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-xl font-medium text-gray-900">
                {{ __('Tambah Musyawarah') }}
            </h2>
        </header>
        <form class="" action="{{ route('musyawarah.store', $pengaduan->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tr>
                    <td> <x-form.input-label for="tanggal_waktu" value="Tanggal dan Waktu " required />
                    </td>
                    <td>:<x-form.input.text-input id="tanggal_waktu" name="tanggal_waktu" class="ml-1"
                            type="datetime-local" required /></td>
                    <td> @error('tanggal_waktu')
                            <x-form.input-error class="pl-4" messages="this field is required" />
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td> <x-form.input-label for="tempat" value="Tempat" required />
                    </td>
                    <td class="flex items-center">: <x-form.input.text-input id="tempat" name="tempat" class="ml-1" /></td>
                    <td> @error('tempat')
                            <x-form.input-error class="pl-4" messages="this field is required" />
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td> <x-form.input-label for="link_pertemuan" value="Link Pertemuan" />
                    </td>
                    <td class="flex items-center">: <x-form.input.text-input id="link_pertemuan" name="link_pertemuan" class="ml-1" /></td>
                </tr>
                <tr>
                    <td> <x-form.input-label for="file_undangan" value="File Undangan" />
                    </td>
                    <td class="flex items-center pt-1">: <x-form.input.text-input type="file" id="file_undangan" name="file_undangan" class="ml-1" /></td>
                </tr>
            </table>
            <x-primary-button class="mt-4">Save</x-primary-button>
        </form>
    </div>
</div>
