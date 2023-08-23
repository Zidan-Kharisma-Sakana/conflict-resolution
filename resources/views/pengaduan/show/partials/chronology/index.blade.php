<section id="kronologi">
    <header>
        <h2 class="text-xl font-medium text-gray-900 mb-1">
            Kronologi
        </h2>
    </header>
    <section>
        <div>
            <h4>Kronologis Kejadian</h4>
            <textarea name="kronologi[description]" disabled
                class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ $pengaduan->kronologi }}</textarea>
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
