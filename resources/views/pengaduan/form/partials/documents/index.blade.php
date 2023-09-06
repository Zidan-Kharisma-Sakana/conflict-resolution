<section class="border-slate-400 border-t pt-8">
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Dokumen') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Unggah dokumen pendukung') }}
        </p>
    </header>
    <div class="grid grid-cols-1 gap-y-4 mt-4">
        <table>
            <tr>
                <td>
                    <x-form.input-label required for="documents[ktp]" :value="__('Scan KTP Pelapor')" />
                </td>
                <td>
                    <x-form.input.file-input id="documents[ktp]" name="documents[ktp]" />
                </td>
            </tr>
            <tr>
                <td>
                    <x-form.input-label required for="documents[transfer]" :value="__('Bukti Transfer')" />
                </td>
                <td>
                    <x-form.input.file-input id="documents[transfer]" name="documents[transfer]" />
                </td>
            </tr>
            <tr>
                <td>
                    <x-form.input-label for="documents[pendukung]" :value="__('Dokumen Pendukung Lain (opsional)')" />
                </td>
                <td> <x-form.input.file-input id="documents[pendukung]" name="documents[pendukung]" />
                </td>
            </tr>
            <tr>
                <td>
                    <x-form.input-label for="documents[kuasa]" :value="__('Surat Kuasa (Jika Dikuasakan)')" />
                </td>
                <td>
                    <x-form.input.file-input id="documents[kuasa]" name="documents[kuasa]" />
                </td>
            </tr>
        </table>
    </div>
</section>
