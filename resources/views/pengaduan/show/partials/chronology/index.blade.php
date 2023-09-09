<section id="kronologi">
    <header>
        <h2 class="text-xl font-medium text-gray-900 mb-1">
            Kronologi
        </h2>
    </header>
    <section>
        <div>
            <h4>Kronologis Kejadian</h4>
            <div name="kronologi[description]" class="my-2 w-full border-gray-300 p-2 border rounded-md shadow-sm">{{ $pengaduan->kronologi }}</div>
        </div>
        <table>
            <tbody>
                @php
                    $dokumens = collect($pengaduan->berkasPengaduans);
                    $dokumenKronologi = $dokumens->firstWhere('type', 'kronologi');
                @endphp
                <tr>
                    <td>Dokumen Kronologi</td>
                    <td>
                        <span>: </span>
                        @if (isset($dokumenKronologi))
                            <a target="_blank" rel="noopener noreferrer"
                                href="{{ '/storage/' . $dokumenKronologi->filekeyname }}">
                                {{ $dokumenKronologi->file_name }}
                            </a>
                        @else
                            <span>: Tidak Ada</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Kerugian</td>
                    <td>{{ ': Rp' . number_format($pengaduan->kerugian) }}</td>
                </tr>
            </tbody>
        </table>

    </section>
</section>
