<?php

namespace App\Invokables;

use App\Models\Complaint\Pengaduan;
use App\Models\Notifikasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EscalateDisposisiBursa
{
    public function __invoke()
    {
        // error_log("");
        error_log("EscalateDisposisiBursa: ");
        $pengaduanTotal = DB::transaction(function () {
            $pengaduansQuery = Pengaduan::where('status', Pengaduan::STATUS_DISPOSISI_BURSA)
                ->whereNull('waktu_kesepakatan')
                ->where('waktu_expires_bursa', '<=', Carbon::now());

            $pengaduansQuery->get()->each(function (Pengaduan $pengaduan) {
                $this->createNotifikasi($pengaduan);
            });

            return $pengaduansQuery->update([
                'status' => Pengaduan::STATUS_DISPOSISI_BURSA_EXPIRED,
            ]);
        });
        error_log("EscalateDisposisiBursa: " . $pengaduanTotal);
    }

    private function createNotifikasi(Pengaduan $pengaduan)
    {
        $notifications =  User::where('role', User::IS_BAPPEBTI)->get()
            ->map(function (User $user) use ($pengaduan) {
                $subject = "Bursa Terlambat";
                $content = 'Bursa ' . $pengaduan->bursa->user->name . ' gagal membuat kesepakatan dalam deadline yang ditentukan';
                return new Notifikasi([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('pengaduan.show', $pengaduan->id),
                    'user_id' => $user->id
                ]);
            });
        Notifikasi::insert($notifications->toArray());
    }
}
