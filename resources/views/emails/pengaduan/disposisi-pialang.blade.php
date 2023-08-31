<x-mail::message>
# Disposisi Pengaduan ke Pialang

{{ 'BAPPEBTI mendisposisikan pialang ' . $pengaduan->pialang->user->name .' untuk menyelesaikan pengaduan hingga ' . \Carbon\Carbon::parse($pengaduan->waktu_expires_pialang)->isoFormat('dddd, D MMMM Y') }}
<x-mail::button :url="url('/pengaduan/'. $pengaduan->id)">
    Lihat Pengaduan
</x-mail::button>

Terima Kasih,<br>
Badan Pengawas Perdagangan Berjangka dan Komoditi (BAPPEBTI)
</x-mail::message>
