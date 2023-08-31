<x-mail::message>
# Mediasi Terjadwalkan

{{"Bursa " . $pengaduan->bursa->user->name ." menjadwalkan mediasi pada " . \Carbon\Carbon::parse($mediasi->tanggal_waktu)->isoFormat('dddd, D MMMM Y')}}
<x-mail::button :url="route('mediasi.show', $mediasi->id)">
Lihat Mediasi
</x-mail::button>

Terima Kasih,<br>
Badan Pengawas Perdagangan Berjangka dan Komoditi (BAPPEBTI)
</x-mail::message>
