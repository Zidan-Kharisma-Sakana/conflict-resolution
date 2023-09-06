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
                    <h6>KTP Pelapor</h6>
                </td>
                <td>
                    <x-form.input.file-input id="documents[ktp]" name="documents[ktp]" />
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Bukti Transfer</h6>
                </td>
                <td>
                    <x-form.input.file-input id="documents[transfer]" name="documents[transfer]" />
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Dokumen Pendukung (opsional)</h6>
                </td>
                <td> <x-form.input.file-input id="documents[pendukung]" name="documents[pendukung]" />
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Surat Kuasa (jika dikuasakan)</h6>
                </td>
                <td>
                    <x-form.input.file-input id="documents[kuasa]" name="documents[kuasa]" />
                </td>
            </tr>
        </table>
    </div>
</section>
