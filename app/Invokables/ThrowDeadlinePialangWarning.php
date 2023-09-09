<?php

namespace App\Invokables;

use App\Mail\DeadlineBursa;
use App\Mail\DeadlinePialang;
use App\Models\Complaint\Pengaduan;
use App\Models\Notifikasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ThrowDeadlinePialangWarning
{
    public function __invoke()
    {
        $pengaduanTotal = DB::transaction(function () {
            $pengaduansQuery = Pengaduan::where('status', Pengaduan::STATUS_DISPOSISI_PIALANG)
                ->whereBetween('waktu_expires_pialang', [Carbon::now()->startOfDay(), Carbon::now()->addWeekdays(7)->endOfDay()])
                ->whereNull('waktu_kesepakatan')
                ->where('is_pialang_warning_sent', false);
            $pengaduansQuery->get()->each(function (Pengaduan $pengaduan) {
                // notification & email
                $this->createNotifikasi($pengaduan);
                Mail::send(new DeadlinePialang($pengaduan));
            });
            return $pengaduansQuery->update([
                'is_pialang_warning_sent' => true
            ]);
        });
        error_log("ThrowDeadlinePialangWarning: " . $pengaduanTotal);
    }

    private function createNotifikasi(Pengaduan $pengaduan)
    {
        collect([$pengaduan->pialang->user])->each(function (User $user) use ($pengaduan) {
            $subject = "Peringatan Deadline dalam 7 hari";
            $waktuexpires =  Carbon::parse($pengaduan->waktu_expires_pialang);
            $content = 'BAPPEBTI memperingatkan pialang ' . $pengaduan->pialang->user->name . ' untuk menyelesaikan pengaduan hingga ' . $waktuexpires->isoFormat('dddd, D MMMM Y');
            Notifikasi::create([
                'subject' => $subject,
                'content' => $content,
                'link' => route('pengaduan.show', $pengaduan->id),
                'user_id' => $user->id
            ]);
        });
    }
}
