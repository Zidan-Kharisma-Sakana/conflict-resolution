<section id="identitasNasabah">
    <header>
        <h2 class="text-xl font-medium text-gray-900 mb-1">
            Data Nasabah
        </h2>
    </header>
    <table class="">
        <tbody>
            <tr>
                <td>Nama Nasabah</td>
                <td>{{ ': ' . $pengaduan->nasabah->user->name }}</td>
            </tr>
            <tr>
                <td>Email Nasabah</td>
                <td>{{ ': ' . $pengaduan->nasabah->user->email }}</td>
            </tr>
            @php
                $removeKeys = ['created_at', 'updated_at', 'id', 'user_id'];
                $arr = array_diff_key($pengaduan->nasabah->getAttributes(), array_flip($removeKeys));
            @endphp
            @foreach ($arr as $key => $value)
                <tr>
                    <td class="capitalize">{{ str_replace('_', ' ', $key) }}</td>
                    <td>{{ ': ' . ($value ?? '-') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
