<x-mail::message>
# Disposisi Pengaduan ke Bursa

{{ 'BAPPEBTI mendisposisikan bursa ' . $pengaduan->bursa->user->name .' untuk menyelesaikan pengaduan hingga ' . \Carbon\Carbon::parse($pengaduan->waktu_expires_bursa)->isoFormat('dddd, D MMMM Y') }}
<x-mail::button :url="url('/pengaduan/'. $pengaduan->id)">
    Lihat Pengaduan
</x-mail::button>

Terima Kasih,<br>
Badan Pengawas Perdagangan Berjangka dan Komoditi (BAPPEBTI)
</x-mail::message>
