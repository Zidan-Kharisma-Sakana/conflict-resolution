<section id="kronologi">
    <header>
        <h2 class="text-xl font-medium text-gray-900 mb-1">
            Jadwal Mediasi
        </h2>
    </header>
    <table class="jadwal table-auto border-collapse w-full">
        <thead>
            <tr class="bg-slate-200">
                <td>No</td>
                <td>Tanggal</td>
                <td>Waktu</td>
                <td>Tempat</td>
                <td>Status</td>
                <td>Hasil</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody class="capitalize">
            @if (!$items->isEmpty())
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_waktu)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_waktu)->isoFormat('H:mm') . '  WIB' }}</td>
                        <td>{{ $item->tempat }}</td>
                        <td>{{ $item->getStatus() }}</td>
                        <td>{{ strtolower($item->hasil ?? '-') }}</td>
                        <td>
                            <a href="{{ route('mediasi.show', $item->id) }}">
                                <x-secondary-button>
                                    <p>Detail &#128065;</p>
                                </x-secondary-button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">Belum Ada Mediasi Terjadwalkan</td>
                </tr>
            @endif

        </tbody>
    </table>
</section>
