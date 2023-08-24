<form class="" action="{{ route('mediasi.update', $mediasi->id) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @method('patch')
    @if ($user->role == \App\Models\User::IS_BURSA && empty($mediasi->hasil))
        <textarea required name="hasil" class="mt-1 w-full border-gray-300 rounded-md shadow-sm max-w-4xl">{{ old('hasil', $mediasi->hasil) }}</textarea>
        @error('hasil')
            <x-form.input-error class="pl-4" :messages="$errors->get('hasil')" />
        @enderror
        <table>
            <tr>
                <td>File Hasil (Opsional)</td>
                <td class="flex items-center pt-1">: <x-form.input.text-input type="file" id="file_hasil"
                        name="file_hasil" class="ml-1" /></td>
            </tr>
            <tr>
                <td></td>
                <td> @error('file_hasil')
                        <x-form.input-error class="pl-4" :messages="$errors->get('file_hasil')" />
                    @enderror
                </td>
            </tr>
        </table>
        <x-primary-button class="mt-4">Save</x-primary-button>
    @else
        <textarea name="hasil" disabled class="mt-1 w-full border-gray-300 rounded-md shadow-sm max-w-4xl">{{ $mediasi->hasil }}</textarea>
    @endif
</form>
