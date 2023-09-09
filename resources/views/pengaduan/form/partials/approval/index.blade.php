<div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16  space-y-6 mt-8">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-xl font-medium text-gray-900">
                {{ __('Pengecekan Pengaduan') }}
            </h2>
        </header>
        <form method="post" action="{{ route('pengaduan.update', $pengaduan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div>
                <h6>Alasan Penolakan (Jika ditolak)</h6>
                <textarea required name="alasan_penolakan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('alasan_penolakan') }}</textarea>
                @error('alasan_penolakan')
                    <x-form.input-error messages="This field is required" />
                @enderror
            </div>
            <div>
                <table>
                    <tr>
                        <td> <x-form.input-label for="dokumen_penolakan" value="File Pendukung" />
                        </td>
                        <td class="flex items-center pt-1">: <x-form.input.file-input type="file"
                                id="dokumen_penolakan" name="dokumen_penolakan" class="ml-1" /></td>
                    </tr>
                </table>
            </div>
            <div class="flex items-center gap-4 mt-4">
                <x-danger-button name="subject" type="submit" value="reject" class="ml-1">
                    {{ __('Tolak') }}
                </x-danger-button>
            </div>
        </form>
        <form class="mt-2" method="post" action="{{ route('pengaduan.update', $pengaduan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch') <x-primary-button name="subject" type="submit"
                value="approve">{{ __('Setujui') }}</x-primary-button>
        </form>
    </div>
</div>
