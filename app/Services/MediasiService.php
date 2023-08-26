<?php

namespace App\Services;

use App\Http\Requests\StoreMediasiRequest;
use App\Http\Requests\UpdateMediasiRequest;
use App\Interfaces\MediasiServiceInterface;
use App\Models\Complaint\Mediasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MediasiService implements MediasiServiceInterface
{
    public function createMediasi(StoreMediasiRequest $request, $id): Mediasi
    {
        $file_undangan = '';
        if ($request->file('file_undangan')) {
            $file_undangan = $request->file('file_undangan')->store('pengaduan');
        }
        $validated = $request->validated();
        $mediasi = Mediasi::create([
            'tempat' => $validated['tempat'],
            'tanggal_waktu' => Carbon::parse($validated['tanggal_waktu']),
            'link_pertemuan' => $validated['link_pertemuan'] ?? '',
            'file_undangan' => $file_undangan,
            'pengaduan_id' => (int) $id
        ]);
        return $mediasi;
    }

    public function updateMediasi(UpdateMediasiRequest $request, $id): Mediasi
    {
        $mediasi = Mediasi::findOrFail($id);
        $mediasi->hasil = $request->validated()['hasil'];
        $mediasi->rangkuman = $request->validated()['rangkuman'];
        if ($request->file('file_hasil')) {
            $mediasi->file_hasil =  $request->file('file_hasil')->store('pengaduan');
        }
        $mediasi->save();
        return $mediasi;
    }
    public function cancelMediasi(Request $request, $id) : Mediasi
    {
        $mediasi = Mediasi::findOrFail($id);
        $mediasi->hasil = Mediasi::HASIL_BATAL;
        $mediasi->save();
        return $mediasi;
    }
}
