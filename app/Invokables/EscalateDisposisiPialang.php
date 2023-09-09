<?php

namespace App\Invokables;

use App\Mail\DeadlinePialang;
use App\Mail\DisposisiBursa;
use App\Models\Complaint\Pengaduan;
use App\Models\Notifikasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\error;

class EscalateDisposisiPialang
{
    public function __invoke()
    {
        $pengaduanTotal = DB::transaction(function () {
            $pengaduansQuery = Pengaduan::where('status', Pengaduan::STATUS_DISPOSISI_PIALANG)
                ->where('waktu_expires_pialang', '<=', Carbon::now())
                ->whereNull('waktu_kesepakatan');
            $pengaduansQuery->get()->each(function (Pengaduan $pengaduan) {
                // notification & email
                $this->createNotifikasi($pengaduan);
                Mail::send(new DisposisiBursa($pengaduan));
            });
            return $pengaduansQuery->update([
                'status' => Pengaduan::STATUS_DISPOSISI_BURSA,
                'is_pialang_late' => true,
                'waktu_expires_bursa' => Carbon::now()->addWeekdays(21)->endOfDay()
            ]);
        });
        error_log("EscalateDisposisiPialang: " . $pengaduanTotal);
    }

    private function createNotifikasi(Pengaduan $pengaduan)
    {
        User::where('role', User::IS_BAPPEBTI)->get()
            ->each(function (User $user) use ($pengaduan) {
                $subject = "Pialang Terlambat";
                $content = 'Pialang ' . $pengaduan->pialang->user->name . ' gagal membuat kesepakatan dalam deadline yang ditentukan';
                Notifikasi::create([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('pengaduan.show', $pengaduan->id),
                    'user_id' => $user->id
                ]);
            });

        collect([$pengaduan->nasabah->user, $pengaduan->pialang->user, $pengaduan->bursa->user])
            ->each(function (User $user) use ($pengaduan) {
                $subject = "Disposisi Bursa";
                $waktuexpires =  Carbon::now()->addWeekdays(21)->endOfDay();
                $content = 'BAPPEBTI mendisposisikan bursa ' . $pengaduan->bursa->user->name . ' untuk menyelesaikan pengaduan hingga ' . $waktuexpires->isoFormat('dddd, D MMMM Y');
                Notifikasi::create([
                    'subject' => $subject,
                    'content' => $content,
                    'link' => route('pengaduan.show', $pengaduan->id),
                    'user_id' => $user->id
                ]);
            });
    }
}
