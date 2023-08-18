<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-2xl">
        <section>
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
                            <input type="file" id="dokumen.ktp" name="dokumen.ktp" accept="image/*,.pdf" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Bukti Transfer</h6>
                        </td>
                        <td>
                            <input type="file" id="dokumen.transfer" name="dokumen.transfer" accept="image/*,.pdf" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Dokumen Pendukung (opsional)</h6>
                        </td>
                        <td> <input type="file" id="dokumen.pendukung" name="dokumen.pendukung"
                                accept="image/*,.pdf" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Surat Kuasa (jika dikuasakan)</h6>
                        </td>
                        <td>
                            <input type="file" id="dokumen.kuasa" name="dokumen.kuasa" accept="image/*,.pdf" />
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</div>
