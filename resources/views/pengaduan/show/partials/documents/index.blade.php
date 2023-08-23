<section id="dokumen">
    <h2 class="text-xl font-medium text-gray-900 mb-1">
        Dokumen
    </h2>
    <table>
        <tbody>
            @php
                $dokumens = collect($pengaduan->berkasPengaduans);
                $dokumenKTP = $dokumens->firstWhere('type', 'ktp');
                $dokumenTransfer = $dokumens->firstWhere('type', 'transfer');
                $dokumenPendukung = $dokumens->firstWhere('type', 'pendukung');
                $dokumenKuasa = $dokumens->firstWhere('type', 'kuasa');
            @endphp
            <tr>
                <td>Scan KTP</td>
                <td>
                    <span>: </span>
                    <a target="_blank" rel="noopener noreferrer"
                        href="{{ '/storage/' . $dokumenKTP->filekeyname }}">
                        {{ $dokumenKTP->file_name }}
                    </a>
                </td>
            </tr>
            <tr>
                <td>Bukti Transfer/Pembayaran</td>
                <td>
                    <span>: </span>
                    <a target="_blank" rel="noopener noreferrer"
                        href="{{ '/storage/' . $dokumenTransfer->filekeyname }}">
                        {{ $dokumenTransfer->file_name }}
                    </a>
                </td>
            </tr>
            @isset($dokumenPendukung)
                <tr>
                    <td>Dokumen Pendukung</td>
                    <td>
                        <span>: </span>
                        <a target="_blank" rel="noopener noreferrer"
                            href="{{ '/storage/' . $dokumenPendukung->filekeyname }}">
                            {{ $dokumenPendukung->file_name }}
                        </a>
                    </td>
                </tr>
            @endisset
            @isset($dokumenKuasa)
                <tr>
                    <td>Surat Kuasa</td>
                    <td>
                        <span>: </span>
                        <a target="_blank" rel="noopener noreferrer"
                            href="{{ '/storage/' . $dokumenKuasa->filekeyname }}">
                            {{ $dokumenKuasa->file_name }}
                        </a>
                    </td>
                </tr>
            @endisset

        </tbody>
    </table>
</section>
