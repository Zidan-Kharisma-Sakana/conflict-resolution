<?php

namespace App\Services;

use App\Http\Requests\StoreKesepakatanRequest;
use App\Http\Requests\UpdateKesepakatanRequest;
use App\Interfaces\KesepakatanServiceInterface;
use App\Interfaces\MusyawarahServiceInterface;
use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Pengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KesepakatanService implements KesepakatanServiceInterface
{
    public function createKesepakatan(StoreKesepakatanRequest $request, $id): Kesepakatan
    {
        // dd($id);
        $kesepakatan = DB::transaction(function () use ($request, $id) {
            $file = '';
            if ($request->file('kesepakatan.file')) {
                $file = $request->file('kesepakatan.file')->store('pengaduan');
            }
            $validated = $request->validated();
            $kesepakatan = Kesepakatan::create([
                'isi' => $validated['kesepakatan']['isi'],
                'file' => $file,
                'pengaduan_id' => (int) $id,
                'user_id' => $request->user()->id
            ]);

            $pengaduan = Pengaduan::findOrFail((int) $kesepakatan->pengaduan_id);
            $pengaduan->status = Pengaduan::STATUS_FINISHED;
            $pengaduan->waktu_kesepakatan = Carbon::now();
            $pengaduan->save();

            return $kesepakatan;
        });

        return $kesepakatan;
    }
    public function destroyKesepakatan(Request $request, $id) : Pengaduan
    {
        $pengaduan = DB::transaction(function () use ($id) {
            $pengaduan = Kesepakatan::findOrFail((int) $id)->pengaduan;
            Kesepakatan::destroy((int) $id);
            $last_status = Pengaduan::STATUS_DISPOSISI_BURSA_EXPIRED;
            if (!$pengaduan->is_bursa_late) {
                $last_status = Pengaduan::STATUS_DISPOSISI_BURSA;
            }
            if (!$pengaduan->is_pialang_late) {
                $last_status = Pengaduan::STATUS_DISPOSISI_PIALANG;
            }
            Pengaduan::where('id', $pengaduan->id)->update([
                'status' => $last_status,
                'waktu_kesepakatan' => null,
            ]);
            return $pengaduan;
        });
        return $pengaduan;
    }

    public function confirmKesepakatan(Request $request, $id): Pengaduan
    {
        $pengaduan = DB::transaction(function () use ($id) {
            $kesepakatan = Kesepakatan::findOrFail((int) $id);
            $kesepakatan->confirmed = true;
            $kesepakatan->save();
            $pengaduan = Pengaduan::findOrFail((int) $kesepakatan->pengaduan_id);
            $pengaduan->status = Pengaduan::STATUS_CLOSED;
            $pengaduan->waktu_selesai = Carbon::now();
            $pengaduan->save();
            return $pengaduan;
        });

        return $pengaduan;
    }
}
