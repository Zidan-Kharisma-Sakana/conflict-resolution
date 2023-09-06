<section class="border-slate-400 border-t pt-8">
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Kronologi Kejadian') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ceritakan kronologi & dokumen tambahan') }}
        </p>
    </header>
    <div class="mt-4 grid grid-cols-1 gap-y-4">
        <div>
            <h4>Kronologis Kejadian</h4>
            <p class="text-sm">Uraikan secara singkat dan jelas - bila memungkinkan buat lampiran tersendiri yang
                diketik rapi
                dan tersusun secara historical, disertai oleh pihak - pihak yang menyebabkan kerugian
            </p>
            <textarea name="kronologi[description]" id="kronologi"
                class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('kronologi.description') }}</textarea>
            @error('kronologi.description')
                <x-form.input-error class="mt-2" messages="this field is required" />
            @enderror
        </div>
        <table>
            <tr>
                <td>
                    <x-form.input-label for="kronologi[lampiran]" :value="__('Lampiran Kronologi (opsional)')" />
                </td>
                <td>
                    <div>
                        <x-form.input.file-input  id="documents[kronologi]" name="documents[kronologi]"/>
                        @error('documents.kronologi')
                            <x-form.input-error class="mt-2" messages="this field only accept pdf & image" />
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <x-form.input-label for="kerugian" :value="__('Kerugian dalam rupiah')" />
                </td>
                <td>
                    <div>
                        <x-form.input.text-input id="kerugian" name="kerugian" type="number"
                            class="mt-1 block w-full" :value="old('kerugian')" autofocus />
                        @error('kerugian')
                            <x-form.input-error class="mt-2" messages="this field is required" />
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
</section>
