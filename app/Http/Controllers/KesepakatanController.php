<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKesepakatanRequest;
use App\Http\Requests\UpdateKesepakatanRequest;
use App\Interfaces\KesepakatanServiceInterface;
use App\Interfaces\NotifikasiServiceInterface;
use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KesepakatanController extends Controller
{
    private KesepakatanServiceInterface $kesepakatanService;
    private NotifikasiServiceInterface $notifikasiService;

    public function __construct(KesepakatanServiceInterface $kesepakatanService, NotifikasiServiceInterface $notifikasiService)
    {
        $this->kesepakatanService = $kesepakatanService;
        $this->notifikasiService = $notifikasiService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKesepakatanRequest $request, Pengaduan $pengaduan)
    {
        $this->authorize('addKesepakatan', [$pengaduan]);
        $kesepakatan = $this->kesepakatanService->createKesepakatan($request, $pengaduan->id);
        $this->notifikasiService->kesepakatanCreated($kesepakatan);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'kesepakatan-created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kesepakatan $kesepakatan)
    {
        $this->authorize("update", [$kesepakatan]);
        $pengaduan = $this->kesepakatanService->confirmKesepakatan($request, $kesepakatan->id);
        $this->notifikasiService->pengaduanClosed($pengaduan);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'kesepakatan-updated');
    }
}
