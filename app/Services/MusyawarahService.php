<?php

namespace App\Services;

use App\Http\Requests\StoreMusyawarahRequest;
use App\Http\Requests\UpdateMusyawarahRequest;
use App\Interfaces\MusyawarahServiceInterface;
use App\Models\Complaint\Musyawarah;
use Carbon\Carbon;

class MusyawarahService implements MusyawarahServiceInterface
{
    public function createMusyawarah(StoreMusyawarahRequest $request, $id): Musyawarah
    {
        $file_undangan = '';
        if ($request->file('file_undangan')) {
            $file_undangan = $request->file('file_undangan')->store('pengaduan');
        }
        $validated = $request->validated();
        $musyawarah = Musyawarah::create([
            'tempat' => $validated['tempat'],
            'tanggal_waktu' => Carbon::parse($validated['tanggal_waktu']),
            'link_pertemuan' => $validated['link_pertemuan'],
            'file_undangan' => $file_undangan,
            'pengaduan_id' => (int) $id
        ]);
        return $musyawarah;
    }
    public function updateMusyawarah(UpdateMusyawarahRequest $request, $id): Musyawarah
    {
        $musyawarah = Musyawarah::findOrFail($id);
        $musyawarah->hasil = $request->validated()['hasil'];
        $musyawarah->rangkuman = $request->validated()['rangkuman'];
        if ($request->file('file_hasil')) {
            $musyawarah->file_hasil =  $request->file('file_hasil')->store('pengaduan');
        }
        $musyawarah->save();
        return $musyawarah;
    }
}
