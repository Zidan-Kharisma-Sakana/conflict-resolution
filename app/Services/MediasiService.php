<?php

namespace App\Services;

use App\Http\Requests\StoreMediasiRequest;
use App\Interfaces\MediasiServiceInterface;
use App\Models\Complaint\Mediasi;
use Carbon\Carbon;

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
            'tanggal_waktu' => Carbon::now(),
            'link_pertemuan' => $validated['link_pertemuan'] ?? '',
            'file_undangan' => $file_undangan,
            'pengaduan_id' => (int) $id
        ]);
        return $mediasi;
    }
}