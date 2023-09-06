<div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6 mt-8">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-xl font-medium text-gray-900">
                {{ __('Tambahkan Kesepakatan') }}
            </h2>
        </header>
        <form class="" action="{{ route('kesepakatan.store', $pengaduan->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <x-form.input-label for="kesepakatan.isi" value="Isi Kesepakatan" required />
            <textarea name="kesepakatan[isi]" id="kesepakatan[isi"
                class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('kesepakatan.isi') }}</textarea>
            <table>
                <tr>
                    <td> <x-form.input-label for="kesepakatan[file]" value="File Pendukung" />
                    </td>
                    <td class="flex items-center pt-1">: <x-form.input.file-input type="file" id="kesepakatan[file]"
                            name="kesepakatan[file]" class="ml-1" /></td>
                </tr>
            </table>
            <x-primary-button class="mt-4">Save</x-primary-button>
        </form>
    </div>
</div>
