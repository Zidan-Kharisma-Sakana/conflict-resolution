<?php

namespace App\Services;

use App\Interfaces\NotificationServiceInterface;
use App\Interfaces\NotifikasiServiceInterface;
use App\Mail\DisposisiPialang;
use App\Mail\MediasiCreated;
use App\Mail\MusyawarahCreated;
use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Mediasi;
use App\Models\Complaint\Musyawarah;
use App\Models\Complaint\Pengaduan;
use App\Models\Notifikasi;
use App\Models\Profile\Bappebti;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class NotifikasiService implements NotifikasiServiceInterface
{
    public function pengaduanCreated(Pengaduan $pengaduan)
    {
        // notify bappebti
        Bappebti::with('user')->get()->each(function (Bappebti $item) use ($pengaduan) {
            $subject = "Pengaduan Baru";
            $content = "Pengaduan Baru dari nasabah " . $pengaduan->nasabah->user->name .
                ' untuk pialang ' . $pengaduan->pialang->user->name;
            Notifikasi::create([
                'subject' => $subject,
                'content' => $content,
                'link' => route('pengaduan.show', $pengaduan->id),
                'user_id' => $item->user->id,
            ]);
        });
    }
    public function pengaduanApproved(Pengaduan $pengaduan)
    {
        // notify pialang & nasabah
        collect([$pengaduan->nasabah->user, $pengaduan->pialang->user])->each(function (User $user) use ($pengaduan) {
            $subject = "Disposisi Pialang ";
            $content = "BAPPEBTI mendisposisikan pialang " . $pengaduan->pialang->user->name .
                " untuk menyelesaikan pengaduan hingga " . Carbon::parse($pengaduan->waktu_expires_pialang)->isoFormat('dddd, D MMMM Y');
            Notifikasi::create([
                'subject' => $subject,
                'content' => $content,
                'link' => route('pengaduan.show', $pengaduan->id),
                'user_id' => $user->id,
            ]);
        });
        Mail::send(new DisposisiPialang($pengaduan));
    }
    public function pengaduanRejected(Pengaduan $pengaduan)
    {
        // notify nasabah
        $subject = "Pengaduan Ditolak";
        $content = "BAPPEBTI menolak pengaduan anda";
        Notifikasi::create([
            'subject' => $subject,
            'content' => $content,
            'link' => route('pengaduan.show', $pengaduan->id),
            'user_id' => $pengaduan->nasabah->user->id,
        ]);
    }
    public function pengaduanCancelled(Pengaduan $pengaduan)
    {
        // notify pialang & nasabah & bursa
        collect([$pengaduan->nasabah->user, $pengaduan->pialang->user, $pengaduan->bursa->user])
            ->each(function (User $user) use ($pengaduan) {
                $subject = "Pengaduan Dibatalkan";
                $content = "BAPPEBTI membatalkan pengaduan dengan ID " . $pengaduan->id;
                Notifikasi::create([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('pengaduan.show', $pengaduan->id),
                    'user_id' => $user->id,
                ]);
            });
    }
    public function pengaduanClosed(Pengaduan $pengaduan)
    {
        // notify pialang & nasabah & bursa
        collect([$pengaduan->nasabah->user, $pengaduan->pialang->user, $pengaduan->bursa->user])
            ->each(function (User $user) use ($pengaduan) {
                $subject = "Pengaduan Ditutup";
                $content = "BAPPEBTI telah mengonfirmasi kesepakatan sehingga pengaduan akan ditutup";
                Notifikasi::create([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('pengaduan.show', $pengaduan->id),
                    'user_id' => $user->id,
                ]);
            });
    }
    public function musyawarahCreated(Musyawarah $musyawarah)
    {
        // notify pialang & nasabah
        $pengaduan = $musyawarah->pengaduan;
        collect([$pengaduan->nasabah->user, $pengaduan->pialang->user])
            ->each(function (User $user) use ($pengaduan, $musyawarah) {
                $subject = "Musyawarah Dijadwalkan";
                $content = "Pialang " . $pengaduan->pialang->user->name .
                    " menjadwalkan musyawarah pada " . Carbon::parse($musyawarah->tanggal_waktu)->isoFormat('dddd, D MMMM Y');
                Notifikasi::create([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('musyawarah.show', $musyawarah->id),
                    'user_id' => $user->id,
                ]);
            });
        Mail::send(new MusyawarahCreated($musyawarah));
    }
    public function mediasiCreated(Mediasi $mediasi)
    {
        // notify pialang & nasabah & mediasi
        $pengaduan = $mediasi->pengaduan;
        collect([$pengaduan->nasabah->user, $pengaduan->pialang->user, $pengaduan->bursa->user])
            ->each(function (User $user) use ($pengaduan, $mediasi) {
                $subject = "Mediasi Dijadwalkan";
                $content = "Bursa " . $pengaduan->bursa->user->name .
                    " menjadwalkan mediasi pada " . Carbon::parse($mediasi->tanggal_waktu)->isoFormat('dddd, D MMMM Y');
                Notifikasi::create([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('mediasi.show', $mediasi->id),
                    'user_id' => $user->id,
                ]);
            });
        Mail::send(new MediasiCreated($mediasi));
    }
    public function kesepakatanCreated(Kesepakatan $kesepakatan)
    {
        // notify bappebti
        Bappebti::with('user')->get()->each(function (Bappebti $item) use ($kesepakatan) {
            $subject = "Kesepakatan Dibuat";
            $content = "Kesepakatan untuk pengaduan dengan ID " . $kesepakatan->pengaduan_id . " dibuat oleh pihak " . $kesepakatan->user->name;
            Notifikasi::create([
                'subject' => $subject,
                'content' => $content,
                'link' => route('pengaduan.show', $kesepakatan->pengaduan->id),
                'user_id' => $item->user->id,
            ]);
        });
    }
    public function kesepakatanDestroyed(Pengaduan $pengaduan)
    {
        // notify all party
        collect([$pengaduan->nasabah->user, $pengaduan->pialang->user, $pengaduan->bursa->user])
            ->each(function (User $user) use ($pengaduan) {
                $subject = "Kesepakatan Ditolak Bappebti";
                $content = "Kesepakatan Ditolak Bappebti untuk pengaduan nasabah " . $pengaduan->nasabah->user->name;
                Notifikasi::create([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('pengaduan.show', $pengaduan->id),
                    'user_id' => $user->id,
                ]);
            });
    }
}
