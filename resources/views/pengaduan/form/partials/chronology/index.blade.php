<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-7xl">
        <section>
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
                    <textarea name="kronologi.description" id="kronologi"
                        class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('pertanyaan.exchange') }}</textarea>

                </div>
                <table>
                    <tr>
                        <td>
                            <x-form.input-label for="kronologi.lampiran" :value="__('Lampiran Kronologi (opsional)')" />
                        </td>
                        <td>
                            <input type="file" id="kronologi.lampiran" name="kronologi.lampiran"
                                accept="image/*,.pdf" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <x-form.input-label for="kerugian" :value="__('Kerugian dalam rupiah')" />
                        </td>
                        <td>
                            <x-form.input.text-input id="kerugian" name="kerugian" type="number"
                            class="mt-1 block w-full" :value="old('kerugian')" required autofocus />
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</div>
