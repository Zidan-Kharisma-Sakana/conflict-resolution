<?php

namespace App\Services;

use App\Http\Requests\StorePengaduanRequest;
use App\Interfaces\PengaduanServiceInterface;
use App\Models\Complaint\BerkasPengaduan;
use App\Models\Complaint\Pengaduan;
use App\Models\Complaint\PertanyaanPengaduan;
use App\Models\Profile\Pialang;
use Carbon\Carbon;
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
                'terlapor' => collect($terlapor)->map(function ($orang) {
                    return [
                        'nama' => $orang['nama'],
                        'jabatan' => isset($orang['nama']) ?  ($orang['jabatan'] ?? 'Lainnya/Karyawan') : null
                    ];
                }),
                'kerugian' => $validated['kerugian'],
                'status' => Pengaduan::STATUS_CREATED,
                'nasabah_id' => (int) $request->user()->nasabah->id,
                'pialang_id' => (int) $pialang->id,
                'pialang_cabang' => $validated['terlapor']['company']['cabang'],
                'bursa_id' => (int) $pialang->bursa->id,
                'kronologi' => $validated['kronologi']['description'],
                'waktu_dibuat' => Carbon::now(),
                'waktu_expires_bappebti' => Carbon::now()->addWeekdays(3)->endOfDay()
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
        $pengaduan->waktu_expires_pialang = Carbon::now()->addWeekdays(21)->endOfDay();
        $pengaduan->save();
        return $pengaduan;
    }

    public function rejectPengaduan(Request $request, $id): Pengaduan
    {
        $pengaduan = Pengaduan::where('id', $id)->where('status', Pengaduan::STATUS_CREATED)->firstOrFail();
        $pengaduan->status = Pengaduan::STATUS_REJECTED;
        $pengaduan->alasan_penolakan = $request->alasan_penolakan;
        if (!empty($request->file("dokumen_penolakan"))) {
            $pengaduan->alasan_penolakan_file = $request->file("dokumen_penolakan")->store("pengaduan");
        }
        $pengaduan->save();
        return $pengaduan;
    }
    public function forceClosePengaduan(Request $request, $id): Pengaduan
    {
        $pengaduan = Pengaduan::where('id', $id)->where('status', '!=', Pengaduan::STATUS_CLOSED)->firstOrFail();
        $pengaduan->force_close_time = Carbon::now();
        $pengaduan->status = Pengaduan::STATUS_REJECTED;
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
