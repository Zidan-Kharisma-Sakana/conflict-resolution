<?php

namespace App\Invokables;

use App\Mail\DeadlineBursa;
use App\Models\Complaint\Pengaduan;
use App\Models\Notifikasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ThrowDeadlineBursaWarning
{
    public function __invoke()
    {
        $pengaduanTotal = DB::transaction(function () {
            $pengaduansQuery = Pengaduan::where('status', Pengaduan::STATUS_DISPOSISI_BURSA)
                ->whereBetween('waktu_expires_bursa', [Carbon::now()->addWeekday(6), Carbon::now()->addWeekdays(7)])
                ->whereNull('waktu_kesepakatan')
                ->where('is_bursa_warning_sent', false);
            $pengaduansQuery->get()->each(function (Pengaduan $pengaduan) {
                // notification & email
                $this->createNotifikasi($pengaduan);
                Mail::send(new DeadlineBursa($pengaduan));
            });
            return $pengaduansQuery->update([
                'is_bursa_warning_sent' => true
            ]);
        });
        error_log("ThrowDeadlineBursaWarning: " . $pengaduanTotal);
    }

    private function createNotifikasi(Pengaduan $pengaduan)
    {
        $notifications = collect([$pengaduan->bursa->user])
            ->map(function (User $user) use ($pengaduan) {
                $subject = "Peringatan Deadline dalam 7 hari";
                $waktuexpires =  Carbon::now()->addWeekdays(7);
                $content = 'BAPPEBTI memperingatkan bursa ' . $pengaduan->bursa->user->name . ' untuk menyelesaikan pengaduan hingga ' . $waktuexpires->isoFormat('dddd, D MMMM Y');
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
