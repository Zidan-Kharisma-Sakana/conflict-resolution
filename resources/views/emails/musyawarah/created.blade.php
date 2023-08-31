<x-mail::message>
# Musyawarah Terjadwalkan

{{"Pialang " . $pengaduan->pialang->user->name ." menjadwalkan musyawarah pada " . \Carbon\Carbon::parse($musyawarah->tanggal_waktu)->isoFormat('dddd, D MMMM Y')}}
<x-mail::button :url="route('musyawarah.show', $musyawarah->id)">
Lihat Musyawarah
</x-mail::button>

Terima Kasih,<br>
Badan Pengawas Perdagangan Berjangka dan Komoditi (BAPPEBTI)
</x-mail::message>
