<?php

namespace App\Services;

use App\Http\Requests\StorePengaduanRequest;
use App\Interfaces\PengaduanServiceInterface;
use App\Models\Complaint\BerkasPengaduan;
use App\Models\Complaint\Pengaduan;
use App\Models\Complaint\PertanyaanPengaduan;
use App\Models\Profile\Pialang;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanService implements PengaduanServiceInterface
{

    public function createPengaduan(StorePengaduanRequest $request): Pengaduan
    {
        // dd($request->validated());
        $pengaduan = DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $terlapor = $validated['terlapor'];
            unset($terlapor['company']);
            $pialang = Pialang::with("bursa")->find((int) $validated['terlapor']['company']['id']);
            $pengaduan = Pengaduan::create([
                'terlapor' => $terlapor,
                'kerugian' => $validated['kerugian'],
                'status' => Pengaduan::STATUS_CREATED,
                'nasabah_id' => (int) $request->user()->nasabah->id,
                'pialang_id' => (int) $pialang->id,
                'bursa_id' => (int) $pialang->bursa->id,
                'kronologi' => $validated['kronologi']['description'],
                'waktu_dibuat' => Carbon::now(),
                'waktu_expires_bappebti' => Carbon::now()->addWeekdays(3)
            ]);
            $this->saveDocuments($request, $pengaduan);
            $this->saveQuestions($request, $pengaduan);
            return $pengaduan;
        });
        return $pengaduan;
    }

    public function approvePengaduan(Request $request, $id): Pengaduan
    {
        $pengaduan = Pengaduan::where('id', $id)->where('status', Pengaduan::STATUS_CREATED)->firstOrFail();
        $pengaduan->status = Pengaduan::STATUS_DISPOSISI_PIALANG;
        $pengaduan->waktu_selesai_bappebti = Carbon::now();
        $pengaduan->waktu_expires_pialang = Carbon::now()->addWeekdays(21);
        $pengaduan->save();
        return $pengaduan;
    }

    public function rejectPengaduan(Request $request, $id): Pengaduan
    {
        $pengaduan = Pengaduan::where('id', $id)->where('status', Pengaduan::STATUS_CREATED)->firstOrFail();
        $pengaduan->status = Pengaduan::STATUS_REJECTED;
        $pengaduan->alasan_penolakan = $pengaduan->alasan_penolakan;
        $pengaduan->waktu_selesai_bappebti = Carbon::now();
        $pengaduan->save();
        return $pengaduan;
    }
    private function saveDocuments(StorePengaduanRequest $request, Pengaduan $pengaduan)
    {
        foreach ($request->file("documents") as $key => $value) {
            BerkasPengaduan::create([
                "type" => $key,
                "filekeyname" => $value->store("pengaduan"),
                "file_name" => basename($value->getClientOriginalName(), '.' . $value->getClientOriginalExtension()),
                "file_type" => $value->getClientOriginalExtension(),
                "pengaduan_id" => $pengaduan->id
            ]);
        }
    }

    private function saveQuestions(StorePengaduanRequest $request, Pengaduan $pengaduan)
    {
        foreach ($request->validated()["pertanyaan"] as $key => $value) {
            PertanyaanPengaduan::create([
                "type" => $key,
                "pertanyaan" => $value['question'],
                "jawaban" => $value['answer'],
                "pengaduan_id" => $pengaduan->id
            ]);
        }
    }

}
