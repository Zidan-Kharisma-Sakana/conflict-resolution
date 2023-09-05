<div>
    <h6 class="text-xl font-medium">Total Pengaduan</h6>
    <table>
        <tr>
            <td>Harian</td>
            <td>{{ ': ' . $data['pengaduanCount']['daily'] . ' pengaduan'}}</td>
        </tr>
        <tr>
            <td>Mingguan</td>
            <td>{{ ': ' . $data['pengaduanCount']['weekly'] . ' pengaduan'}}</td>
        </tr>
        <tr>
            <td>Bulanan</td>
            <td>{{ ': ' . $data['pengaduanCount']['monthly'] . ' pengaduan'}}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>{{ ': ' . $data['pengaduanCount']['allTime'] . ' pengaduan'}}</td>
        </tr>
    </table>
</div>
