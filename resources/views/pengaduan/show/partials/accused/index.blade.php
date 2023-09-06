<section id="terlapor">
    <header>
        <h2 class="text-xl font-medium text-gray-900 mb-1">
            Data Terlapor
        </h2>
    </header>
    <table class="">
        <tbody>
            <tr class="capitalize">
                <td>Nama Pialang</td>
                <td>{{ ': ' . $pengaduan->pialang->user->name }}</td>
            </tr>
            <tr class="capitalize">
                <td>Cabang Pialang</td>
                <td>{{ ': ' . $pengaduan->pialang_cabang }}</td>
            </tr>
            <tr>
                <td>Email Pialang</td>
                <td>{{ ': ' . $pengaduan->pialang->user->email }}</td>
            </tr>
            <tr>
                <td>Alamat Pialang</td>
                <td>{{ ': ' . ($pengaduan->pialang->alamat ?? '-') }}</td>
            </tr>
            <tr class="capitalize">
                <td>Nama Bursa</td>
                <td>{{ ': ' . $pengaduan->bursa->user->name }}</td>
            </tr>
            @isset($pengaduan->terlapor)
                @foreach ($pengaduan->terlapor as $item)
                @isset($item['nama'])
                <tr>
                    <td>{{ 'Nama/Jabatan Terlapor ' . ($loop->index + 1) }}</td>
                    {{-- <td>{{$item['jabatan']}}</td> --}}
                    <td>{{ ': '. $item['nama'] . '/' . $item['jabatan'] }}</td>
                </tr>
                @endisset

                @endforeach
            @endisset
        </tbody>
    </table>
</section>
