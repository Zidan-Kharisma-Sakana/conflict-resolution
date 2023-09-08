<div>
    <h6 class="text-xl font-medium">Total Pengaduan</h6>
    <table>
        <tr>
            <td>Harian</td>
            <td>{{ ': ' . $data['pengaduanCount']['daily'] . ' pengaduan' }}</td>
        </tr>
        <tr>
            <td>Mingguan</td>
            <td>{{ ': ' . $data['pengaduanCount']['weekly'] . ' pengaduan' }}</td>
        </tr>
        <tr>
            <td>Bulanan</td>
            <td>{{ ': ' . $data['pengaduanCount']['monthly'] . ' pengaduan' }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>{{ ': ' . $data['pengaduanCount']['total'] . ' pengaduan' }}</td>
        </tr>
    </table>
    @if (in_array($user->role, [\App\Models\User::IS_BAPPEBTI, \App\Models\User::IS_BURSA, \App\Models\User::IS_PIALANG]))
        <h6 class="text-xl font-medium mt-4">Total Pengaduan Terlambat</h6>
        <table>
            @if (in_array($user->role, [\App\Models\User::IS_BAPPEBTI, \App\Models\User::IS_PIALANG]))
                <tr>
                    <td>Pialang Terlambat</td>
                    <td>: <a href="{{ route('pengaduan.index', ['pialang_terlambat' => 1]) }}" target="_blank"
                            rel="noopener noreferrer">
                            {{ $data['pengaduanCount']['total_pialang_late'] . ' pengaduan' }}</a></td>
                </tr>
            @endif
            @if (in_array($user->role, [\App\Models\User::IS_BAPPEBTI, \App\Models\User::IS_BURSA]))
                <tr>
                    <td>Bursa Terlambat</td>
                    <td>: <a href="{{ route('pengaduan.index', ['bursa_terlambat' => 1]) }}" target="_blank"
                            rel="noopener noreferrer">
                            {{ $data['pengaduanCount']['total_bursa_late'] . ' pengaduan' }}</a></td>
                </tr>
            @endif
        </table>
        <h6 class="text-xl font-medium mt-4">Total Pengaduan Aktif</h6>
        <table>
            @if (count($data['active']['byYear']))
                @foreach ($data['active']['byYear'] as $key => $value)
                    <tr>
                        <td>{{ 'Tahun ' . $key }}</td>
                        <td>{{ ': ' . $value . ' pengaduan' }}</td>
                    </tr>
                @endforeach
            @else
                <p>Belum Ada</p>
            @endif
        </table>
    @endif
</div>
